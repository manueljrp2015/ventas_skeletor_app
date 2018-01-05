<script src="<?= PATH_PUBLIC_PLUGINS."/imgLiquid/imgLiquid-min.js" ?>"></script>
<link href="<?= PATH_PUBLIC_PLUGINS."/google-code-prettify/prettify.css" ?>" rel="stylesheet" type="text/css"/>
<script src="<?= PATH_PUBLIC_PLUGINS."/google-code-prettify/prettify.js" ?>"></script>
<script type="text/javascript">
$(function() {

    var i = 1;
    var obj = {};
    var n;

    getListProducts = function(s) {
        $("#start").val('0');
        $("#end").val('30');
        var start = $("#start").val();
        var end = $("#end").val();
        var card = '';
        var price;
        var idtb = 0;
        preloader.on();
        $("#loader1").empty().append(loaderCustom(55, "Buscando Productos, esto puede tardar un poco"));
        $.getJSON('get-list-product-store', {
            start: start,
            end: end,
            store: s
        }, function(json, textStatus) {
            preloader.off();
            var disabled;
            $("#loader1").empty();
            $.each(json, function(index, val) {
                card += '<div class="col s12 m4">' +
                    '<div class="card">' +
                    '<div class="card-image">' +
                    '<div class="imgLiquidFills imgLiquid" style="width:auto; height:400px; background: #fafafa">' +
                    '<img alt="Woody" src="<?= URL_WEB?>' + val._img_thumbs + '">' +
                    '</div> ' +
                    '</div>' +
                    '<div class="card-content">' +
                    '<p style="font-size: 16px;">' + val._product + '</p>';
                if (val._discount > 0) {
            
                    card += '<p style="font-size: 20px; text-align: right;"> $ ' + val._discount + '  / <strong style="text-decoration:line-through; color: red;">' + val._price + ' $</strong></p>';
                    price = val._discount;
                } else {
                    card += '<p style="font-size: 20px; text-align: right;"> $ ' + val._price + '</p>';
                    price = val._price;
                }

                card +=    '<p>#: ' + i + '</p>' +                    
                            '<p>Código: ' + val._sku + '</p>';

                card += '<p>Disponible: <strong id="dp' + i + '" style="font-size: 17px; color: indigo;">' + val._available + '</strong></p>' +
                    '</div>' +
                    '<div class="card-action">' +
                    '<div class="row">' +
                    '<div class="input-field col s5">' +
                    '<input value="0" id="cant' + i + '" name="cant' + i + '" type="text" class="validate" style="padding: 5px; text-align: right; font-size: 22px; border: 1px solid #BCBCBC; ">' +
                    '</div>' +
                    '</div>' +
                    '<a href="javascript: void(0)" class="waves-effect waves-light btn m-b-xs" onclick=chargeCart("' + val._sku + '",' + i + ',' + val._available + ',' + price + ',' + val._producto_id + ')  >Agregar al Carrito</a>' +
                    '</div>' +
                    '</div>' +
                    '</div>';

                i++;

                idtb = val.id;
            });

            console.log(idtb);          

            $("#listProd").empty().append(card);
            $(".imgLiquidFills").imgLiquid({
                fill: false,
                horizontalAlign:  'center',
                verticalAlign: 'center'
            });
        });
    };
    $('pre').addClass('prettyprint');
    prettyPrint();
    getListProductsss = function(s) {

        var start = $("#start").val();
        var end = $("#end").val();
        var card = '';
        var price;
        var idtb = 0;
        $.getJSON('get-list-product-store', {
            start: start,
            end: end,
            store: s
        }, function(json, textStatus) {
            var disabled;
            $.each(json, function(index, val) {
                card += '<div class="col s12 m4">' +
                    '<div class="card">' +
                    '<div class="card-image">' +
                    '<div class="imgLiquidFills imgLiquid" style="width:auto; height:400px;">' +
                    '<img alt="Woody" src="<?= URL_WEB?>' + val._img_thumbs + '">' +
                    '</div> ' +
                    '</div>' +
                    '<div class="card-content">' +
                    '<p style="font-size: 16px;">' + val._product + '</p>';
                if (val._discount > 0) {
                    
                    card += '<p style="font-size: 20px; text-align: right;">$ ' + val._discount + ' / <strong style="text-decoration:line-through; color: red;">$ ' + val._price + ' </strong></p>';
                    price = val._discount;
                } else {
                    card += '<p style="font-size: 20px; text-align: right;">$ ' + val._price + ' </p>';
                    price = val._price;
                }

                card +=    '<p>#: ' + i + '</p>' +                    
                            '<p>Código: ' + val._sku + '</p>';

                card += '<p>Disponible: <strong id="dp' + i + '" style="font-size: 17px; color: indigo;">' + val._available + '</strong></p>' +
                    '</div>' +
                    '<div class="card-action">' +
                    '<div class="row">' +
                    '<div class="input-field col s5">' +
                    '<input value="0" id="cant' + i + '" name="cant' + i + '" style="padding: 5px; text-align: right; font-size: 22px; border: 1px solid #BCBCBC; " type="text" class="validate">' +
                    '</div>' +
                    '</div>' +
                    '<a href="javascript: void(0)" class="waves-effect waves-light btn m-b-xs" onclick=chargeCart("' + val._sku + '",' + i + ',' + val._available + ',' + price + ',' + val._product_id + ')  >Agregar al Carrito</a>' +
                    '</div>' +
                    '</div>' +
                    '</div>';
                i++;
                idtb = val.id;
            });
            $("#listProd").empty().append(card);
            $(".imgLiquidFills").imgLiquid({
               fill: false,
                horizontalAlign:  'center',
                verticalAlign: 'center'
            });
        });
    };
    $('input.autocomplete').autocomplete({
        data: {
            <?php
              foreach ($listProd as $key => $value) {
              ?>
            "<?= str_replace(['"'], " ", $value->_product) ?>" : "<?= URL_WEB.$value->_img_thumbs ?>",
            <?php
              }
              ?>
        },
        onAutocomplete: function(val) {
          if($("#store_id_5").val() == null){
            swal("Atención", "Seleccione una tienda o cliente", "error");
          }
          else{
            $("#active").val('no');
            findProductName(val);
          }
        },
        minLength: 2,
    });

    findProductName = function(q) {
        var start = $("#start").val();
        var end = $("#end").val();
        var card = '';
        var price;
        $.ajax({
                url: 'find-product-for-name',
                type: 'GET',
                dataType: 'json',
                data: {
                    query: q,
                    store: $("#store_id_5").val()
                },
                beforeSend: function(){
                    $("#loader1").empty().append(loaderCustom(55, "Buscando Productos, esto puede tardar un poco"));
                }
            })
            .done(function(json) {
                $("#loader1").empty();
                $.each(json, function(index, val) {
                    card += '<div class="col s12 m4">' +
                        '<div class="card">' +
                        '<div class="card-image">' +
                        '<div class="imgLiquidFills imgLiquid" style="width:auto; height:400px;">' +
                        '<img alt="Woody" src="<?= URL_WEB?>' + val._img_thumbs + '">' +
                        '</div> ' +
                        '</div>' +
                        '<div class="card-content">' +
              
                        '<p style="font-size: 16px;">' + val._product + '</p>';
                    if (val.discount > 0) {
                        card += '<p style="font-size: 20px; text-align: right;">$ ' + val.discount + '  / <strong style="text-decoration:line-through; color: red;">$ ' + val._price + '</strong></p>';
                        price = val.discount;
                    } else {
                        card += '<p style="font-size: 20px; text-align: right;">$ ' + val._price + '</p>';
                        price = val._price;
                    }

                    card +=    '<p>#: ' + i + '</p>' +                    
                            '<p>Código: ' + val._sku + '</p>';

                    card += '<p>Disponible: <strong id="dp' + i + '" style="font-size: 17px; color: indigo;">' + val._available + '</strong></p>' +
                    '<p>LINEA: ' + val.linea + '</p>' +
                        '</div>' +
                        '<div class="card-action">' +
                        '<div class="row">' +
                        '<div class="input-field col s5">' +
                        '<input value="0" id="cant' + i + '" name="cant' + i + '" style="padding: 5px; text-align: right; font-size: 22px; border: 1px solid #BCBCBC; " type="text" class="validate">' +
                        '</div>' +
                        '</div>' +
                        '<a href="javascript: void(0)" class="waves-effect waves-light btn m-b-xs" onclick=chargeCart("' + val._sku + '",' + i + ',' + val._available + ',' + price + ',' + val.id + ')  >Agregar al Carrito</a>' +
                        '</div>' +
                        '</div>' +
                        '</div>';
                    i++;
                });
                $("#listProd").empty().append(card);
                $(".imgLiquidFills").imgLiquid({
                    fill: false,
                    horizontalAlign:  'center',
                    verticalAlign: 'center'
                });
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
    $("#search").click(function(event) {
      if ($("#store_id_5").val() != null && $('input.autocomplete').val() != "") {
        findProductName($('input.autocomplete').val());
      }
      else if($("#store_id_5").val() == null){
        swal("Atención", "Seleccione una tienda o cliente", "error");
        return false;
      }
      else{
        $("#active").val('yes');
        getListProducts($("#store_id_5").val());
      }
    });
});
</script>
<main class="mn-inner">
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <span class="card-title">Adquiere nuestros productos</span>
                    <div class="row s12 m12 l12">
                        <div class="input-field col s12 m12 l12">
                            <h5>Realiza tus pedidos de forma sencilla y rápida con nuestra tienda en línea, gestiona pedidos para diferentes tiendas, clientes o sucursales desde un mismo panel.</h5>
                        </div>
                        <div class="input-field col s12 m12 l4">
                            <select name="store_id_5" id="store_id_5" class="js-states browser-default" style="width: 100%; padding-top: 50px;">
                                <option value="" disabled="" selected=""> </option>
                                <?php foreach (json_decode($listStore) as $key => $value):  ?>
                                <option value="<?= $value->id ?>"><?= sprintf("%05d",$value->id)." - ".$value->_store ?></option>
                                <?php endforeach; ?>
                            </select>
                            <span class="text-darken-2" style="color: #b0bec5">Seleccione una de sus clientes asociados</span>
                            <div id="loader9"></div>
                        </div>
                        <div class="input-field col s12 m12 l6">
                            <input  id="user_v1-query" name="user_v1" type="text" class="autocomplete " class="validate" style="padding: 5px; text-align: right; font-size: 22px; border: 1px solid #BCBCBC; " placeholder="Busqueda por nombre">
                            <span class="text-darken-2" style="color: #b0bec5">Realice una búsqueda rápida de los productos con solo colocar los 3 primeros caracteres.</span>
                            <input id="start" name="start" type="hidden" value="0">
                            <input id="end" name="end" type="hidden" value="30">
                            <input id="idtb" name="idtb" type="hidden" value="0">
                            <input id="active"  type="hidden" value="yes">
                        </div>
                        <div class="input-field col s12 m6 l2">
                            <a href="javascript: void(0)" id="search" class="waves-effect waves-light"><i class="material-icons medium">search</i></a>
                        </div>
                    </div>
                    <div class="row">
                        <div id="loader1" style="text-align: center;">
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m12" id="listProd">
                </div>
            </div>
        </div>
    </div>
</main>
<script src="<?= PATH_PUBLIC_JS."/app/app.orderproduct.js" ?>"></script>