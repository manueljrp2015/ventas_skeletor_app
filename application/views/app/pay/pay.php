
<script src="<?= PATH_PUBLIC_PLUGINS."/moment/moment.js" ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS."/moment/moment-with-locales.js" ?>"></script>
<main class="mn-inner">
  <div class="row">
    <div class="col s12">
      <div class="card">
        <div class="card-content">
          <span class="card-title">Declaraciones de Pago</span>
          <div class="row s12 m12 l12">
            <div class="input-field col s12 m6 l12">
              <h5>Consulta tus pagos.</h5>
              <hr style="border: 1px solid #f5f5f5;">
            </div>
            <div class="row">
              <div class="col s12 m6 l12" style="overflow-x: auto; white-space: nowrap;" id="tbpay">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
 </main>
 <link href="<?= PATH_PUBLIC_PLUGINS."/datatables/css/jquery.dataTables.min.css" ?>" rel="stylesheet" type="text/css"/>
<script src="<?= PATH_PUBLIC_PLUGINS."/datatables/js/jquery.dataTables.min.js" ?>"></script>
<script src="<?= PATH_PUBLIC_JS.'/app/app.payment.js' ?>"></script>