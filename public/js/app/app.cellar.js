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
                '<th style="text-align: right;"></th>' +
                '<th style="text-align: right;">SKU</th>' +
                '<th style="text-align: right;">PRODUCTO</th>' +
                '<th style="text-align: right;">ORDEN</th>' +
                '<th style="text-align: right;">STOCK</th>' +
                '<th style="text-align: right;">CANT</th>' +
                '<th style="text-align: right;">PICKING</th>' +
                '<th style="text-align: right;">VERIF</th>' +
                '<th style="text-align: right;">TOTAL</th>' +
                '<th style="text-align: right;"></th>' +
                '</tr>' +
                '</thead>' +
                '<tbody>';
            var i = 1;
            var st;
            $.each(json.data, function(index, val) {
                tb += '<tr>' +
                    '<th style="text-align: center;"><a href="javascript: void(0)" onclick=deleteItem(' + val.id + ',' + val._order_id + ')><i class="material-icons small">delete_forever</i></a></th>' +
                    '<th style="text-align: right;">' + val._producto_sku + '</th>' +
                    '<th style="text-align: right;">' + val._product + '</th>' +
                    '<th style="text-align: right;">' + val._order_id + '</th>' +
                    '<th style="text-align: right;" id="avai' + i + '">' + val._available + '</th>' +
                    '<td style="width: 80px;"><div class="input-field col s12 m6 l12"><input style="text-align: center" type="number" name="cant" id="cant' + i + '" min="1" max="' + parseInt(val._available) + '" value=' + parseInt(val._cant) + '></div></td>' +
                    '<th style="text-align: right;">' + parseInt(val._picking) + '</th>' +
                    '<th style="text-align: right;">' + parseInt(val._confirm) + '</th>' +
                    '<th style="text-align: right;">' + val._rode + '</th>' +
                    
                    '<th style="text-align: center;"><input type="hidden" value="' + parseInt(val._cant) + '" id="hide_avai' + i + '"><a href="javascript: void(0)"><i class="material-icons" onclick="updateOrder(' + i + ',' + val._product_id + ',' + val.id + ',' + val._order_id + ',' + val._store_id + ')">system_update_alt</i></a></th>' +
                    '</tr>';
                i++;

                st = val._store_id;
            });

            tb += '</tbody></table>';

            $("#tbitems").empty().append(tb);

            $("#idstore").val(st);
            $("#idorder").val(o);

            $("#table-purchases-items").DataTable({
                "pageLength": 30,
                "dom": '<"top"flp<"clear">>rt<"bottom"ifp<"clear">>',
                "order": [
                    [0, "asc"]
                ]
            });
        });
    };

    updateOrder = function(i, pid, id, orden, store) {

        var available = $("#avai" + i).text();
        var hide_avai = $("#hide_avai" + i).val();
        var cantidad = $("#cant" + i).val();
        $("#loader1").empty().append(loaderCustom(50, "actualizando"));

        if (parseInt(available) < parseInt(cantidad)) {
            swal("Error", "La cantidad que esta solicitando es superior a la disponible, por favor verificar", "error");
            $("#loader1").empty();
            return false;
        }



        $.post('update-order', {
            n: cantidad,
            v: hide_avai,
            orden: orden,
            id: id,
            store: store,
            pid: pid
        }, function(data, textStatus, xhr) {
            $("#loader1").empty();
            getItemOrder(orden);
            getPurchase();
        });
    }

    deleteItem = function(id, order) {

        swal({
            title: "Ejecutar Proceso",
            text: "Esta seguro de realizar este proceso!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Si, Seguro",
            closeOnConfirm: true
        }, function() {
            $("#loader1").empty().append(loaderCustom(50, "Buscando"));
            $.post('cellar-deleteitem-order', {
                id: id,
                order: order
            }, function(data, textStatus, xhr) {
                $("#loader1").empty();
                getItemOrder(order);
                getPurchase();
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

                if (val._order_state == 13) {
                    color = "danger"
                } else if (count == i) {
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


    modalTransportManual = function(o, s) {
        $("#modal10").modal("open");
        $("#_order_id").val(o);
        $("#_store_id").val(s);
    };


    $("#calculate").click(function(event) {
        event.preventDefault();
        var alto = $("#_alto").val();
        var ancho = $("#_ancho").val();
        var largo = $("#_largo").val();
        var peso = $("#_peso_m").val();
        var order = $("#_order_id").val();
        var store = $("#_store_id").val();

        if (alto.toString() == '' || ancho.toString() == '' || largo.toString() == '' || peso.toString() == '') {
            return false;
        }

        $.ajax({
                url: 'calculate-tnt-manual',
                type: 'POST',
                dataType: 'json',
                data: {
                    _ancho: ancho,
                    _largo: largo,
                    _alto: alto,
                    _peso: peso,
                    _store_id: store,
                    _order_id: order,
                },
                beforeSend: function() {
                    $("#loader3").empty().append(loaderCustom(50, "calculando"));
                }
            })
            .done(function(response) {
                console.log("success");
                $("#loader3").empty();
                $("#_total").val(response.cost);
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });
    });

    $("#modal10").modal({
        complete: function() {
            document.getElementById("frmtr").reset();
        }
    });

    var frmtr = $("#frmtr");

    frmtr.validate({
        ignore: [],
        rules: {
            _alto: {
                required: {
                    depends: function(element) {
                        if ($("#notransport:checked").length > 0) {
                            return false;
                        } else {
                            return true;
                        }
                    }
                }
            },
            _ancho: {
                required: {
                    depends: function(element) {
                        if ($("#notransport:checked").length > 0) {
                            return false;
                        } else {
                            return true;
                        }
                    }
                }
            },
            _largo: {
                required: {
                    depends: function(element) {
                        if ($("#notransport:checked").length > 0) {
                            return false;
                        } else {
                            return true;
                        }
                    }
                }
            },
            _peso_m: {
                required: {
                    depends: function(element) {
                        if ($("#notransport:checked").length > 0) {
                            return false;
                        } else {
                            return true;
                        }
                    }
                }
            },
            _total: {
                required: {
                    depends: function(element) {
                        if ($("#notransport:checked").length > 0) {
                            return false;
                        } else {
                            return true;
                        }
                    }
                }
            }
        },
        messages: {
            _alto: {
                required: "Requerido"
            },
            _ancho: {
                required: "Requerido"
            },
            _largo: {
                required: "Requerido"
            },
            _peso_m: {
                required: "Requerido"
            },
            _total: {
                required: "Requerido"
            }
        },
        submitHandler: function() {
            saveTransportManual();
        }
    });

    saveTransportManual = function() {
        $.ajax({
                url: 'save-transport-manual',
                type: 'POST',
                dataType: 'json',
                data: frmtr.serialize(),
                beforeSend: function() {
                    $("#loader3").empty().append(loaderCustom(50, "guardando"));
                }
            })
            .done(function(response) {
                $("#loader3").empty();
                getPurchase();
                $("#modal10").modal("close");
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });
    };

    changeState = function(o){
        $.ajax({
                url: 'get-state-order',
                type: 'POST',
                dataType: 'json',
                data: {
                    order: o
                },
                beforeSend: function() {
                    preloader.on();
                }
            })
            .done(function(response) {
                preloader.off();

                var select = '<input type="hidden" name="order_id" id="order_id" value="'+o+'"><select name="_state" id="_state" class="js-states browser-default" style="width: 100%">';

                $.each(response.data, function(index, val) {
                   select += '<option value="'+val.id+'">'+val._description_state+'</option>'
                });

                select += '</select>';
                $(".statess").empty().append(select);
                $('#_state').select2({
                    placeholder: 'Seleccione Estado...'
                });
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });
    };

    modalChangeState = function(o) {
        
        $("#modal12").modal("open");
        changeState(o);
    };

    $("#btChangeState").click(function(event) {
       swal({
            title: "Ejecutar Proceso",
            text: "Esta seguro de realizar este proceso!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Si, Seguro",
            closeOnConfirm: true
        }, function() {
            $("#loader9").empty().append(loaderCustom(50, "Cambiando Estado"));
            $.post('change-state-order', {
                id: $("#_state").val(),
                order: $("#order_id").val()
            }, function(data, textStatus, xhr) {
              console.log(textStatus);
                $("#loader9").empty();
                getPurchase();
                $("#modal12").modal("close");
            });
        });
    });


    getPurchase = function() {

        $.getJSON('purchases', function(json, textStatus) {

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
                '<td style="text-align: right;">TOTAL/VOLUMEN</td>' +
                '<td style="text-align: right;">TOTAL/PESO</td>' +
                '</tr>' +
                '<tr>' +
                '<td style="text-align: right; font-size: 22px; color: green;">$ ' + number_format(json.summary.totalo, 2, ",", ".") + '</td>' +
                '<td style="text-align: right; font-size: 22px;">' + totali + '</td>' +
                '<td style="text-align: right; font-size: 22px;">' + totalc + '</td>' +
                '<td style="text-align: right; font-size: 22px;">' + json.summary.totalid + '</td>' +
                '<td style="text-align: right; font-size: 22px; color: green;">' + number_format(json.summary.totalv, 2, ",", ".") + ' CM&sup3;</td>' +
                '<td style="text-align: right; font-size: 22px;">' + totalw + '</td>' +
                '</tr>' +
                '</table>';

            $("#tbpurchasessummary").empty().append(tb2);


            tb = '<table id="table-purchases" class="display responsive-table datatable-example striped">' +
                '<thead>' +
                '<tr>' +
                '<th></th>' +
                '<th></th>' +
                '<th></th>' +
                '<th></th>' +
                '<th></th>' +
                '<th></th>' +
                '<th></th>' +
                '<th></th>' +
                '<th>ORDEN</th>' +
                '<th>FACT</th>' +
                '<th>GUIA</th>' +
                '<th>CLIENTE</th>' +
                '<th>NETO</th>' +
                '<th>IVA</th>' +
                '<th>TOTAL</th>' +
                '<th>ENVIO</th>' +
                '<th>ITEM</th>' +
                '<th>CANT</th>' +
                '<th>FECHA</th>' +
                '</tr>' +
                '</thead>' +
                '<tfoot>' +
                '<tr>' +
                '<th></th>' +
                '<th></th>' +
                '<th></th>' +
                '<th></th>' +
                '<th></th>' +
                '<th></th>' +
                '<th></th>' +
                '<th></th>' +
                '<th>ORDEN</th>' +
                '<th>FACT</th>' +
                '<th>GUIA</th>' +
                '<th>CLIENTE</th>' +
                '<th>NETO</th>' +
                '<th>IVA</th>' +
                '<th>TOTAL</th>' +
                '<th>ENVIO</th>' +
                '<th>ITEM</th>' +
                '<th>CANT</th>' +
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

                if (val._order_state == 8) {
                    color = "#f4511e"
                } else if (val._order_state == 9) {
                    color = "#66bb6a";
                } else {
                    color = "#ffee58";
                }

                tb += '<tr>' +
                    '<td style="text-align: center; background-color: ' + color + ';">'+val._description_state+'</td>' +
                    '<td style="text-align: center;"><a href="invoice?o=' + base64_encode(val._order_id) + '&s=' + base64_encode(val._store_id) + '" title="Comprobante" target="_blank"><i class="material-icons">picture_as_pdf</i></a></td>' +
                    '<td style="text-align: center;"><a href="javascript: void(0)" title="Comentarios" onclick="modalComment(' + val._order_id + ',' + val.id + ')""><i class="material-icons"><i class="material-icons">comment</i></a></td>' +
                    '<td style="text-align: center;"><a href="javascript: void(0)" title="Transporte de la compra" onclick="modalTransport(' + val._order_id + ',' + val.id + ')"><i class="material-icons">local_shipping</i></a></td>' +
                    '<td style="text-align: center;"><a href="javascript: void(0)" title="Detalle de la compra" onclick="getItemOrder(' + val._order_id + ')"><i class="material-icons">event_note</i></a></td>' +
                    '<td style="text-align: center;"><a href="javascript: void(0)" title="Timeline de la compra" onclick="timelineOrder(' + val._order_id + ')""><i class="material-icons">timeline</i></a></td>' +
                    '<td style="text-align: center;"><a href="javascript: void(0)" title="Asignar Transporte Manual" onclick="modalTransportManual(' + val._order_id + ',' + val._store_id + ')""><i class="material-icons">move_to_inbox</i></a></td>' +
                    '<td style="text-align: center;"><a href="javascript: void(0)" title="Cambiar Estado del Pedido" onclick="modalChangeState(' + val._order_id + ')""><i class="material-icons">flag</i></a></td>' +
                    '<td>' + val._order_id + '</td>' +
                    '<td>' + bill + '</td>' +
                    '<td>' + office + '</td>' +
                    '<td>' + val._store + '</td>' +
                    '<td>$ ' + number_format(val._total_neto, 2, ",", ".") + '</td>' +
                    '<td>$ ' + number_format(val._total_iva, 2, ",", ".") + '</td>' +
                    '<td>$ ' + number_format(parseInt(val._total_order), 2, ",", ".") + '</td>' +
                    '<td>$ ' + number_format(val._courier_cost, 2, ",", ".") + '</td>' +
                    '<td>' + val._item + '</td>' +
                    '<td>' + val._total_cant + '</td>' +
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

    getListProduct = function() {
        $.ajax({
                url: 'get-list-product',
                type: 'POST',
                dataType: 'json',
                beforeSend: function() {
                    $("#loader2").empty().append(loaderCustom(50, "Buscando"));
                }
            })
            .done(function(response) {
                $("#loader2").empty();


                tb = '<table id="table-product" class="display responsive-table datatable-exampl striped">' +
                    '<thead>' +
                    '<tr>' +
                    '<th style="text-align: right;">ID</th>' +
                    '<th style="text-align: right;">SKU</th>' +
                    '<th style="text-align: right;">PRODUCTO</th>' +
                    '<th style="text-align: right;">STOCK</th>' +
                    '<th style="text-align: right;"></th>' +
                    '<th style="text-align: right;"></th>' +
                    '<th style="text-align: right;"></th>' +
                    '</tr>' +
                    '</thead>' +
                    '<tbody>';
                var i = 1;
                var st;
                $.each(response.list, function(index, val) {
                    tb += '<tr>' +
                        '<th style="text-align: right;">' + val.id + '</th>' +
                        '<th style="text-align: right;">' + val._sku + '</th>' +
                        '<th style="text-align: right;">' + val._product + '</th>' +
                        '<th style="text-align: right;" id="avai' + i + '">' + val._available + '</th>' +
                        '<td style="width: 80px;"><div class="input-field col s12 m6 l12"><input style="text-align: center" type="number" name="cant" id="cantidad' + i + '" min="1" max="' + parseInt(val._available) + '" value="1"></div></td>' +
                        '<th style="text-align: center;"><a href="javascript: void(0)"><i class="material-icons" onclick="includeProduct(' + val._sku + ',' + val.id + ',' + i + ')">system_update_alt</i></a></th>' +
                        '<th style="text-align: right;" id="td1' + i + '"></th>' +
                        '</tr>';
                    i++;

                    st = val._store_id;
                });

                tb += '</tbody></table>';

                $("#tbproductos").empty().append(tb);


                $("#table-product").DataTable({
                    "pageLength": 30,
                    "dom": '<"top"flp<"clear">>rt<"bottom"ifp<"clear">>',
                    "order": [
                        [0, "asc"]
                    ]
                });
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });

    };

    modalProduct = function() {
        $("#modal11").modal('open');
        getListProduct();
    };

    includeProduct = function(sku, prdid, i) {
        var cantidad = $("#cantidad" + i).val();
        var tienda = $("#idstore").val();
        var order = $("#idorder").val();
        $.ajax({
                url: 'include-product',
                type: 'POST',
                dataType: 'json',
                data: {
                    sku: sku,
                    _product_id: prdid,
                    cantidad: cantidad,
                    tienda: tienda,
                    order: order
                },
                beforeSend: function() {
                    $("#td1" + i).empty().append(loaderCustom(50, "incluir"));

                }
            })
            .done(function() {
                $("#td1" + i).empty();
                getItemOrder(order);
                getPurchase();
                getListProduct();
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });

    };
});