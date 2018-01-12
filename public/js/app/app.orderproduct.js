$(function() {

    $('select').select2({
        placeholder: 'Tiendas'
    });


    $('#_line').select2({
        placeholder: 'Linea'
    });


    $('#_line').change(function(event) {

       var i = $('#_line').val();
       var ii = parseInt($('#_line').val()) + 1;
      $(".ss").randomize();
    });

    chargeCart = function(sku, i, a, p, idp) {

        var cantidad = $("#cant" + i).val();
        var disponible = $("#dp" + i).html();

        if (parseInt(cantidad) >= parseInt(disponible)) {
            swal("Atención", "Esta intentando comprar (" + sku + ") por una cantidad de (" + $("#cant" + i).val() + ") cuando hay disponibilidad de (" + a + ") lo que indica que esta solictando mas de lo disponible, por lo cual no podra agregarse al carrito de pedido.", "warning");
        } else if ($("#cant" + i).val() <= 0) {
            swal("Atención", "Producto solicitado " + $("#cant" + i).val(), "error");
        } else {

            var result = (parseInt($("#dp" + i).html()) - parseInt($("#cant" + i).val()));
            $("#dp" + i).empty().html(result);
            var data = {
                sku: sku,
                cant: $("#cant" + i).val(),
                precio: p,
                store: $("#store_id_5").val(),
                producto_id: idp
            }

            $.ajax({
                    url: 'put-product-orders',
                    type: 'POST',
                    dataType: 'json',
                    data: data,
                })
                .done(function() {
                    console.log("success");
                    Materialize.toast('Producto (' + sku + ') cargado al carrito cantidad ' + $("#cant" + i).val(), 2000);
                    loadOrder();
                })
                .fail(function() {
                    console.log("error");
                })
                .always(function() {
                    console.log("complete");
                });
        }
    };

    /*$(window).scroll(function() {
        if ($("#active").val() == 'no') {

        } else {
            if ($(window).scrollTop() == $(document).height() - $(window).height()) {
                $("#start").val(parseInt($("#end").val()));
                $("#end").val(parseInt($("#start").val()) + parseInt(30));
                getListProductsss($("#store_id_5").val());
            }
        }
    });*/

});