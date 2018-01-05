$(function() {
    moment.locale('es');
    var forders = $("#fmbus");
    var loader = $("#loader3");
    var spinner = '<div class="progress"><div class="indeterminate"></div></div>';

    $('select').select2({
        placeholder: 'Tiendas'
    });

    var tbu = $("#table-orders");
    tbu.DataTable();

    var tbw = $("#table-warehouse");
    tbw.DataTable({
        "pageLength": 35
    });

    
    forders.validate({
        ignore: [],
        rules: {
            store: {
                required: true
            }
        },
        messages: {
            store: {
                required: lang["app_validatio_generic"]
            }
        },
        submitHandler: function() {
            findStore();
        }
    });

    findStore = function() {

        $.ajax({
                url: 'find-store',
                type: 'POST',
                dataType: "json",
                data: forders.serialize(),
                beforeSend: function() {
                    preloader.on();
                    loader.empty();
                    $("#tborders").empty().append(spinner);
                }
            })
            .done(function(response) {
                console.log("success");
                preloader.off();

                var tbp = '';
                var tb = '';

                $(".t1").empty().append((response.analisis.total_p == null) ? 0 : "$ " + number_format(response.analisis.total_p, 2, ",", "."));
                $(".t2").empty().append((response.analisis.transsacciones == "0") ? 0 : response.analisis.transsacciones);
                $(".t3 ").empty().append((response.analisis.total_i == null) ? 0 : response.analisis.total_i);

                date = new Date(response.verify.fecha_inicio);


                var tbp1 = '<h5>Otras razones sociales Asociadas al propietario de la tienda</h5><form id="fmhab"><table class="display responsive-table datatable-example highlight">' +
                    '<thead>' +
                    '<tr>' +
                    '<th>#</th>' +
                    '<th>Tienda</th>' +
                    '<th>Centro/Costo</th>' +
                    '<th>RUT</th>' +
                    '<th>Razon Social</th>' +
                    '<th>Orden/Afectada</th>' +
                    '<th>Estado</th>' +
                    '</tr></thead><tbody>';

                var i = 1;
                var disabled;
                var orden;
                var classe;
                var j = 0;
                if(response.listRazon[0] == "n")
                {
                    
                }
                else{
                $.each(response.listRazon, function(index, val) {


                    if (val.counter == 0) {
                        disabled = "disabled='disabled'";
                        orden = "*";
                        classe = "red-text";
                        j = j + 0;
                    } else {
                        disabled = "";
                        orden = val.pedido_afectado;
                        classe = "green-text parpadea h5";
                        j = j + 1;
                    }
                    tbp1 += '<tr>' +
                        '<th><p class="p-v-xs"><input id="test' + i + '" name="idstore[]" value="' + val.id_tienda + '" type="checkbox" ' + disabled + '><label for="test' + i + '"></label></p></th>' +
                        '<td align="center">' + val.nombre_tienda + '</td>' +
                        '<td align="right">' + val.centro_costo + '</td>' +
                        '<td align="right">' + val.rut + '</td>' +
                        '<td align="right">' + val.nombres + '</td>' +
                        '<td align="right">' + orden + '</td>' +
                        '<td align="right"><h6 class="' + classe + '">' + val.estado + '</h6></td>' +
                        '</tr>';
                    i++;
                });
                console.log(j);
               
                tbp1 += '<tr><td><p class="p-v-xs"><input id="checkall" name="checkall"  type="checkbox"><label for="checkall"></label>Seleccionar Todo</p></td></tr></tbody></table><button class="btn waves-effect waves-light btn yellow darken-2" title="habilitar para pedido" id="process_lote" onclick="return false;">Habilitar Tiendas</button></form><hr><br>';
                $("#result-razon").empty().append(tbp1);

                if(j <= 0){
                    $("#checkall").attr('disabled', 'disabled');
                    $("#process_lote").attr('disabled', 'disabled');
                }
                else {
                    $("#checkall").removeAttr('disabled');    
                    $("#process_lote").removeAttr('disabled');
                }


                $('#checkall').change(function() {
                    var checkboxes = $(this).closest('form').find(':checkbox');
                    if ($(this).is(':checked')) {
                        checkboxes.prop('checked', true);
                    } else {
                        checkboxes.prop('checked', false);
                    }
                });

                $("#process_lote").click(function(event) {

                    if ($('input[name^=idstore]:checked').length <= 0) {
                        swal("Atención", "Debe seleccionar al menos una item o tienda a liberar.", "warning");
                    } else {
                        swal({
                            title: "Liberar Tiendas",
                            text: "Está a punto de liberar varias tiendas para pedido, está de acuerdo con este proceso.",
                            type: "info",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: lang["app_content_msg_confirm_register_btconfirm"],
                            cancelButtonText: lang["app_content_msg_confirm_register_btcancel"],
                            closeOnConfirm: false,
                            closeOnCancel: true
                        }, function(isConfirm) {
                            if (isConfirm) {
                                $.ajax({
                                        url: 'change-states-lotes',
                                        type: 'POST',
                                        dataType: 'json',
                                        data: $("#fmhab").serialize(),
                                        beforeSend: function() {
                                            preloader.on();
                                        }
                                    })
                                    .done(function() {
                                        swal({
                                                title: "Proceso Ejecutado!",
                                                text: "Las tiendas han sido activadas para generar nuevos pedidos",
                                                type: "success",
                                                showCancelButton: false,
                                                confirmButtonColor: "#DD6B55",
                                                confirmButtonText: "Ok",
                                                closeOnConfirm: true
                                            },
                                            function() {
                                                window.location.href = window.location.href;
                                            });
                                    })
                                    .fail(function() {
                                        console.log("error");
                                    })
                                    .always(function() {
                                        console.log("complete");
                                    });
                            } else {

                            }
                        });
                    }
                });
            }

                var tbp = '<h5>Ultimo Pedido realizado</h5><table class="display responsive-table datatable-example highlight">' +
                    '<thead>' +
                    '<tr>' +
                    '<th>Pedido</th>' +
                    '<th>Total/Pedido</th>' +
                    '<th>transsacciones</th>' +
                    '<th>cant/total</th>' +
                    '<th>Estado</th>' +
                    '<th>Fecha/Inicio</th>' +
                    '<th>Ult. Actividad</th>' +
                    '<th>#</th>' +
                    '</tr></thead><tbody>' +
                    '<tr>' +
                    '<td>' + response.verify.id_pedido + '</td>' +
                    '<td align="right">' + number_format(response.verify.total_p, 2, ",", ".") + '</td>' +
                    '<td align="center">' + response.verify.transsacciones + '</td>' +
                    '<td>' + response.verify.total_t + '</td>' +
                    '<td><span class="green-text darken-4 parpadea">' + response.verify.estado+ '</span></td>' +
                    '<td align="right">' + response.verify.fecha_inicio + '</td>' +
                    '<td align="right">' + moment(response.verify.fecha_inicio, "YYYYMDD").fromNow() + '</td>' +
                    '<td><span class="green-text darken-4 parpadea">Pedido a afectar</span></td>' +
                    '</tr></body></table><hr>';

                tb += '<table id="table-orders" class="display responsive-table datatable-example">' +
                    '<thead>' +
                    '<tr>' +
                    '<th>Pedido</th>' +
                    '<th>Tienda</th>' +
                    '<th>Estado</th>' +
                    '<th>Usuario</th>' +
                    '<th>Total</th>' +
                    '<th>Items</th>' +
                    '<th>Fecha/Proceso</th>' +
                    '</tr>' +
                    '</thead>' +
                    '<tfoot>' +
                    '<tr>' +
                    '<th>Pedido</th>' +
                    '<th>Tienda</th>' +
                    '<th>Estado</th>' +
                    '<th>Usuario</th>' +
                    '<th>Total</th>' +
                    '<th>Items</th>' +
                    '<th>Fecha/Proceso</th>' +
                    '</tr>' +
                    '</tfoot>' +
                    '<tbody>';

                $.each(response.list, function(index, val) {

                    tb += '<tr>' +
                        '<td align="center">' + val.id_pedido + '</td>' +
                        '<td align="right">' + val.nt + '</td>' +
                        '<td align="right">' + val.es + '</td>' +
                        '<td align="right">' + val.nu + '</td>' +
                        '<td>' + number_format(val.total_pedido, 2, ",", ".") + '</td>' +
                        '<td>' + val.cantidad_items + '</td>' +
                        '<td>' + val.fecha_inicio + '</td>' +
                        '</tr>';

                });
                tb += '</tbody></table>';
                $("#result-pending").empty().append(tbp);
                $("#tborders").empty().append(tb);
                $("#table-orders").DataTable({
                    "order": [
                        [0, "desc"]
                    ]
                });

            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });

    }



    $("#process").click(function(event) {
        if ($("#store").val() === null) {
            loader.empty().append('<span class="red-text darken-4 parpadea">no hay tienda que habilitar</span>');
        } else {
            swal({
                title: "Liberar Tienda",
                text: "Está a punto de liberar una tienda para pedido, está de acuerdo con este proceso.",
                type: "info",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: lang["app_content_msg_confirm_register_btconfirm"],
                cancelButtonText: lang["app_content_msg_confirm_register_btcancel"],
                closeOnConfirm: false,
                closeOnCancel: true
            }, function(isConfirm) {
                if (isConfirm) {
                    freeOrders($("#store").val());
                } else {

                }
            });
        }
    });

    freeOrders = function(s) {

        $.ajax({
                url: 'free-orders',
                type: 'POST',
                dataType: 'json',
                data: {
                    store: s
                },
                beforeSend: function() {
                    preloader.on();
                }
            })
            .done(function(response) {
                preloader.off();
                if (response.data.msg == "empty") {
                    swal("Liberación para pedido", "La tienda no puede liberarse ya que es probable que este activa para hacer nuevos pedidos o no hay registros e pedidos asociadas a la misma.", "warning");
                } else {
                    swal({
                            title: "Liberación para pedido",
                            text: "La tienda " + $("#store option:selected").html() + " ha sido activada para generar nuevos pedidos, el registro afectado PD " + response.data.orders,
                            type: "success",
                            showCancelButton: false,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Ok",
                            closeOnConfirm: true
                        },
                        function() {
                            window.location.href = window.location.href;
                        });
                }
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });

    };

    habExec = function(id) {
        swal({
            title: "Horario de Tienda",
            text: "Está a punto de alterar el horario de pedido, está de acuerdo con este proceso.",
            type: "info",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: lang["app_content_msg_confirm_register_btconfirm"],
            cancelButtonText: lang["app_content_msg_confirm_register_btcancel"],
            closeOnConfirm: false,
            closeOnCancel: true
        }, function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                        url: 'change-states-time-exec',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            id: id
                        },
                    })
                    .done(function(response) {
                        console.log("success");
                        if (response.data.msg == "hab") {
                            swal({
                                    title: "Tienda Habilitada",
                                    text: "La tienda le ha sido habilitado el horario para generar nuevos pedidos. ",
                                    type: "success",
                                    showCancelButton: false,
                                    confirmButtonColor: "#DD6B55",
                                    confirmButtonText: "Ok",
                                    closeOnConfirm: true
                                },
                                function() {
                                    window.location.href = window.location.href;
                                });
                        } else if (response.data.msg == "dhab") {
                            swal({
                                    title: "Tienda Deshabilitada",
                                    text: "La tienda le ha sido deshabilitado el horario para generar nuevos pedidos. ",
                                    type: "success",
                                    showCancelButton: false,
                                    confirmButtonColor: "#DD6B55",
                                    confirmButtonText: "Ok",
                                    closeOnConfirm: true
                                },
                                function() {
                                    window.location.href = window.location.href;
                                });
                        }
                    })
                    .fail(function() {
                        console.log("error");
                    })
                    .always(function() {
                        console.log("complete");
                    });

            } else {

            }
        });
    };

    $("#forden").click(function(event) {
        event.preventDefault();
        if($("#nordenf").val().length <= 0){
            $("#nordenf").focus();
            return false;
        }

        $.getJSON('get-cost-order', {order: $("#nordenf").val()}, function(json, textStatus) {

               $("#transport1").val(parseFloat(json.data.total_despacho));
               $("#neto_orden1").val(parseFloat(json.data.neto));
               $("#sub_orden1").val(parseFloat(json.data.subtotal));
               $("#iva_orden1").val(parseFloat(json.data.iva));
               $("#total_orden1").val(parseFloat(json.data.total_pedido));

               $("#transport").val(parseFloat(json.data.total_despacho));
               $("#neto_orden").val(parseFloat(json.data.neto));
               $("#sub_orden").val(parseFloat(json.data.subtotal));
               $("#iva_orden").val(parseFloat(json.data.iva));
               $("#total_orden").val(parseFloat(json.data.total_pedido));
                $("#btajust").removeAttr('disabled');
        });
    });

    $("#descuento").bind('change', function(event) {
        window.setTimeout(function(){

            var des = parseInt($("#descuento").val()) / 100;
            var res = parseFloat($("#transport1").val()) * parseFloat(des);
            var nt  = parseFloat($("#transport1").val()) - res;
            var neto = parseFloat($("#neto_orden1").val()) - res;
            var total = parseFloat(neto) * 1.19;
            var iva = total - neto;

            $("#transport").val(Math.round(nt));
            $("#neto_orden").val(Math.round(neto));
            $("#iva_orden").val(Math.round(iva));
            $("#total_orden").val(Math.round(total));
           
        },500);
    });


    var fmfo = $("#fmfo");

    fmfo.validate({
        rules:{
            nordenf:{
                required: true
            },
            descuento:{
                max: 100
            }
        },
        messages:{
            nordenf:{
                required: "Campo requerido"
            },
            descuento:{
                max: "maximo 100%"
            }
        },
        submitHandler: function(){
             swal({
            title: "Ajustar Despacho",
            text: "Está a punto de ajustar costos por concepto de despacho al pedido "+$("#nordenf").val(),
            type: "info",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: lang["app_content_msg_confirm_register_btconfirm"],
            cancelButtonText: lang["app_content_msg_confirm_register_btcancel"],
            closeOnConfirm: true,
            closeOnCancel: true
        }, function(isConfirm) {
            if (isConfirm) {
                saveCostorder();
            }
        });

        }
    });

    saveCostorder = function(){

        $.ajax({
            url: 'save-cost-order',
            type: 'POST',
            dataType: 'json',
            data: fmfo.serialize(),
            beforeSend: function(){
                preloader.on();
            }
        })
        .done(function(response) {
            preloader.off();

            swal({
                    title: "Orden Ajustada",
                    text: "La orden de compra ha sido ajustado. ",
                    type: "success",
                    showCancelButton: false,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Ok",
                    closeOnConfirm: true
                },
                function() {
                    document.getElementById("fmfo").reset();
                    $("#btajust").attr('disabled','disabled');
                });
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });
        
    };



});