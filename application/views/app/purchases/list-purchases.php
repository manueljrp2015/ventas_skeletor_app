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
    <div id="modal3" class="modal modal-fixed-footer">
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
    <div id="modal4" class="modal" style="width: 1300px;">
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
      <div id="modal5" class="modal modal-fixed-footer" style="width: 1300px;">
        <div class="modal-content">
          <h3>Pago</h3>
          <h3 style="color: green;" id="paylb-order"></h3>
          <br>
          <form id="fmfile" class="p-v-xs" enctype="multipart/form-data" method="post">
            <div class="row">
              <div class="input-field col s4">
                <select  id="_tipo_pago" name="_tipo_pago">
                  <option value=""></option>
                  <?php
                  foreach ($typePayment as $key => $value) {
                  ?>
                  <option value="<?= $value->id ?>"><?= $value->_type_payment ?></option>
                  <?php } ?>
                </select>
                <label for="mask1" class="active">Tipo de Pago</label>
              </div>
              <div class="input-field col s4">
                
                <select  id="_banco_o" name="_banco_o">
                  <option value=""></option>
                  <?php
                  foreach ($bank as $key => $value) {
                  ?>
                  <option value="<?= $value->id ?>"><?= $value->_bank ?></option>
                  <?php } ?>
                </select>
                <label for="mask1" class="active">Banco de Origen</label>
              </div>
              <div class="input-field col s4">
                <select  id="_banco_d" name="_banco_d">
                  <option value=""></option>
                  <?php
                  foreach ($bank as $key => $value) {
                  if($value->id != 13){}
                  else{
                  ?>
                  <option value="<?= $value->id ?>"><?= $value->_bank ?></option>
                  <?php }} ?>
                </select>
                <label for="mask1" class="active">Banco de Destino</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s4">
                <input placeholder="" id="_transaccion" name="_transaccion" class="masked" type="text" style="font-size: 24px; text-align: right;">
                <input placeholder="" id="_store_id" name="_store_id"  type="hidden" style="font-size: 24px; text-align: right;">
                <label for="mask1" class="active">Transacción / Nro. Cheque</label>
              </div>
              <div class="input-field col s4">
                <input placeholder="" id="_order_id" name="_order_id" class="masked" type="hidden">
                <input placeholder="" id="_datep" name="_datep" class="datepicker picker__input" type="text"  style="font-size: 24px; text-align: right;">
                <label for="mask1" class="active">Fecha de Pago</label>
              </div>
              <div class="input-field col s4">
                <input placeholder="" id="_rode" name="_rode" class="masked" type="text" style="font-size: 24px; text-align: right;">
                <label for="mask1" class="active">Monto</label>
              </div>
            </div>
            <div class="row">
              <div class="file-field input-field col s12 m6 l6">
                <div class="btn teal lighten-1">
                  <span>Soporte</span>
                  <input type="file" accept="image/*, application/pdf" name="file" id="file" onchange="onLoadFile(event)">
                </div>
                <div class="file-path-wrapper">
                  <input class="file-path validate valid" type="text">
                </div>
              </div>
              <button id="upload-button" type="submit" onclick="return false;" class="btn btn-small waves-effect waves-light teal lighten-2">
              <i class="material-icons left">file_upload</i> Guardar</button>
              <div id="info-file"></div>
              <div id="loader10">
                <div id="porcent"></div>
                <div class="progress"><div class="determinate" style="width: 0%" id="process"></div></div>
              </div>
              
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Salir</a>
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