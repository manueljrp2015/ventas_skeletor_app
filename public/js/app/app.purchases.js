$(function() {

    var progress = new CircularProgress({
        radius: 70,
        strokeStyle: 'black',
        lineCap: 'round',
        lineWidth: 4
    });

    $(".modal").modal();
    $('.modal').modal({
        dismissible: true,
        opacity: .5,
        inDuration: 300,
        outDuration: 200,
        startingTop: '4%',
        endingTop: '10%'
    });

    moment.locale('es');
    modalTransport = function(o, id) {

        preloader.on();
        $.getJSON('get-courier-order', {
            order: o
        }, function(json, textStatus) {
            preloader.off();
            $("#modal2").modal('open');

            if (json.data._contact == null) {
                var c = "*****";
            } else {
                var c = json.data._contact;
            }
            if (json.data._cost == null) {
                var cos = "*****";
            } else {
                var cos = json.data._cost;
            }
            if (json.data._total_weight == null) {
                var wei = "*****";
            } else {
                var wei = json._total_weight;
            }
            if (json.data._date_retirement == null) {
                var dr = "*****";
            } else {
                var dr = json.data._date_retirement;
            }
            if (json.data._direcction == null) {
                var dir = "*****";
            } else {
                var dir = json.data._direcction;
            }
            if (json.data._cel == null) {
                var cel = "*****";
            } else {
                var cel = json.data._cel;
            }

            $("#_envio").val(json.data._type_courier);
            $("#_costo").val(cos);
            $("#_peso").val(wei);
            $("#_fechad").val(json.data._create_at);
            $("#_fechar").val(json.data.dr);
            $("#_contacto").val(c);
            $("#_diren").val(dir);
            $("#_telef").val(cel);

        });
    };

    getPaymentForOrdertId = function(id) {
        $.getJSON('get-purchase-id', {
            id: id
        }, function(json, textStatus) {

            if (json.data._bill == null) {
                    bill = "0000";
                } else {
                    bill = json.data._bill;
                }

                if (json.data._office_guide == null) {
                    office = "0000";
                } else {
                    office = json.data._office_guide;
                }

            var tbinfo = '<h4><table class="striped">' +
                '<tr>' +
                '<td>Orden:</td>' +
                '<td>#' + json.data._order_id + '</td>' +
                '</tr>' +
                '<tr>' +
                '<td>Factura:</td>' +
                '<td>' + bill + '</td>' +
                '</tr>' +
                '<tr>' +
                '<tr>' +
                '<td>Guia:</td>' +
                '<td>' + office + '</td>' +
                '</tr>' +
                '<tr>' +
                '<td>Item:</td>' +
                '<td>' + json.data._item  + '</td>' +
                '</tr>' +
                '<tr>' +
                '<td>Neto:</td>' +
                '<td>$' + number_format(json.data._total_neto, 2, ",", ".") + '</td>' +
                '</tr>' +
                '<tr>' +
                '<td>IVA:</td>' +
                '<td>$' + number_format(json.data._total_iva, 2, ",", ".")+ '</td>' +
                '</tr>' +
                '<tr>' +
                '<td>total:</td>' +
                '<td>$' + number_format(json.data._total_order, 2, ",", ".") + '</td>' +
                '</tr>' +
                '<tr>' +
                '<td>Envio:</td>' +
                '<td>$' + number_format(json.data._courier_cost, 2, ",", ".") + '</td>' +
                '</tr>' +
                '<tr>' +
                '<td>Cantidad:</td>' +
                '<td>' + json.data._total_cant + '</td>' +
                '</tr>' +
                '<tr>' +
                '<td>Volumen:</td>' +
                '<td>' + number_format(json.data._volume, 2, ",", ".") + '</td>' +
                '</tr>' +
                '<tr>' +
                '<td>Peso:</td>' +
                '<td>' + json.data._weight + '</td>' +
                '</tr>' +
                '<tr>' +
                '<td>Fecha:</td>' +
                '<td>' + moment(json.data._date_create).format("DD-MM-YYYY") + '</td>' +
                '</tr>' +

                '</table>';

           
            $("#tbinfo").empty().append(tbinfo);
            $("#modal13").modal("open");
        });
    };

    getItemOrder = function(o) {
        preloader.on();
        $.getJSON('get-item-order', {
            order: o
        }, function(json, textStatus) {
            preloader.off();
            $("#modal3").modal("open");
            $("#lb-order").html("Orden: #" + o);

            tb = '<table id="table-purchases-items" class="display responsive-table datatable-exampl striped">' +
                '<thead>' +
                '<tr>' +
                '<th style="text-align: right;">SKU</th>' +
                '<th style="text-align: right;">PRODUCTO</th>' +
                '<th style="text-align: right;">ORDEN</th>' +
                '<th style="text-align: right;">CANTIDAD</th>' +
                '<th style="text-align: right;">TOTAL</th>' +
                '<th style="text-align: right;">FACTURA</th>' +
                '<th style="text-align: right;">ORDEN DE DESPACHO</th>' +
                '</tr>' +
                '</thead>' +
                '<tbody>';

            $.each(json.data, function(index, val) {
                tb += '<tr>' +
                    '<th style="text-align: right;">' + val._producto_sku + '</th>' +
                    '<th style="text-align: right;">' + val._product + '</th>' +
                    '<th style="text-align: right;">' + val._order_id + '</th>' +
                    '<th style="text-align: right;">' + val._cant + '</th>' +
                    '<th style="text-align: right;">' + val._rode + '</th>' +
                    '<th style="text-align: right;">' + val._bill + '</th>' +
                    '<th style="text-align: right;">' + val._office_guide + '</th>' +
                    '</tr>';
            });

            tb += '</tbody></table>';

            $("#tbitems").empty().append(tb);

            $("#table-purchases-items").DataTable({
                "pageLength": 30,
                "dom": '<"top"flp<"clear">>rt<"bottom"ifp<"clear">>',
                "order": [
                    [0, "asc"]
                ]
            });
        });
    };

    timelineOrder = function(o) {

        preloader.on();
        $.getJSON('get-timeline-order', {
            order: o
        }, function(json, textStatus) {
            preloader.off();
            $("#modal4").modal("open");
            var timeline = '<ul class="progress-indicator">';
            $("#tlb-order").html("Orden: #" + o);
            var i = 1;
            var color = "";
            var count = json.data.length;
            $.each(json.data, function(index, val) {
                if (count == i) {
                    color = "completed";
                } else {
                    color = "warning";
                }

                if (count <= 1) {
                    var bt = "<a href='../mi-carrito/order-courier?order=" + val._order_id + "'>Conformar Orden</a>";
                } else {
                    var bt = "";
                }
                timeline += '<li class="' + color + '"><span class="bubble"></span><span class="fa fa-minus"></span>' + val._description_state + ' <br> ' + val._date + ' / ' + val._time + ' <br>' + bt + '</li>';
                i++;
            });

            timeline += "</ul>";

            $("#timelineorder").empty().append(timeline);
        });
    };


    modalComment = function(o, i) {
        $.getJSON('get-comment-order', {
            order: o
        }, function(json, textStatus) {
            $("#modal7").modal("open");
            $("#_order_i").val(o)
            $("#_comment").val(json.data._comment);
        });
    };

    modalPayment = function(o, i, p, s) {
        $("#paylb-order").empty().html("Orden: #" + o);
        $("#_order_id").val(o);
        $("#modal5").modal("open");
        $("#_rode").val(p);
        $("#_store_id").val(s);
    };

    $("#_tipo_pago").change(function() {
        if ($("#_tipo_pago").val() == 3) {
            window.setTimeout(function() {
                $("#_banco_o").val(24).change();
                $("#_transaccion").val("0000000000")
            }, 1000);
        }
    });

    $("#btcomment").click(function(event) {
        $.post('put-comment-order', {
            order: $("#_order_i").val(),
            comment: $("#_comment").val()
        }, function(data, textStatus, xhr) {
            $("#modal7").modal("close");
            swal({
                title: "Proceso Ejecutado!",
                text: "Comentario actualizado.",
                timer: 2000,
                showConfirmButton: false
            });
        });
    });

    var progress;

    getPurchase = function() {

        $.getJSON('my-purchases', function(json, textStatus) {

            var totali;
            var totalc;
            var totalw;

            if (json.summary.totali == null) {
                totali = "0"
            } else {
                totali = json.summary.totali
            }
            if (json.summary.totalc == null) {
                totalc = "0"
            } else {
                totalc = json.summary.totalc
            }
            if (json.summary.totalw == null) {
                totalw = "0"
            } else {
                totalw = json.summary.totalw
            }

            tb2 = '<h5>Record de compras</h5><table id="table" class="display responsive-table datatable-example striped">' +
                '<tr>' +
                '<td style="text-align: right;">TOTAL/ORDENES</td>' +
                '<td style="text-align: right;">TOTAL/ITEMS</td>' +
                '<td style="text-align: right;">TOTAL/CANTIDAD</td>' +
                '<td style="text-align: right;">COMPRAS</td>' +

                '</tr>' +
                '<tr>' +
                '<td style="text-align: right; font-size: 22px; color: green;">$ ' + number_format(json.summary.totalo, 2, ",", ".") + '</td>' +
                '<td style="text-align: right; font-size: 22px;">' + totali + '</td>' +
                '<td style="text-align: right; font-size: 22px;">' + totalc + '</td>' +
                '<td style="text-align: right; font-size: 22px;">' + json.summary.totalid + '</td>' +

                '</tr>' +
                '</table>';

            $("#tbpurchasessummary").empty().append(tb2);


            tb = '<table id="table-purchases" class="display responsive-table datatable-example striped">' +
                '<thead>' +
                '<tr>' +
                '<th ></th>' +
                '<th>#</th>' +
                '<th>#</th>' +
                '<th>#</th>' +
                '<th>#</th>' +
                '<th>#</th>' +
                '<th>#</th>' +
                '<th>#</th>' +
                '<th style="text-align: center;">PROGRESO</th>' +
                '<th>ID</th>' +
                '<th>ORDEN</th>' +
                '<th>CLIENTE</th>' +
                '<th>NETO</th>' +
                '<th>IVA</th>' +
                '<th>TOTAL</th>' +
                '<th>FECHA</th>' +
                '</tr>' +
                '</thead>' +
                '<tfoot>' +
                '<tr>' +
                '<th></th>' +
                '<th>#</th>' +
                '<th>#</th>' +
                '<th>#</th>' +
                '<th>#</th>' +
                '<th>#</th>' +
                '<th>#</th>' +
                 '<th>#</th>' +
                '<th style="text-align: center;">PROGRESO</th>' +
                '<th>ID</th>' +
                '<th>ORDEN</th>' +
                '<th>CLIENTE</th>' +
                '<th>NETO</th>' +
                '<th>IVA</th>' +
                '<th>TOTAL</th>' +
                '<th>FECHA</th>' +
                '</tr>' +
                '</tfoot>' +
                '<tbody>';

            var bill = "";
            var office = "";
            var percent = 0;
            var line = "";
            var icon = "";
            var activateModal;

            $.each(json.list, function(index, val) {

                if (val._bill == null) {
                    bill = "0000";
                } else {
                    bill = val._bill;
                }

                if (val._office_guide == null) {
                    office = "0000";
                } else {
                    office = val._office_guide;
                }

                percent = Math.ceil(parseInt(val.count_state) / parseInt(12) * 100);

                if (percent <= 25) {
                    line = '';
                } else if (percent > 25 && percent <= 75) {
                    line = '';
                } else if (percent > 75 && percent <= 99) {
                    line = '';
                } else if (percent >= 100) {
                    line = 'green';
                }

                if (val.cstspay > 0) {
                    icon = "payment";
                    activateModal = "";
                } else {
                    icon = "local_atm";
                    activateModal = "onclick=modalPayment('" + val._order_id + "','" + val.id + "','" + val._total_order + "','" + val._store_id + "')";
                }

                if (val._order_state == 8) {
                    color = "#f4511e"
                } else if (val._order_state == 9) {
                    color = "#66bb6a";
                } else {
                    color = "#ffee58";
                }

                tb += '<tr>' +
                    '<td style="text-align: center; background-color: ' + color + '; width: 5%; font-size: 10px;">' + val._description_state + '</td>' +
                    '<td style="text-align: center;"><a href="invoice?o=' + base64_encode(val._order_id) + '&s=' + base64_encode(val._store_id) + '" title="Comprobante" target="_blank"><i class="material-icons">picture_as_pdf</i></a></td>' +
                    '<td style="text-align: center;"><a href="javascript: void(0)" title="Comentarios" onclick="modalComment(' + val._order_id + ',' + val.id + ')""><i class="material-icons"><i class="material-icons">comment</i></a></td>' +
                    '<td style="text-align: center;"><a href="javascript: void(0)" title="Pago de la compra" ' + activateModal + '><i class="material-icons">' + icon + '</i></a></td>' +
                    '<td style="text-align: center;"><a href="javascript: void(0)" title="Transporte de la compra" onclick="modalTransport(' + val._order_id + ',' + val.id + ')"><i class="material-icons">local_shipping</i></a></td>' +
                    '<td style="text-align: center;"><a href="javascript: void(0)" title="Detalle de la compra" onclick="getItemOrder(' + val._order_id + ')"><i class="material-icons">event_note</i></a></td>' +
                    '<td style="text-align: center;"><a href="javascript: void(0)" title="Timeline de la compra" onclick="timelineOrder(' + val._order_id + ')""><i class="material-icons">timeline</i></a></td>' +
                    '<td style="text-align: center;"><a href="javascript: void(0)" title="información sobre el pedido" onclick="getPaymentForOrdertId(' + val.id + ')""><i class="material-icons">info</i></a></td>' +
                    '<td style="text-align: center;"><div class="c100 p' + percent + ' small ' + line + '"><span>' + percent + '%</span><div class="slice"><div class="bar"></div><div class="fill"></div></div></div></td>' +
                    
                    '<td>' + val.id + '</td>' +
                    '<td>' + val._order_id + '</td>' +
                    '<td>' + val._store + '</td>' +
                    '<td>$' + number_format(val._total_neto, 2, ",", ".") + '</td>' +
                    '<td>$' + number_format(val._total_iva, 2, ",", ".") + '</td>' +
                    '<td>$' + number_format(val._total_order, 2, ",", ".") + '</td>' +
                    '<td>' + moment(val._date_create).format("DD-MM-YYYY") + '</td>' +
                    '</tr>';
            });

            tb += "</tbody></table>"

            $("#tbpurchases").empty().append(tb);

            $('#table-purchases tfoot th').each(function() {
                var title = $(this).text();
                $(this).html('<input type="text" style="text-align: center;" placeholder="' + title + '" />');
            });

            var table = $("#table-purchases").DataTable({
                "pageLength": 10,
                "dom": '<"top"flp<"clear">>rt<"bottom"ifp<"clear">>',
                "order": [
                    [8, "desct"]
                ]
            });

            table.columns().every(function() {
                var that = this;

                $('input', this.footer()).on('keyup change', function() {
                    if (that.search() !== this.value) {
                        that
                            .search(this.value)
                            .draw();
                    }
                });
            });
        });
    };

    getPurchase();

    $("#upload-button").click(function(event) {

        swal({
            title: "Declaración de Pago",
            text: "Esta seguro de realizar la declaración de pago!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Si, Seguro",
            closeOnConfirm: false
        }, function() {
            uploadFile();
        });
    });

    onLoadFile = function(event) {
        var input = event.target;
        var file = input.files[0];

        var size = Math.ceil(parseFloat(file.size / 1024));

        if (size > 4000) {
            swal("Alerta!", "Su archivo supera el limite de carga, solo se admiten archivos de 4Mb!", "error");
            $("#file").val("");
            $("#info-file").empty();
            return false;
        } else {
            var tbp = '<table class="display responsive-table datatable-example highlight striped">' +
                '<thead>' +
                '<tr>' +
                '<th align="center">Archivo</th>' +
                '<th align="center">Tamaño</th>' +
                '<th align="center">Tipo</th>' +
                '<th align="center">F/modificación</th>' +
                '</tr></thead><tbody>' +
                '<tr>' +
                '<td align="center">' + file.name + '</td>' +
                '<td align="center">' + Math.ceil(parseFloat(file.size / 1024)) + ' Kb</td>' +
                '<td align="center">' + file.type + '</td>' +
                '<td align="center">' + moment(file.lastModified).format('LLLL') + '</td>' +
                '</tr></body></table>';

            $("#info-file").empty().append(tbp);
        }

    }

    var fmfile = $("#fmfile");
    var process = $("#process");

    uploadFile = function() {

        var file = document.getElementById("file");
        var formData = new FormData();
        formData.append('filename', file.files[0]);
        formData.append('_tipepay', $("#_tipo_pago").val());
        formData.append('_bank_origin', $("#_banco_o").val());
        formData.append('_bank_destiny', $("#_banco_d").val());
        formData.append('_transaccion', $("#_transaccion").val());
        formData.append('_date_pay', $("#_datep").val());
        formData.append('_rode', $("#_rode").val());
        formData.append('_order_id', $("#_order_id").val());
        formData.append('_store_id', $("#_store_id").val());

        $.ajax({
                url: 'upload-files-payment',
                type: 'POST',
                processData: false,
                contentType: false,
                async: true,
                dataType: 'json',
                data: formData,
                beforeSend: function() {
                    preloader.on();
                },
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = evt.loaded / evt.total;
                            $('#porcent').empty().html(Math.round(percentComplete * 100) + "%");
                            process.attr("style", "width:" + Math.round(percentComplete * 100) + "%");
                        }

                    }, false);
                    return xhr;
                }
            })
            .done(function(response) {
                preloader.off();
                console.log("success");

                swal({
                        title: "Proceso Ejecutado",
                        text: "Se ha cargado el pago la orden Nro: #" + $("#_order_id").val(),
                        type: "success",
                        showCancelButton: false,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Ok",
                        closeOnConfirm: true
                    },
                    function() {
                        getPurchase();
                        $("#file").val("");
                        document.getElementById("fmfile").reset();
                        $("#info-file").empty();
                        $("#modal5").modal("close");

                    });
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });

    };

    downloadURI = function(uri, name) {
        var link = document.createElement("a");
        link.download = name;
        link.href = uri;
        link.click();
    };

});