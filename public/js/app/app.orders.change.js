$(function() {
    moment.locale('es');
    var forders = $("#fmbus");
    var fmconfirm = $("#fmconfirm");
    var loader = $("#loader3");
    $(".modal").modal();
    $('.modal').modal({
        dismissible: true,
        opacity: .5,
        inDuration: 300,
        outDuration: 200,
        startingTop: '4%',
        endingTop: '10%'
    });

     //$('#modal1').modal('open');


    fmconfirm.validate({
        ignore: [],
        rules:{
            state:{
                required: true
            },
            obs:{
                required: true
            }
        },
        messages:{
            state:{
                required: "Campo requerido"
            },
            obs:{
                required: "Campo requerido"
            }
        }, 
        submitHandler: function(){
            changeState();
        }
    });

    changeState =  function(){
        $.ajax({
            url: 'change-state-process',
            type: 'POST',
            dataType: 'json',
            data: fmconfirm.serialize(),
            beforeSend: function(){
                preloader.on();
            }
        })
        .done(function(response) {
             preloader.off();
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });
        
    };

     $('#states').select2({
        placeholder: 'Estado'
    });

    var spinner = '<div class="progress"><div class="indeterminate"></div></div>';



    var tbu = $("#table-orders");
    tbu.DataTable();

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

    openModal = function(id){
         $('#modal1').modal('open');
    };

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
                console.log(date.getDate());
                var tbp = '<table class="display responsive-table datatable-example highlight">' +
                    '<thead>' +
                    '<tr>' +
                    '<th>Pedido</th>' +
                    '<th>Total/Pedido</th>' +
                    '<th>transsacciones</th>' +
                    '<th>cant/total</th>' +
                    '<th>Fecha/Inicio</th>' +
                    '<th>Demora</th>' +
                    '<th>#</th>'+
                    '</tr></thead><tbody>'+
                    '<tr>'+
                    '<td>'+response.verify.id_pedido+'</td>'+
                    '<td align="right">'+number_format(response.verify.total_p, 2, ",", ".")+'</td>'+
                    '<td align="center">'+response.verify.transsacciones+'</td>'+
                    '<td>'+response.verify.total_t+'</td>'+
                    '<td align="right">'+response.verify.fecha_inicio+'</td>'+
                    '<td align="right">'+moment(response.verify.fecha_inicio,"YYYYMDD").fromNow()+'</td>'+
                     '<td><span class="red-text darken-4 parpadea">Pedido no finalizado</span></td>'+
                    '</tr></body></table';

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
                     '<th>#</th>' +
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
                    '<th>#</th>' +
                    '</tr>' +
                    '</tfoot>' +
                    '<tbody>';

                $.each(response.list, function(index, val) {
                    console.log(val.nt)
                    tb += '<tr>' +
                        '<td align="center">' + val.id_pedido + '</td>' +
                        '<td align="right">' + val.nt + '</td>' +
                        '<td align="right">' + val.es + '</td>' +
                        '<td align="right">' + val.nu + '</td>' +
                        '<td>' + number_format(val.total_pedido, 2, ",", ".") + '</td>' +
                        '<td>' + val.cantidad_items + '</td>' +
                        '<td>' + val.fecha_inicio + '</td>' +
                        '<td><a href="#" onclick="openModal('+val.id_pedido+')" class="btn-floating btn waves-effect waves-light green"><i class="material-icons">add</i></a></td>' +
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
                if(response.data.msg == "empty"){
                    swal("Liberación para pedido", "La tienda no puede liberarse ya que es probable que este activa para hacer nuevos pedidos o no hay registros e pedidos asociadas a la misma.", "warning");
                }
                else{
                    swal({
                    title: "Liberación para pedido",
                    text: "La tienda "+$("#store option:selected").html()+" ha sido activada para generar nuevos pedidos, el registro afectado PD "+response.data.orders,
                    type: "warning",
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

});