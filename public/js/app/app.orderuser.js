$(document).ready(function() {

    moment.locale('es');
    var tbw1 = $("#table-warehouse");
    tbw1.DataTable({
        "pageLength": 10,
        "order": [
            [2, "desc"]
        ]
    });

    $(".modal").modal();
    $('.modal').modal({
        dismissible: false,
        opacity: .3,
        inDuration: 300,
        outDuration: 200,
        startingTop: '10%',
        endingTop: '0%',
    });


    gifPromo = function(p, cod){
        swal({
            title: "Ejecutar Proceso",
            text: "Estas seguro de realizar este proceso?.",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Agregar Regalo",
            cancelButtonText: "No",
            closeOnConfirm: true,
            closeOnCancel: true
        }, function(isConfirm) {
            if (isConfirm) {
                preloader.on();
                $.post('orders-gif-promo', {
                    order: p,
                    cod: cod
                }, function(data, textStatus, xhr) {
                    preloader.off();

                    swal({
                        title: "Enhorabuena!",
                        text: "has cargado el obsequio!",
                        timer: 4000,
                        showConfirmButton: false
                    });
                    window.setTimeout(function() {
                        window.location.href = window.location.href;
                    }, 4500)
                });
            } else {}
        });

    }

    changeState = function(or, sts) {
        
        swal({
            title: "Ejecutar Proceso",
            text: "Estas seguro de realizar este proceso?.",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Cambiar Estado",
            cancelButtonText: "No",
            closeOnConfirm: true,
            closeOnCancel: true
        }, function(isConfirm) {
            if (isConfirm) {
                preloader.on();
                $.post('orders-change-state', {
                    order: or,
                    sts: sts
                }, function(data, textStatus, xhr) {
                    preloader.off();

                    swal({
                        title: "Enhorabuena!",
                        text: "El pedido ha cambiado de estado",
                        timer: 4000,
                        showConfirmButton: false
                    });
                    window.setTimeout(function() {
                        window.location.href = window.location.href;
                    }, 4500)
                });
            } else {}
        });



    };

    openModal = function(ord) {
        preloader.on();
        $.getJSON('orders-getdet-orders', {
            id: ord
        }, function(json, textStatus) {

            tb = "";

            tb += '<table id="table-products" class="display responsive-table datatable-example" style="overflow-x: auto; white-space: nowrap;">' +
                '<thead>' +
                '<tr>' +
                '<th>LINEA</th>' +
                '<th>COD/PRO</th>' +
                '<th>PRODUCTO</th>' +
                '<th>CANT</th>' +
                '<th>PICKEADO</th>' +
                '<th>VERIFICADO</th>' +
                '<th>TOTAL/LINEA</th>' +
                '</tr>' +
                '</thead>' +
                '<tbody>';

            var r;

            $.each(json, function(index, val) {

                tb += '<tr>' +
                    '<td align="right">' + val.id_linea + '</td>' +
                    '<td align="right">' + val.cod_producto + '</td>' +
                    '<td align="center">' + val.nombre + '</td>' +
                    '<td align="right">' + val.cantidad + '</td>' +
                    '<td>' + val.cantidad_pickeada + '</td>' +
                    '<td align="right">' + val.cantidad_verificada + '</td>' +
                    '<td align="center">' + number_format(val.total_linea, 2, ",", ".") + '</td>' +
                    '</tr>';
            });

            $(".prd").empty().html("Criterio: " + ord);

            tb += '</tbody></table>';

            $("#tb-list-store-prod").empty().append(tb);
            $("#table-products").DataTable({
                "order": [
                    [0, "asc"]
                ]
            });

            $("#modal1").modal("open");
            preloader.off();
        });
    };


    openModal2 = function(ord) {
        preloader.on();
        $.getJSON('orders-getfact-orders', {
            id: ord
        }, function(json, textStatus) {

            tb = "";

            tb += '<table id="table-orders" class="display responsive-table datatable-example" style="overflow-x: auto; white-space: nowrap;">' +
                '<thead>' +
                '<tr>' +
                '<th>FACTURA</th>' +
                '<th>ID/FACTURA</th>' +
                '<th>RUT</th>' +
                '<th>FECHA/CARGA</th>' +
                '<th>TRANSCURSO</th>' +
                '</tr>' +
                '</thead>' +
                '<tbody>';

            var r;

            $.each(json, function(index, val) {

                tb += '<tr>' +
                    '<td align="right">' + val.numero_factura + '</td>' +
                    '<td align="right">' + val.nombre_factura + '</td>' +
                    '<td align="right">' + val.rut + '</td>' +
                    '<td>' + val.dp + '</td>' +
                    '<td>' + moment(val.dp, "DDMYYYY").fromNow() + '</td>' +
                    '</tr>';
            });

            $(".prd2").empty().html("Criterio: " + ord);

            tb += '</tbody></table>';

            $("#tb-list-store-prod2").empty().append(tb);
            $("#table-orders").DataTable({
                "order": [
                    [0, "asc"]
                ]
            });

            $("#modal2").modal("open");
            preloader.off();
        });
    };


});