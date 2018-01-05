$(function() {

    var tbw = $("#table-warehouse");
    tbw.DataTable({
        "pageLength": 35
    });

    var tbw1 = $("#table-warehouses");
    tbw1.DataTable({
        "pageLength": 35
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

    $("#modal2").modal();
    $('#modal2').modal({
        dismissible: false,
        opacity: .3,
        inDuration: 300,
        outDuration: 200,
         startingTop: '10%',
      	endingTop: '0%', 
    });

    openModalAc = function(c) {


        $.ajax({
                url: 'get-product-active-for-store',
                type: 'POST',
                dataType: 'json',
                data: {
                    codproducto: c
                },
                beforeSend: function() {
                    preloader.on();
                }
            })
            .done(function(response) {

                preloader.off();

                tb = "";

                tb += '<table id="table-products" class="display responsive-table datatable-example">' +
                    '<thead>' +
                    '<tr>' +
                    '<th>Cod/Cliente</th>' +
                    '<th>Cliente</th>' +
                    '<th>Codigo</th>' +
                    '<th>Producto</th>' +
                    '<th>Precio/Tienda</th>' +
                    '</tr>' +
                    '</thead>' +
                    '<tbody>';
                var r;
                $.each(response.data, function(index, val) {
                    tb += '<tr>' +
                        '<td align="right"><a href="javascript: void(0)" onclick=findProduct(' + val.id_tienda + ')>' + val.id_tienda + '</a></td>' +
                        '<td align="right"><a href="javascript: void(0)" onclick=findProduct(' + val.id_tienda + ')>' + val.nombre_tienda + '</a></td>' +
                        '<td align="center">' + val.codigo + '</td>' +
                        '<td align="right">' + val.nombre + '</td>' +
                        '<td>' + number_format(val.precio_franquiciado, 2, ",", ".") + '</td>' +
                        '</tr>';

                    r = val.nombre;
                });

                $(".prd").empty().html("Criterio: "+r);

                tb += '</tbody></table>';

                $("#tb-list-store-prod").empty().append(tb);
                $("#table-products").DataTable({
                    "order": [
                        [0, "desc"]
                    ]
                });

                $("#modal1").modal("open");
                console.log("success");
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });


    };


    findProduct =  function(d){
    	 $.getJSON('find-produt-store', {
            id: d
        }, function(json, textStatus) {

            

            tb = "";


            tb += '<table id="table-productss" class="display responsive-table datatable-example">' +
                '<thead>' +
                '<tr>' +
                '<th>Codigo</th>' +
                '<th>Producto</th>' +
                '<th>Estado</th>' +
                '<th>Grupo</th>' +
                '<th>Subgrupo</th>' +
                '<th>Precio</th>' +
            
                '</tr>' +
                '</thead>' +
                '<tbody>';

            var state;
            var r;
          
            $.each(json.list, function(index, val) {

                if (val.activo == "0") {
                    state = "<h5 class='red-text'>inactivo</h5>";
                    icon = 'playlist_add_check';
                    color = 'green';
                    title = "Activar Producto";
                } else {
                    state = "<h5 class='green-text'>activo</h5>";
                    icon = 'delete';
                    color = 'red';
                    title = "Desactivar Producto";
                }


                tb += '<tr>' +
                    '<td align="center">' + val.codigo + '</td>' +
                    '<td align="right">' + val.nombre + '</td>' +
                    '<td align="right">' + state + '</td>' +
                    '<td align="right">' + val.ngrupo + '</td>' +
                    '<td align="right">' + val.sub_grupo + '</td>' +
                    '<td>' + number_format(val.precio_franquiciado, 2, ",", ".") + '</td>' +
                    '</tr>';


            });
            tb += '</tbody></table>';

            $(".prd2").empty().html("Criterio: "+d);

            $("#tb-list-store").empty().append(tb);
            $("#table-productss").DataTable({
                "order": [
                    [0, "desc"]
                ]
            });

            $("#modal2").modal("open");
        });
    };


    openModalIn = function(c) {


        $.ajax({
                url: 'get-product-inactive-for-store',
                type: 'POST',
                dataType: 'json',
                data: {
                    codproducto: c
                },
                beforeSend: function() {
                    preloader.on();
                }
            })
            .done(function(response) {

                preloader.off();

                tb = "";

                tb += '<table id="table-products" class="display responsive-table datatable-example">' +
                    '<thead>' +
                    '<tr>' +
                    '<th>Cod/Cliente</th>' +
                    '<th>Cliente</th>' +
                    '<th>Codigo</th>' +
                    '<th>Producto</th>' +
                    '<th>Precio/Tienda</th>' +
                    '</tr>' +
                    '</thead>' +
                    '<tbody>';
                var r;
                $.each(response.data, function(index, val) {
                    tb += '<tr>' +
                        '<td align="right">' + val.id_tienda + '</td>' +
                        '<td align="right">' + val.nombre_tienda + '</td>' +
                        '<td align="center">' + val.codigo + '</td>' +
                        '<td align="right">' + val.nombre + '</td>' +
                        '<td>' + number_format(val.precio_franquiciado, 2, ",", ".") + '</td>' +
                        '</tr>';

                    r = val.nombre;
                });

                $(".prd").empty().html("Criterio: "+r);

                tb += '</tbody></table>';

                $("#tb-list-store-prod").empty().append(tb);
                $("#table-products").DataTable({
                    "order": [
                        [0, "desc"]
                    ]
                });

                $("#modal1").modal("open");
                console.log("success");
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });


    };

});