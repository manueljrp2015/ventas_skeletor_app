$(document).ready(function() {
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

    $('#_store_pay').select2({
        placeholder: 'Seleccione Cliente...'
    });


    $('#store_id_7').select2({
        placeholder: 'Seleccione Cliente...'
    });


    $('#state').select2({
        placeholder: 'Seleccione Cliente...'
    });


    $("#_store_pay").change(function(event) {
        getPaymentForClient($("#_store_pay").val().toString());
    });

    $("#generar").click(function(event) {
        event.preventDefault();

        var from = $("#from").val();
        var to = $("#to").val();
        var state = $("#state").val();
        var store = $("#store_id_7").val();

        if (state == null) {
            state = "0";
        }

        if (store == null) {
            store = "0";
        }

        if (from == null || from == "") {
            from = "0";
        }

        if (to == null || to == "") {
            to = "0";
        }

        if (to == 0 && from == 0 && state == 0 && store) {
        	swal("Error!", "No se puede generar el reporte ya que no hay criterio de consulta", "error");
        } else {
            window.open("pagos-print?from=" + from +
                "&to=" + to +
                "&state=" + state +
                "&store=" + store, "_blank", "toolbar=no,scrollbars=yes,resizable=no,top=0,left=0,width=4000,height=4000");
        }
    });


    modalChangeState = function(o, s) {
        $("#modal12").modal("open");
        changeState(o, s);
    };

    modalPrint = function(o, s) {
        $("#modalPrint").modal("open");
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
            $.post('change-state-pay', {
                id: $("#_state").val(),
                order: $("#order_id").val(),
                store: $("#store").val()
            }, function(data, textStatus, xhr) {
                console.log(textStatus);
                $("#loader9").empty();
                getPaymentMonth();
                getPay();
                $("#modal12").modal("close");
            });
        });
    });


    changeState = function(o, s) {
        $.ajax({
                url: 'get-state-pay',
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

                if (response.data == "") {
                    var disabled = "disabled='disabled'";
                    $("#btChangeState").attr('disabled', 'disabled');
                } else {
                    var disabled = "";
                    $("#btChangeState").removeAttr('disabled');
                }

                var select = '<input type="hidden" name="order_id" id="order_id" value="' + o + '"><input type="hidden" name="store" id="store" value="' + s + '"><select name="_state" id="_state" class="js-states browser-default" style="width: 100%" ' + disabled + '>';


                $.each(response.data, function(index, val) {
                    disabled
                    select += '<option value="' + val.id + '">' + val._description_state + '</option>'
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


    getPaymentForClient = function(c) {
        $.getJSON('get-pay-client', {
            client: c
        }, function(json, textStatus) {
            createTable(json);
        });
    };

    getPaymentMonth = function() {
        $.getJSON('get-pay-month', {}, function(json, textStatus) {
            createTable(json);
        });
    };

    getPaymentForClientId = function(id) {
        $.getJSON('get-pay-id', {
            id: id
        }, function(json, textStatus) {
            var tbinfo = '<h4><table class="striped">' +
                '<tr>' +
                '<td>Orden Pagada:</td>' +
                '<td>#' + json.data._order_id + '</td>' +
                '</tr>' +
                '<tr>' +
                '<td>Pago:</td>' +
                '<td>' + json.data.paym + '</td>' +
                '</tr>' +
                '<tr>' +
                '<tr>' +
                '<td>Origen:</td>' +
                '<td>' + json.data.bank_ori + '</td>' +
                '</tr>' +
                '<tr>' +
                '<td>Destino:</td>' +
                '<td>' + json.data.bank_dest + '</td>' +
                '</tr>' +
                '<tr>' +
                '<td>Transacción:</td>' +
                '<td><input type="text" name="_transaccion" value="' + json.data._transaccion + '" style="padding-left: 5px;  border: 1px solid #BCBCBC; width: 250px; margin: 0;" disabled="disabled"></td>' +
                '</tr>' +
                '<tr>' +
                '<td>Monto:</td>' +
                '<td><input type="text" name="_transaccion" value="' + json.data._rode + '" style="padding-left: 5px;  border: 1px solid #BCBCBC; width: 250px; margin: 0;" disabled="disabled"></td>' +
                '</tr>' +
                '<tr>' +
                '<td></td>' +
                '<td><button type="submit" disabled="disabled" class="waves-effect waves-light btn indigo">Guardar</button></td>' +
                '</tr>' +
                '</table>';

            var a = moment(json.data._create_at);
            var b = moment(json.data._date_verify);
            var c = moment(json.data._date_verify);
            var d = moment(json.data._date_approved);

            var tbtime = '	<table class="striped">' +
                '<tr>' +
                '<td>Fecha:</td>' +
                '<td>' + moment(json.data._create_at).format("DD-MM-YYYY / h:m:s a") + '</td>' +
                '<td>Declaración de Pago</td>' +
                '</tr>' +
                '<tr>' +
                '<td>Verificación:</td>' +
                '<td>' + moment(json.data._date_verify).format("DD-MM-YYYY / h:m:s a") + '</td>' +
                '<td><strong style="color: #b71c1c">' + moment.duration(b - a).humanize() + '</strong> desde declaración</td>' +
                '</tr>' +
                '<tr>' +
                '<td>Aprobación:</td>' +
                '<td>' + moment(json.data._date_approved).format("DD-MM-YYYY / h:m:s a") + '</td>' +
                '<td><strong style="color: #1b5e20">' + moment.duration(d - c).humanize() + '</strong> desde Verificación</td>' +
                '</tr>' +
                '</table>';

            var tbattach = '<table class="striped" style="border: 1px solid black;">' +
                '<tr>' +
                '<td style="text-align: center;"><a href="../public/files/support-payment/"' + json.data._Athachment + '" target="_blank"><i class="material-icons large">cloud_download</i></a><br>Soporte</td>' +
                '</tr>' +
                '</table>';

            $("#tbinfo").empty().append(tbinfo);
            $("#tbtime").empty().append(tbtime);
            $("#tbattach").empty().append(tbattach);


            $("#modal13").modal("open");
        });
    };

    createTable = function(obj) {
        var tb = '<table id="table-payment" class="display responsive-table datatable-exampl striped">' +
            '<thead>' +
            '<tr>' +
            
            '<th style="text-align: left;">Estado</th>' +
            '<th style="text-align: center;">PEDIDO</th>' +
            '<th style="text-align: right;">CLIENTE</th>' +
            '<th style="text-align: center;">FECHA</th>' +
            '<th style="text-align: center;">MONTO+IVA</th>' +
            '<th style="text-align: center;">#</th>' +
            '<th style="text-align: center;">#</th>' +
            '</tr>' +
            '</thead>' +
            '<tfoot>' +
            '<tr>' +
            '<th></th>' +
           
            '<th>PEDIDO</th>' +
            '<th>#CLIENTE</th>' +
            '<th>#FECHA</th>' +
            '<th style="text-align: center;">MONTO+IVA</th>' +
            '<th style="text-align: center;">#</th>' +
            '<th style="text-align: center;">Estado</th>' +

            '</tr>' +
            '</tfoot>';

        var i = 1;
        var st;
        var color;

        $.each(obj.data, function(index, val) {

            if (val._state_pay < 11) {
                color = "";
                style = "";
            } else if (val._state_pay == 11) {
                color = "#fff9c4";
            } else if (val._state_pay == 12) {
                color = "#81c784";
            }


            tb += '<tr>' +
                
                '<td style="text-align: left;">' + val._description_state + '</td>' +
                '<td style=" text-align: center;">' + val._order_id + '</div></td>' +
                '<th style="text-align: right;">' + val._store + '</th>' +
                '<th style="text-align: center;" id="avai' + i + '">' + moment(val._create_at).format("DD-MM-YYYY") + '</th>' +
                '<th style="text-align: center;">$' + number_format(val._rode,2,",",".") + '</th>' +
                
                '<td style="text-align: center;"><a href="javascript: void(0)" title="información sobre el pago" onclick="getPaymentForClientId(' + val.id + ')" class="btn indigo">Información</a></td>' +
                '<td style="text-align: center;"><a href="javascript: void(0)" title="Cambiar Estado del Pago" onclick="modalChangeState(' + val._order_id + ', ' + val._store_id + ')" class="btn amber darken-3">Cambiar Estado</a></td>' +
                '</tr>';
            i++;

        });
        tb += '</tbody></table>';
        $("#tbpay").empty().append(tb);

        $('#table-payment tfoot th').each(function() {
            var title = $(this).text();
            $(this).html('<input type="text" style="text-align: center;" placeholder="' + title + '" />');
        });


        var table = $("#table-payment").DataTable({
            "pageLength": 50,
            "dom": '<"top"flp<"clear">>rt<"bottom"ifp<"clear">>',
            "order": [
                [0, "asc"]
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
    };

    getPaymentMonth();

    modalPayment = function(o, i, p, s) {
        $("#paylb-order").empty().html("Orden: #" + o);
        $("#_order_id").val(o);
        $("#modal5").modal("open");
        $("#_rode").val(p);
        $("#_store_id").val(s);
    };

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
                        getPaymentMonth();
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


     getPay = function() {
        $.getJSON('get-pay',  function(json, textStatus) {

            var tb = '<table class="table striped" id="table-payments" style="font-size: 14px;">' +
                '<thead>' +
                '<tr>' +
                '<th style="text-align: right;">CLIENTE</th>' +
                '<th style="text-align: center;">PEDIDO</th>' +
                '<th style="text-align: right;">MONTO</th>' +
                '<th style="text-align: center;">FECHA/PEDIDO</th>' +
                '<th style="text-align: center;">VENCE</th>' +
                '<th style="text-align: center;">FECHA/PAGO</th>' +
                '<th style="text-align: center;">#</th>' +
                '<th style="text-align: center;">#</th>' +
                '</tr>' +
                '</thead>' +
                '<tfoot>' +
                '<tr>' +
                '<th style="text-align: right;">CLIENTE</th>' +
                '<th style="text-align: center;">PEDIDO</th>' +
                '<th style="text-align: right;">MONTO</th>' +
                '<th style="text-align: center;">FECHA/PEDIDO</th>' +
                '<th style="text-align: center;">VENCE</th>' +
                '<th style="text-align: center;">FECHA/PAGO</th>' +
                '<th style="text-align: center;">#</th>' +
                '<th style="text-align: center;">#</th>' +
                '</tr>' +
                '</tfoot>' +
                '<tbody>';

                var style;


            $.each(json, function(index, val) {
                var b = moment();
                var a = moment(val._date_create).add(val._paying_to, 'days');

                if(a.diff(b, 'days').toString() > 0 && val._state_pay < 10 && val._state_pay != null){
                    var msgs = '<label style="padding: 6px;background: #bf360c; color: white; font-size: 14px;" >Vencido no Pagado</label>';
                    style = '';
                }
                if(a.diff(b, 'days').toString() > 0 && val._state_pay == null){
                    var msgs = '<label style="padding: 6px;background: #bf360c; color: white; font-size: 14px;" >Sin Pagar</label>';
                    style = '';
                }
                else if(val._state_pay == 10){
                    var msgs = '<label style="padding: 6px;background: #f57f17; color: white; font-size: 14px;" >Pago Declarado</label>';
                   style = "style='pointer-events: none; cursor: default;' disabled='disabled'";
                }

                else if( val._state_pay >= 12){
                    var msgs = '<label style="padding: 6px;background: #2e7d32; color: white; font-size: 14px;" >Pagado</label>';
                    style = "style='pointer-events: none; cursor: default;' disabled='disabled'";
                }
                else if(val._state_pay == 11){
                    var msgs = '<label style="padding: 6px;background: #e53935; color: white; font-size: 14px;" >Verificación</label>';
                    style = "style='pointer-events: none; cursor: default;' disabled='disabled'";
                }
                tb += '<tr>' +
                '<td style = "text-align: right;">'+val._store+'</td>' +
                '<td style = "text-align: center;"> '+val._order_id+' </td>'+
                '<td style = "text-align: right;">$'+number_format(val._total_order,2,",",".")+'</td>' +
                '<td style = "text-align: center;">'+moment(val._date_create).format("DD-MM-YYYY")+'</td>' +
                '<td style = "text-align: center;">'+a.format("DD-MM-YYYY")+'</td>' +
                '<td style = "text-align: center;">'+moment(val._date_approved).format("DD-MM-YYYY")+'</td>' +
                '<td style="text-align: center;"><a href="javascript: void(0)" title="declarar pago" onclick=modalPayment("' + val._order_id + '","' + val.id + '","' + val._total_order + '","'+ val._store_id + '") class="btn green darken-3" '+style+'>declarar</a></td>' +
                '<td style = "text-align: right;">'+msgs+'</td>' +
                '</tr>';
            });

            tb += '</tbody></table>'

            $("#tbpays").empty().append(tb);

            $('#table-payments tfoot th').each(function() {
                var title = $(this).text();
                $(this).html('<input type="text" style="text-align: center;" placeholder="' + title + '" />');
            });


            var table = $("#table-payments").DataTable({
                "pageLength": 30,
                "dom": '<"top"flp<"clear">>rt<"bottom"ifp<"clear">>',
                "order": [
                    [0, "asc"]
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

    getPay();

});