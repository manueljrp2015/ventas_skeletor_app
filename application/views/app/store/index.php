<script src="<?= PATH_PUBLIC_PLUGINS."/imgLiquid/imgLiquid-min.js" ?>"></script>
<link href="<?= PATH_PUBLIC_PLUGINS."/google-code-prettify/prettify.css" ?>" rel="stylesheet" type="text/css"/>
<script src="<?= PATH_PUBLIC_PLUGINS."/google-code-prettify/prettify.js" ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS."/masonry/masonry.pkgd.min.js" ?>"></script>
<link href="<?= PATH_PUBLIC_CSS."/ribbon.css" ?>" rel="stylesheet" type="text/css"/>
<script type="text/javascript">
$(function() {

    var i = 1;
    var obj = {};
    var n;

    togg = function(ii){
        $("#div_"+ii).slideToggle("swing", function(){
            $("#icon"+ii).html('keyboard_arrow_down');
        });
    }

    getListProducts = function(s) {
        $("#start").val('0');
        $("#end").val('30');
        var start = $("#start").val();
        var end = $("#end").val();
    
        preloader.on();
        $("#listProd").empty().append(loaderCustom(55, "Buscando Productos, esto puede tardar un poco"));
        $.getJSON('get-list-product-store', {
            start: start,
            end: end,
            store: s
        }, function(json, textStatus) {
            preloader.off();
            view(json);
        });
    };


    view = function(obj) {
        var card = '';
        var price;
        var idtb = 0;
        var disabled;
        $("#listProd").empty();
        var ii = 1;
        $.each(obj, function(index, val) {

            if (val.productos == 0) {
                console.log('vacio');
                console.log(val.productos.length);
            } else {



                card += '<span class="black-text"><div class="row"><img src="..' + val.images + '" style="width: 75px;""><p class="flow-text">' + val.linea + '</p><a href="javascript: void(0)" onclick="togg(' + ii + ','+this.element+')"><i class="material-icons" id="icon'+ii+'">keyboard_arrow_up</i></a>';
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

                    card += '<div class="grid-item"><div class="col s12 m12">' +
                        '<div class="card">' +
                        '<div class="card-image">' +
                        '<div class="imgLiquidFills imgLiquid" style="width:auto; height:150px; background: #fafafa">' +
                        '<img class="materialboxed responsive-img" alt="Woody" src="<?= URL_WEB?>' + val._img_thumbs + '">' +
                        '</div> ' +
                        '</div>' +
                        '<div class="card-content"><div class="ribbon-wrapper"><div class="ribbon-color" style="background-color: ' + u_color + ';">' + u_name + '</div></div>';
                     card +=  '<p style="font-size: 9px; text-align: left; color: #e65100;">' + val._group + ' > '+ val._sub_group +'</p>';

                     card +=  '<p style="font-size: 12px;">' + val._product + '</p>';
                    if (val._discount > 0) { 

                        card += '<p style="font-size: 15px; text-align: right;"> $ ' + val._discount + '  / <strong style="text-decoration:line-through; color: red;">' + val._price + ' $</strong></p>';
                        price = val._discount;
                    } else {
                        card += '<p style="font-size: 15px; text-align: right; color: #e65100;"> $ ' + val._price + '</p>';
                        price = val._price;
                    }

                    card += '<p style="text-align: left; font-size: 12px;">#' + val._sku + '</p>';
                    card += '<p style="text-align: left; font-size: 12px;">Disponible: <strong id="dp' + i + '" style=" color: indigo;">' + val._available + '</strong></p>';
                    card += '<p style="text-align: left; font-size: 12px;">' + max_measure + '</p>';
                    card += '<p>' +
                        '<input value="0" id="cant' + i + '" name="cant' + i + '" type="text" class="validate" style="padding: 5px; text-align: center; font-size: 16px; border: 1px solid #BCBCBC; height: 14px; width: 100px;">' +
                        '</<p></p>' +
                        '<p style="text-align: center;">' +
                        '<a href="javascript: void(0)" class="waves-effect waves-light btn indigo m-b-xs" onclick=chargeCart("' + val._sku + '",' + i + ',' + val._available + ',' + price + ',' + val._producto_id + ')  ><i class="material-icons left">add_shopping_cart</i>Agregar</a>' +
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

    $('pre').addClass('prettyprint');
    prettyPrint();
    
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

        $.ajax({
                url: 'find-product-for-name',
                type: 'GET',
                dataType: 'json',
                data: {
                    query: q,
                    store: $("#store_id_5").val()
                },
                beforeSend: function(){
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
                            <strong>Realiza tus pedidos de forma sencilla y rápida con nuestra tienda en línea, gestiona pedidos para diferentes tiendas, clientes o sucursales desde un mismo panel.</strong>
                        </div>
                        <div class="col s12 m12 l4">
                            <select name="store_id_5" id="store_id_5" class="js-states browser-default" style="width: 100%; padding-top: 50px;">
                                <option value="" disabled="" selected=""> </option>
                                <?php foreach (json_decode($listStore) as $key => $value):  ?>
                                <option value="<?= $value->id ?>"><?= sprintf("%05d",$value->id)." - ".$value->_store ?></option>
                                <?php endforeach; ?>
                            </select>
                            <span class="text-darken-2" style="color: #b71c1c">Seleccione una de sus clientes asociados</span>
                            <div id="loader9"></div>
                        </div>
                        <div class="col s12 m12 l4">
                            <input  id="user_v1-query" name="user_v1" type="text" class="autocomplete " class="validate" style="padding: 5px; text-align: right; font-size: 16px; border: 1px solid #BCBCBC; height: 14px;" placeholder="Busqueda por nombre">
                            <span  style="color: #b71c1c;">Realice una búsqueda rápida de los productos con solo colocar los 3 primeros caracteres.</span>
                            <input id="start" name="start" type="hidden" value="0">
                            <input id="end" name="end" type="hidden" value="30">
                            <input id="idtb" name="idtb" type="hidden" value="0">
                            <input id="active"  type="hidden" value="yes">
                        </div>
                        <div class=" col s12 m6 l2">
                            <a href="javascript: void(0)" id="search" class="waves-effect waves-light"><i class="material-icons">search</i></a>
                        </div>
                    </div>
                     <div class="row s12 m12 l12">
                         <div class="col s12 m12 l2">
                            <select name="_line" id="_line" class="js-states browser-default" style="width: 100%; padding-top: 50px;">
                                <option value="" disabled="" selected=""> </option>
                                <option value="1">FINI</option>
                                <option value="3">LA CASA</option>
                                <option value="2">FRIT</option>
                                <option value="4">OTROS</option>
                             
                            </select>
                            <span class="text-darken-2" style="color: #b71c1c">Seleccione una linea</span>
                            <div id="loader9"></div>
                        </div>
                     </div>
                    <div class="row">
                        <div id="loader1" ></div>
                        <div id="listProd" style="text-align: center;">
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</main>
<script src="<?= PATH_PUBLIC_JS."/app/app.orderproduct.js" ?>"></script>