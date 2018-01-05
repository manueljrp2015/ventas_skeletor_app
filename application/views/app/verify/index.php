<link href="<?= PATH_PUBLIC_PLUGINS."/datatables/css/jquery.dataTables.min.css" ?>" rel="stylesheet" type="text/css"/>
<script src="<?= PATH_PUBLIC_PLUGINS."/datatables/js/jquery.dataTables.min.js" ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS."/moment/moment.js" ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS."/moment/moment-with-locales.js" ?>"></script>
<script src="<?= PATH_PUBLIC_JS.'/app/app.verify.js' ?>"></script>
<script src="<?= PATH_PUBLIC_JS.'/app/app.cellar.verify.js' ?>"></script>
<main class="mn-inner">
	
	<div class="row">
		<div class="col s12">
			<div class="card">
				<div class="card-content">
					<span class="card-title">Verificar</span>
					<div class="row">
						<h3>Orden: # <?= $this->input->get("order") ?></h3>
						<form id="fmverify">
							<div class="row s12 m12 l12">
								<div class="input-field col s6 m6 l4">
									<input  id="_code" name="_code" type="text" class="autocomplete " class="validate" style="padding: 5px; text-align: right; font-size: 18px; border: 1px solid #BCBCBC; height: 25px;" placeholder="EAN o Codigó">
									<input  id="_order_hidden" name="_order_hidden" type="hidden" value="<?= $this->input->get("order") ?>">
									<input  id="_store_hidden" name="_store_hidden" type="hidden" value="<?= $this->input->get("store") ?>">
									<span class="text-darken-2" style="color: #b0bec5">Puede introducir datos manualmente</span>
								</div>
								<div class="input-field col s4 m6 l2">
									<button type="submit" id="search" class="waves-effect waves-light btn indigo"><i class="material-icons large left">search</i> Buscar</button>
								</div>
							</div>
						</form>
					</div>
					<div class="row">
						<div class="col s6 m6 l6" style="text-align: left;">
							<a class="waves-effect waves-light btn indigo" onclick="refreschTable()" id="refresh"><i class="material-icons left">refresh</i>Refrescar</a>
						</div>
						<div class="col s6 m6 l6" style="text-align: right;">
							<a class="waves-effect waves-light btn red darken-3" onclick="forcedVerify()" id="forced"><i class="material-icons left">refresh</i>Forzar</a>
						</div>
						<div class="col s12 m12 l12">
							<div id="tbitems" style="text-align: center;"></div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</main>

<script type="text/javascript">
  $(function() {

    var order = "<?= $this->input->get('order') ?>";
      refreschTable = function() {
        $("#_code").val('').focus();
          getItemOrder(order);
      };
      getItemOrder(order);
  });
</script>