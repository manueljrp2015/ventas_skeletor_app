$(document).ready(function() {

    $("#_code").focus();

    var fmpicking = $("#fmpicking");

    fmpicking.validate({
        rules: {
            _code: {
                required: true
            }
        },
        messages: {
            _code: {
                required: "Este dato es requerido"
            }
        },
        submitHandler: function() {
            pickingOrder();

        }
    });

    pickingOrder = function() {
        $.ajax({
                url: 'picking-order',
                type: 'POST',
                dataType: 'json',
                data: fmpicking.serialize(),
                beforeSend: function() {
                    preloader.on();
                }
            })
            .done(function(response) {
                preloader.off();
                if (response.msg === "N/E") {
                    swal("Error!", "Producto no esta asociado a la orden")
                    $("#_code").val('').focus();
                } else {
                    $("#_code").val('').focus();
                    getItemOrder($("#_order_hidden").val());
                }
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });
    };

    

    forcedPicking = function() {


        swal({
            title: "Estas Seguro?",
            text: "Forzar el pedido generara que el total neto sea afectado!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Forzar",
            cancelButtonText: "Cancelar",
            closeOnConfirm: true,
            closeOnCancel: true
        }, function(isConfirm) {
            if (isConfirm) {
                $.post('change-state', {
                    order: $("#_order_hidden").val(),
                    state: 6,
                    action: "picking"
                }, function(data, textStatus, xhr) {
                    $("#_code").attr('disabled', 'disabled');
                    $("#search").attr('disabled', 'disabled');
                    $("#refresh").attr('disabled', 'disabled');
                    $("#forced").attr('disabled', 'disabled');
                    window.opener.getOrderForPicking($("#_store_hidden").val());
                    window.close();
                });
            } else {

            }
        });

    };


    getItemOrder = function(o) {

        $.getJSON('get-item-order-for-pickin', {
            order: o
        }, function(json, textStatus) {

            validatePicking(json.sumary.resto, o);


            tb = '<table id="table-SUMARY" class="display responsive-table datatable-exampl striped">' +
                '<thead>' +
                '<tr>' +
                '<th style="text-align: center;">CANTIDAD</th>' +
                '<th style="text-align: center;">PICKEADO</th>' +
                '<th style="text-align: center;">RESTO</th>' +
                '</tr>' +
                '<tr>' +
                '<td style="text-align: center; font-size: 26px; color: #3949ab;">' + json.sumary.cantidad + '</td>' +
                '<td style="text-align: center; font-size: 26px; color: #ffab00;">' + json.sumary.pickeado + '</td>' +
                '<td style="text-align: center; font-size: 26px; color: #bf360c;">' + json.sumary.resto + '</td>' +
                '</tr>' +
                '</thead></table>';



            tb += '<table id="table-purchases-items" class="display responsive-table datatable-exampl striped">' +
                '<thead>' +
                '<tr>' +
                '<th style="text-align: center;">ORDEN</th>' +
                '<th style="text-align: center;">SKU</th>' +
                '<th style="text-align: center;">EAN</th>' +
                '<th style="text-align: center;">EAN-BOX</th>' +
                '<th style="text-align: center;">DUN</th>' +
                '<th style="text-align: center;">PRODUCTO</th>' +
                '<th style="text-align: center;">STOCK</th>' +
                '<th style="text-align: center;">CANTIDAD</th>' +
                '<th style="text-align: center;">PICKING</th>' +

                '</tr>' +
                '</thead>' +
                '<tbody>';

            var i = 1;
            var st;
            var color;


            $.each(json.data, function(index, val) {

                if (parseInt(val._picking) === 0) {
                    color = "";
                } else if (parseInt(val._picking) < parseInt(val._cant)) {
                    color = "#fff9c4";
                } else if (parseInt(val._picking) === parseInt(val._cant)) {
                    color = "#c8e6c9";
                }



                tb += '<tr style="background-color: ' + color + '">' +
                    '<td style="width: 80px; text-align: center; border-bottom: 2px solid #cfd8dc;">' + parseInt(val._order_picking) + '</div></td>' +
                    '<th style="text-align: center; border-bottom: 2px solid #cfd8dc;">' + val._producto_sku + '</th>' +
                    '<th style="text-align: center; border-bottom: 2px solid #cfd8dc;">' + val._ean + '</th>' +
                    '<th style="text-align: center; border-bottom: 2px solid #cfd8dc;">' + val._ean_pack + '</th>' +
                    '<th style="text-align: center; border-bottom: 2px solid #cfd8dc;">' + val._ean_box + '</th>' +
                    '<th style="text-align: right; border-bottom: 2px solid #cfd8dc;">' + val._product + '</th>' +
                    '<th style="text-align: right; border-bottom: 2px solid #cfd8dc;" id="avai' + i + '">' + val._available + '</th>' +
                    '<td style="width: 80px; text-align: center; border-bottom: 2px solid #cfd8dc;">' + parseInt(val._cant) + '</div></td>' +
                    '<td style="width: 80px; text-align: center; border-bottom: 2px solid #cfd8dc;">' + parseInt(val._picking) + '</div></td>' +
                    '</tr>';
                i++;

                st = val._store_id;
            });
            tb += '</tbody></table>';
            $("#tbitems").empty().append(tb);
        });
    };

    validatePicking = function(r, o) {
        if (r == 0) {
            $("#_code").attr('disabled', 'disabled');
            $("#search").attr('disabled', 'disabled');
            $("#refresh").attr('disabled', 'disabled');
            $("#forced").attr('disabled', 'disabled');
            swal({
                title: "Picking Finalizado",
                text: "Se ha completado con exito el picking del pedido automaticamente se cambiara a estado de COSECHADA",
                type: "success",
                showCancelButton: false,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "OK",
                closeOnConfirm: true
            }, function() {
                $.post('change-state', {
                    order: o,
                    state: 6,
                    action: "picking"
                }, function(data, textStatus, xhr) {
                    window.opener.getOrderForPicking($("#_store_hidden").val());
                    window.close();
                });
            });
        }
    };


});