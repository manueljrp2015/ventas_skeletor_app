<link href="<?= PATH_PUBLIC_PLUGINS."/timeline/progress-wizard.min.css" ?>" rel="stylesheet" type="text/css"/>
<script src="<?= PATH_PUBLIC_PLUGINS."/phpjs/base64_encode.js" ?>"></script>
<link href="<?= PATH_PUBLIC_PLUGINS."/css-percentage-circle-master/css/circle.css" ?>" rel="stylesheet" type="text/css"/>
<main class="mn-inner">
  <div class="row">
    <div class="col s12">
      <div class="card">
        <div class="card-content">
          <span class="card-title">Mis Compras</span>
          <div class="row s12 m12 l12">
            <div class="input-field col s12 m6 l12">
              <h5>Consulta tus compras.</h5>
              
              <hr style="border: 1px solid #f5f5f5;">
            </div>
            <div class="row">
              <div class="col s12 m6 l12" id="tbpurchasessummary" style="border-left: 1px solid #f5f5f5;">
              </div>
            </div>
            <div class="row">
              <div class="col s12 m6 l12" id="tbpurchases" style="overflow-x: auto; white-space: nowrap;">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div id="modal2" class="modal">
      <div class="modal-content">
        <h4>Información de Despacho</h4>
        <div class="row">
          <div class="input-field col s2">
            <input placeholder="" id="_envio" name="_envio" class="masked" type="text" readonly="readonly">
            <label for="mask1" class="active">Envio</label>
          </div>
          <div class="input-field col s2">
            <input placeholder="" id="_costo" name="_costo" class="masked" type="text" readonly="readonly">
            <label for="mask1" class="active">Costo</label>
          </div>
          <div class="input-field col s2">
            <input placeholder="" id="_peso" name="_peso" class="masked" type="text" readonly="readonly">
            <label for="mask1" class="active">Peso</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s4">
            <input placeholder="" id="_fechad" name="_fechad" class="masked" type="text" readonly="readonly">
            <label for="mask1" class="active">Fecha de Declaración</label>
          </div>
          <div class="input-field col s4">
            <input placeholder="" id="_fechar" name="_fechar" class="masked" type="text" readonly="readonly">
            <label for="mask1" class="active">Fecha de Retiro</label>
          </div>
          
          <div class="input-field col s4">
            <input placeholder="" id="_contacto" name="_contacto" class="masked" type="text" readonly="readonly">
            <label for="mask1" class="active">Contacto</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s4">
            <input placeholder="" id="_diren" name="_diren" class="masked" type="text" readonly="readonly">
            <label for="mask1" class="active">Direccion de Envio</label>
          </div>
          <div class="input-field col s4">
            <input placeholder="" id="_telef" name="_telef" class="masked" type="text" readonly="readonly">
            <label for="mask1" class="active">Teléfono de Contacto</label>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Salir</a>
      </div>
    </div>
  </div>
  <div class="row">
    <div id="modal3" class="modal modal-fixed-footer" style="width: 1300px; height: 100% !important;">
      <div class="modal-content">
        <h4>Detalle de Compra</h4>
        <h3 style="color: green;" id="lb-order"></h3>
        <div class="row">
          <div id="tbitems">
            
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Salir</a>
      </div>
    </div>
  </div>
  <div class="row">
    <div id="modal4" class="modal" style="width: 1300px; ">
      <div class="modal-content">
        <h4>TimeLine de Tu pedido</h4>
        <h3 style="color: green;" id="tlb-order"></h3>
        <div class="row">
          <div id="timelineorder">
            
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Salir</a>
      </div>
    </div>
  </div>
  <div class="row">
    <div id="modal7" class="modal" style="width: 1300px;">
      <div class="modal-content">
        <h4>Comentario de tu pedido</h4>
        <h3 style="color: green;" id="tlb-order"></h3>
        <div class="row">
          <div class="row">
            <div class="input-field col s12">
              <textarea id="_comment" name="_comment" class="materialize-textarea" length="120"></textarea>
              <input type="hidden" id="_order_i">
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <a class="waves-effect waves-light btn orange m-b-xs" id="btcomment"><i class="material-icons small left">update</i> Actualzizar</a>
              
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Salir</a>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div id="modal13" class="modal" style="width: 600px;">
      <div class="modal-content">
        <h4>Información Adicional</h4>
        <h3 style="color: green;" id="tlb-order"></h3>
        <div class="row">
          <ul class="collapsible popout" data-collapsible="accordion">
            <li>
              <div class="collapsible-header"><i class="material-icons">info</i>Información</div>
              <div class="collapsible-body" id="tbinfo">
              </div>
            </li>
          </ul>
        </div>
        <div class="modal-footer">
          <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Salir</a>
        </div>
      </div>
    </div>
  </div>

</main>
<link href="<?= PATH_PUBLIC_PLUGINS."/datatables/css/jquery.dataTables.min.css" ?>" rel="stylesheet" type="text/css"/>
<script src="<?= PATH_PUBLIC_PLUGINS."/datatables/js/jquery.dataTables.min.js" ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS."/moment/moment.js" ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS."/moment/moment-with-locales.js" ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS."/circular-progress-master/circular-progress.min.js" ?>"></script>
<script src="<?= PATH_PUBLIC_JS.'/app/app.purchases.js' ?>"></script>