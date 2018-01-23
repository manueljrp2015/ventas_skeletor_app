<script src="<?= PATH_PUBLIC_PLUGINS."/imgLiquid/imgLiquid-min.js" ?>"></script>
<link href="<?= PATH_PUBLIC_PLUGINS."/fancybox/jquery.fancybox.min.css" ?>" rel="stylesheet" type="text/css"/>
<script src="<?= PATH_PUBLIC_PLUGINS."/fancybox/jquery.fancybox.min.js" ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS."/masonry/masonry.pkgd.min.js" ?>"></script>
<link href="<?= PATH_PUBLIC_CSS."/ribbon.css" ?>" rel="stylesheet" type="text/css"/>
<script type="text/javascript">
$(function() {
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
});
</script>
<main class="mn-inner">
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <span class="card-title">Adquiere nuestros productos</span>
                    <div class="row s12 m12 l12">
                        <form id="frmstore">
                        <div class="input-field col s12 m12 l12">
                            <strong class="flow-text">Realiza tus pedidos de forma sencilla y rápida con nuestra tienda en línea, gestiona pedidos para diferentes tiendas, clientes o sucursales desde un mismo panel.</strong>
                        </div>
                        <div class="col s12 m12 l4">
                            <select name="store_id_5" id="store_id_5" class="js-states browser-default" style="width: 100%; padding-top: 50px; height: 450px;">
                                <option value="" disabled="" selected=""> </option>
                                <?php foreach (json_decode($listStore) as $key => $value):  ?>
                                <option value="<?= $value->id ?>" onclick="getListProducts()"><?= $value->_store ?></option>
                                <?php endforeach; ?>
                            </select>
                            <span class="text-darken-2" style="color: #212121">Primero debes seleccionar una tienda o cliente asociado a tu cuenta TAMY</span>
                            <div id="loader9"><a href="javascript: void(0)"  class="waves-effect waves-light btn indigo" onclick="getListProducts()"><i class="material-icons left">refresh</i> Recargar</a></div>
                        </div>
                        <div class="col s12 m12 l2">
                            <select name="_line" id="_line" class="js-states browser-default" style="width: 100%; padding-top: 50px;">
                                <option value="" disabled="" selected=""> </option>
                                <?php foreach ($listLine as $key => $value):  ?>
                                <option value="<?= $value->id ?>"><?= $value->_line ?></option>
                                <?php endforeach; ?>
                            </select>
                            <span class="text-darken-2" style="color: #212121">Filtra por linea</span>
                        </div>
                         <div class="col s12 m12 l3">
                            <select name="_cat" id="_cat" class="js-states browser-default" style="width: 100%; padding-top: 50px;">
                                <option value="" disabled="" selected=""> </option>
                                <option value="*">Todas</option>
                                <?php foreach ($listCat as $key => $value):  ?>
                                <option value="<?= $value->id ?>"><?= $value->_group ?></option>
                                <?php endforeach; ?>
                            </select>
                            <span class="text-darken-2" style="color: #212121">Filtra por Categoria</span>
                        </div>
                         <div class="col s12 m12 l3">
                            <select name="_subcat" id="_subcat" class="js-states browser-default" style="width: 100%; padding-top: 50px;">
                                <option value="" disabled="" selected=""> </option>
                                <option value="*">Todas</option>
                                <?php foreach ($listSubCat as $key => $value):  ?>
                                <option value="<?= $value->id ?>"><?= $value->_sub_group ?></option>
                                <?php endforeach; ?>
                            </select>
                            <span class="text-darken-2" style="color: #212121">Filtra por SubCategoria</span>
                        </div>
                    </div>
                    <div class="row s12 m12 l12">
                        <div class="col s12 m12 l12">
                            <input  id="user_v1-query" name="user_v1" type="text" class="autocomplete " class="validate" style="padding: 5px; text-align: right; font-size: 22px; border: 1px solid #BCBCBC; height: 25px; font-family: Light Italic" placeholder="Busqueda por nombre">
                            <span  style="color: #212121;">Tambien puedes buscar por texto rapido con solo colocar los 3 primeros caracteres se te desplegara un resultado con productos que puedes seleccionar.</span>
                            <input id="start" name="start" type="hidden" value="0">
                            <input id="end" name="end" type="hidden" value="30">
                            <input id="idtb" name="idtb" type="hidden" value="0">
                            <input id="active"  type="hidden" value="yes">
                        </div>

                        
                    </div>
                     <div class="row s12 m12 l12">
                         <div class=" col s12 m6 l6">
                            <a href="javascript: void(0)" id="search" class="waves-effect waves-light btn indigo"><i class="material-icons left">search</i> Buscar</a>
                        </div>
                        <div class="col s12 m12 l6 right-align">
                            <a href="javascript: void(0)"  class="waves-effect waves-light btn orange darken-1 pulse" onclick="mycart()"> Termine de Comprar!</a>
                        </div>
                     </div>
                 </form>
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