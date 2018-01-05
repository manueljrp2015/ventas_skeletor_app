$(function() {
    $('#_type_pay').select2({
        placeholder: 'Tipo de Pago'
    });

    $('#_form_pay').select2({
        placeholder: 'Forma de Pago'
    });

    $('#send').select2({
        placeholder: 'Courier'
    });

    $('#store_id_5, #store_id_6, #store_id_7, #store_id_8').select2({
        placeholder: 'Seleccione Clientes...',
        width: '100%'
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


    var frmpay = $("#frmpay");

    findPayment = function(id, element) {
        preloader.on();
        $("#td_" + element).empty().append(loaderCustom(50, "Buscando"));
        $.getJSON('get-params-store', {
            _id_store: id
        }, function(json, textStatus) {
            preloader.off();
            $("#td_" + element).empty();
            $("#store_id_5").val(json.data._store_id).trigger('change');
            $("#id").val(json.data.id);
            $("#_credit").val(json.data._credit);
            $("#_form_pay").val(json.data._paying_to).trigger('change');
            $("#_type_pay").val(json.data._type_pay).trigger('change');
            $("#btpay").html("Actualizar");
            $("#frmpay").removeAttr('action').attr('action', 'update-payment');
        });

    };



    frmpay.validate({
        ignore: [],
        rules: {
            store_id_5: {
                required: true
            },
            _credit: {
                required: true
            },
            _type_pay: {
                required: true
            },
            _form_pay: {
                required: true
            }
        },
        messages: {
            store_id_5: {
                required: "Campor Requerido",
            },
            _credit: {
                required: "Campor Requerido",
            },
            _type_pay: {
                required: "Campor Requerido",
            },
            _form_pay: {
                required: "Campor Requerido",
            }
        },
        submitHandler: function() {
            swal({
                title: "Ejecutar Proceso",
                text: "Esta seguro de realizar este proceso!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Si, Seguro",
                closeOnConfirm: true
            }, function() {
                savePayment();
            });
        }
    });

    printListPayment = function() {
        $("#modal1").modal('open');
    };

    printListReload = function() {
        $("#modal2").modal('open');
    };


    savePayment = function() {
        $.ajax({
                url: frmpay.attr('action'),
                type: 'POST',
                dataType: 'json',
                data: frmpay.serialize(),
                beforeSend: function() {
                    $("#loader").empty().append(loaderCustom(50, "Actualizando"));
                }
            })
            .done(function(response) {
                $("#loader").empty();
                $("#btpay").html("Guardar");
                $("#frmpay").removeAttr('action').attr('action', 'put-payment');
                document.getElementById("frmpay").reset();
                $("#_form_pay, #_type_pay").val('').trigger('change');
                getPaymentConditions();
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });

    };

    $("#payment").click(function(event) {
        var client = $("#store_id_6").val().toString();
        if (client == null) {
            return false;
        } else {
            window.open("reporte-credito?client=" + client, '_blank');
        }
    });


    $("#reload-print").click(function(event) {
        var client = $("#store_id_8").val().toString();
        var from = $("#from").val().toString();
        var to = $("#to").val().toString();
        if (client == null) {
            return false;
        } else {
            window.open("reporte-recargas-balance?client=" + client + "&from=" + from + "&to=" + to, '_blank');
        }
    });


    $("#modal1").modal({
        complete: function() {
            $("#store_id_6").val('').trigger('change');
        }
    });

    $("#modal2").modal({
        complete: function() {
            $("#store_id_8").val('').trigger('change');
        }
    });



    getPaymentConditions = function() {
        $.ajax({
                url: 'get-list-params-store/',
                type: 'POST',
                dataType: 'json',
                beforeSend: function() {

                }
            })
            .done(function(response) {

                var tb;
                tb += '<table id="tbpayments" class="display responsive-table datatable-example" >' +
                    '<thead>' +
                    '<tr>' +
                    '<th style="border-right: 1px solid #cfd8dc; text-align: center;">ID#</th>' +
                    '<th style="border-right: 1px solid #cfd8dc; text-align: center;">CLIENTE</th>' +
                    '<th style="border-right: 1px solid #cfd8dc; text-align: center;">RUT</th>' +
                    '<th style="border-right: 1px solid #cfd8dc; text-align: center;">CREDITO</th>' +
                    '<th style="border-right: 1px solid #cfd8dc; text-align: center;">BALANCE</th>' +
                    '<th style="border-right: 1px solid #cfd8dc; text-align: center;">CONSUMIDO</th>' +
                    '<th style="border-right: 1px solid #cfd8dc; text-align: center;">FORMA/PAGO</th>' +
                    '<th style="border-right: 1px solid #cfd8dc; text-align: center;">CONDICIÓN</th>' +
                    '<th style="border-right: 1px solid #cfd8dc; text-align: center;">#</th>' +
                    '<th style="border-right: 1px solid #cfd8dc; text-align: center;">#</th>' +
                    '</tr>' +
                    '</thead>' +
                    '<tfoot>' +
                    '<tr>' +
                    '<th>ID#</th>' +
                    '<th>CLIENTE</th>' +
                    '<th>RUT</th>' +
                    '<th>CREDITO</th>' +
                    '<th>FORMA/PAGO</th>' +
                    '<th>CONDICIÓN</th>' +
                    '<th></th>' +
                    '<th></th>' +
                    '</tr>' +
                    '</tfoot>' +
                    '<tbody>';

                var i = 1;

                $.each(response.data, function(index, val) {
                    tb += '<tr>' +
                        '<td style="border: 1px solid #cfd8dc; text-align: center;">' + val.id + '</td>' +
                        '<td style="border: 1px solid #cfd8dc; text-align: right;">' + val._store + '</td>' +
                        '<td style="border: 1px solid #cfd8dc; text-align: center;">' + val._idn + '</td>' +
                        '<td style="border: 1px solid #cfd8dc; text-align: right;">$ ' + number_format(val._credit, 2, ",", ".") + '</td>' +
                        '<td style="border: 1px solid #cfd8dc; text-align: right;">$ ' + number_format(val._balance, 2, ",", ".") + '</td>' +
                        '<td style="border: 1px solid #cfd8dc; text-align: right;">$ ' + number_format(val._consumption, 2, ",", ".") + '</td>' +
                        '<td style="border: 1px solid #cfd8dc; text-align: center;">' + val._type_pay + '</td>' +
                        '<td style="border: 1px solid #cfd8dc; text-align: center;">' + val._paying_to + '</td>' +
                        '<td style="border: 1px solid #cfd8dc; text-align: center;"><a href="javascript: void (0)" class="waves-effect waves-light" onclick="findPayment(' + val._store_id + ', ' + i + ')"><i class="material-icons medium">monetization_on</i></a></td>' +
                        '<td style="border: 1px solid #cfd8dc; text-align: center;" id="td_' + i + '"></td>' +
                        '</tr>';
                    i++;
                });

                tb += '</tbody></table>';

                $("#tbpayment").empty().append(tb);

                $('#tbpayments tfoot th').each(function() {
                    var title = $(this).text();
                    $(this).html('<input type="text" style="text-align: center;" placeholder="' + title + '" />');
                });


                var table = $("#tbpayments").DataTable({
                    "pageLength": 30,
                    "dom": '<"top"flp<"clear">>rt<"bottom"ifp<"clear">>',
                    "order": [
                        [3, "asc"]
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
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });
    };

    getPaymentConditions();



    getReloadCredit = function() {

        $.ajax({
                url: 'get-list-reload/',
                type: 'POST',
                dataType: 'json',
                beforeSend: function() {

                }
            })
            .done(function(response) {

                var tb;
                tb += '<table id="tbrelaod" class="display responsive-table datatable-example" >' +
                    '<thead>' +
                    '<tr>' +
                    '<th style="border-right: 1px solid #cfd8dc; text-align: center;">NRO/RECARGA#</th>' +
                    '<th style="border-right: 1px solid #cfd8dc; text-align: center;">CLIENTE</th>' +
                    '<th style="border-right: 1px solid #cfd8dc; text-align: center;">RUT</th>' +
                    '<th style="border-right: 1px solid #cfd8dc; text-align: center;">RECARGA</th>' +
                    '<th style="border-right: 1px solid #cfd8dc; text-align: center;">FECHA</th>' +
                    '<th style="border-right: 1px solid #cfd8dc; text-align: center;">POR</th>' +
                    '</tr>' +
                    '</thead>' +
                    '<tfoot>' +
                    '<tr>' +
                    '<th>ID#</th>' +
                    '<th>CLIENTE</th>' +
                    '<th>RUT</th>' +
                    '<th>RECARGA</th>' +
                    '<th>FECHA</th>' +
                    '<th>POR</th>' +
                    '</tr>' +
                    '</tfoot>' +
                    '<tbody>';

                var i = 1;

                $.each(response.data, function(index, val) {
                    tb += '<tr>' +
                        '<td style="border: 1px solid #cfd8dc; text-align: center;">' + sprintf("%06d", val.id) + '</td>' +
                        '<td style="border: 1px solid #cfd8dc; text-align: right;">' + val._store + '</td>' +
                        '<td style="border: 1px solid #cfd8dc; text-align: center;">' + val._idn + '</td>' +
                        '<td style="border: 1px solid #cfd8dc; text-align: right;">$ ' + number_format(val._reload, 2, ",", ".") + '</td>' +
                        '<td style="border: 1px solid #cfd8dc; text-align: center;">' + val._create_at + '</td>' +
                        '<td style="border: 1px solid #cfd8dc; text-align: center;">' + val._nickname + '</td>' +
                        '</tr>';
                    i++;
                });

                tb += '</tbody></table>';

                $("#tbpayment-reload").empty().append(tb);

                $('#tbrelaod tfoot th').each(function() {
                    var title = $(this).text();
                    $(this).html('<input type="text" style="text-align: center;" placeholder="' + title + '" />');
                });


                var table = $("#tbrelaod").DataTable({
                    "pageLength": 30,
                    "dom": '<"top"flp<"clear">>rt<"bottom"ifp<"clear">>',
                    "order": [
                        [0, "desc"]
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
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });
    };

    getReloadCredit();

    $("#store_id_7").change(function(event) {
        $.getJSON('get-params-store', {
            _id_store: $("#store_id_7").val()
        }, function(json, textStatus) {
            preloader.off();
            $("#_credit_2").val(json.data._credit);
            $("#_balance").val(json.data._balance)
            $("#_reload").val("");
        });
    });

    var fmreload = $("#fmreload");

    fmreload.validate({
        ignore: [],
        rules: {
            store_id_7: {
                required: true
            },
            _credit_2: {
                required: true,
                number: true
            },
            _reload: {
                required: true,
                number: true
            }
        },
        messages: {
            store_id_7: {
                required: "Campo Requerido"
            },
            _credit_2: {
                required: "Campo Requerido",
                number: "Permitidos solo numeros"
            },
            _reload: {
                required: "Campo Requerido",
                number: "Permitidos solo numeros"
            }
        },
        submitHandler: function() {
            swal({
                title: "Ejecutar Proceso",
                text: "Esta seguro de realizar este proceso!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Si, Seguro",
                closeOnConfirm: true
            }, function() {
                putReload();
            });
        }
    });

    putReload = function() {
        $.ajax({
                url: 'put-reload',
                type: 'POST',
                dataType: 'json',
                data: fmreload.serialize(),
                beforeSend: function() {
                    preloader.on();
                    $("#loader2").empty().append(loaderCustom(50, "Guardando"));
                }
            })
            .done(function() {
                $("#loader2").empty();
                preloader.off();
                getReloadCredit();
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });
    };


});