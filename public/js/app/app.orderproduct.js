$(function() {

    $('select').select2({
        placeholder: 'Tiendas'
    });

    $('#_line').select2({
        placeholder: 'Linea'
    });

    $('#_cat').select2({
        placeholder: 'Categoria'
    });

    $('#_subcat').select2({
        placeholder: 'Subcategoria'
    });


    var i = 1;
    var obj = {};
    var n;

    togg = function(ii) {
        $("#div_" + ii).slideToggle("swing", function() {
            $("#icon" + ii).html('keyboard_arrow_down');
        });
    }

    getListProducts = function() {
        $("#start").val('0');
        $("#end").val('30');
        var start = $("#start").val();
        var end = $("#end").val();

        preloader.on();
        $("#listProd").empty().append(loaderCustom(55, "Buscando Productos, esto puede tardar un poco"));
        $.getJSON('get-list-product-store', {
            start: start,
            end: end,
            store: $("#store_id_5").val()
        }, function(json, textStatus) {
            preloader.off();
            view(json);
        });
    };

    mycart = function() {
        if ($("#store_id_5").val() == null) {
            swal("Atención", "Seleccione una tienda o cliente", "error");
            return false;
        } else {
            window.open("../mi-carrito?store=" + $("#store_id_5").val(), "_top", "");
        }
    };


    view = function(obj) {
        var card = '';
        var price;
        var idtb = 0;
        var disabled;
        $("#listProd").empty();
        var ii = 1;
        var style;
        var hidden;
        var not_available;
        $.each(obj, function(index, val) {

            if (val.productos == 0) {
                console.log('vacio');
                console.log(val.productos.length);
            } else {



                card += '<span class="black-text"><div class="row"><img src="..' + val.images + '" style="width: 75px;""><p class="flow-text">' + val.linea + '</p><a href="javascript: void(0)" onclick="togg(' + ii + ',' + this.element + ')"><i class="material-icons" id="icon' + ii + '">keyboard_arrow_up</i></a>';
                card += '<div class="grid" id="div_' + ii + '">';

                $.each(val.productos, function(index, val) {

                    if (val._und == "UN") {
                        var u_name = "UNIDAD";
                        var u_color = "#ff6f00";
                        var max_measure = "Caja: " + val._max_measure + " Unidades";
                    } else if (val._und == "CJ") {
                        var u_name = "CAJA";
                        var u_color = "#a1887f";
                        var max_measure = "Disponible en unidad";
                    }

                    if (val._available == 0) {
                        style = "style='pointer-events: none; cursor: default;' disabled='disabled'";
                        hidden = "style='display: none;'";
                        not_available = '<strong style="text-decoration:line-through; color: red;">SIN STOCK</strong>';
                    } else {
                        style = "";
                        hidden = "";
                        not_available = '';
                    }

                    card += '<div class="grid-item"><div class="col s12 m12">' +
                        '<div class="card hoverable">' +
                        '<div class="card-image">' +
                        '<div class="imgLiquidFills imgLiquid " style="width:auto; height:150px; background: #fafafa">' +
                        '<a href="../' + val._img_thumbs + '" data-fancybox data-caption="<h4>#' + val._sku + ' – <br /> ' + val._product + '</h4><p><p></p>"><img class="" alt="Woody" src="../' + val._img_thumbs + '"></a>' +
                        '</div> ' +
                        '</div>' +
                        '<div class="card-content"><div class="ribbon-wrapper"><div class="ribbon-color" style="background-color: ' + u_color + ';">' + u_name + '</div></div>';
                    card += '<p style="font-size: 9px; text-align: left; color: #e65100;">' + val._group + ' > ' + val._sub_group + '</p>';

                    card += '<p style="font-size: 11px; text-align: left;">' + val._product + '</p>';
                    if (val._discount > 0) {

                        card += '<p style="font-size: 15px; text-align: right;"> $' + val._discount + '  / <strong style="text-decoration:line-through; color: red;">$' + val._price + ' </strong></p>';
                        price = val._discount;
                    } else {
                        card += '<p style="font-size: 15px; text-align: right; color: #e65100;"> $ ' + val._price + '</p>';
                        price = val._price;
                    }

                    card += '<p style="text-align: left; font-size: 12px;">#' + val._sku + '</p>';
                    card += '<p style="text-align: left; font-size: 12px;">Disponible: <strong id="dp' + i + '" style=" color: indigo;">' + val._available + '</strong></p>';
                    card += '<p style="text-align: left; font-size: 12px;">' + max_measure + '</p>';
                    card += '<p style="text-align: right; font-size: 28px;">' + not_available + '</p>';
                    card += '<p ' + hidden + '>' +
                        '<input value="0" id="cant' + i + '" name="cant' + i + '" type="text" class="validate"  style="padding: 5px; text-align: center; font-size: 16px; border: 1px solid #BCBCBC; height: 14px; width: 100px;">' +
                        '</<p></p>' +
                        '<p style="text-align: center;">' +
                        '<a href="javascript: void(0)" ' + style + ' class="waves-effect waves-light btn indigo m-b-xs" onclick=chargeCart("' + val._sku + '",' + i + ',' + val._available + ',' + price + ',' + val._producto_id + ')  ><i class="material-icons left">add_shopping_cart</i>Agregar</a>' +
                        '</p>' +
                        '</div>' +
                        '</div>' +
                        '</div></div>';
                    i++;
                    idtb = val.id;
                });
            }
            card += '</div></div>';
            ii++;
        });


        $("#listProd").empty().append(card);

        

        $(".imgLiquidFills").imgLiquid({
            fill: false,
            horizontalAlign: 'center',
            verticalAlign: 'center'
        });

        $('.grid').masonry({
            itemSelector: '.grid-item',
            columnWidth: 0,
            gutter: 1,
            horizontalOrder: true,
            percentPosition: true,
        });
    };

    findProductName = function(q) {
        var start = $("#start").val();
        var end = $("#end").val();

        $.ajax({
                url: 'find-product-for-name',
                type: 'GET',
                dataType: 'json',
                data: {
                    query: q,
                    store: $("#store_id_5").val()
                },
                beforeSend: function() {
                    $("#listProd").empty().append(loaderCustom(55, "Buscando Productos, esto puede tardar un poco"));
                }
            })
            .done(function(json) {
                view(json);
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });
    };

    findProductLine = function(q) {
        $.ajax({
                url: 'find-product-for-line',
                type: 'GET',
                dataType: 'json',
                data: {
                    query: $("#_line").val(),
                    store: $("#store_id_5").val(),
                    cat: $("#_cat").val(),
                    subcat: $("#_subcat").val()
                },
                beforeSend: function() {
                    $("#listProd").empty().append(loaderCustom(55, "Buscando Productos, esto puede tardar un poco"));
                }
            })
            .done(function(json) {
                view(json);
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });
    };

    findProductCategories = function(q) {
        $.ajax({
                url: 'find-product-for-categories',
                type: 'GET',
                dataType: 'json',
                data: {
                    query: $("#_line").val(),
                    store: $("#store_id_5").val(),
                    cat: $("#_cat").val(),
                    subcat: $("#_subcat").val()
                },
                beforeSend: function() {
                    $("#listProd").empty().append(loaderCustom(55, "Buscando Productos, esto puede tardar un poco"));
                }
            })
            .done(function(json) {
                view(json);
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });
    };

    $("#store_id_5").change(function(event) {
        $('input.autocomplete').val('');
        getListProducts($("#store_id_5").val());
    });

    $("#_line").change(function(event) {
        if ($("#store_id_5").val() == null) {
            swal("Atención", "Seleccione una tienda o cliente", "error");
            return false;
        } else {
            $('input.autocomplete').val('');
            findProductLine();
        }
    });

    $("#_cat").change(function(event) {
        if ($("#store_id_5").val() == null) {
            swal("Atención", "Seleccione una tienda o cliente", "error");
            return false;
        } else {
            $('input.autocomplete').val('');
            findProductLine();
        }
    });


    $("#_subcat").change(function(event) {
        if ($("#store_id_5").val() == null) {
            swal("Atención", "Seleccione una tienda o cliente", "error");
            return false;
        } else {
            $('input.autocomplete').val('');
            findProductLine();
        }
    });


    $("#search").click(function(event) {
        if ($("#store_id_5").val() != null && $('input.autocomplete').val() != "") {
            findProductName($('input.autocomplete').val());
        } else if ($("#store_id_5").val() == null) {
            swal("Atención", "Seleccione una tienda o cliente", "error");
            return false;
        } else {
            $("#active").val('yes');
            getListProducts($("#store_id_5").val());
        }
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