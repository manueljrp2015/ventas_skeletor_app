<link href="<?= PATH_PUBLIC_PLUGINS."/datatables/css/jquery.dataTables.min.css" ?>" rel="stylesheet" type="text/css"/>
<script src="<?= PATH_PUBLIC_PLUGINS."/datatables/js/jquery.dataTables.min.js" ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS."/moment/moment.js" ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS."/moment/moment-with-locales.js" ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS."/phpjs/base64_encode.js" ?>"></script>
<main class="mn-inner">
	
	<div class="row">
		<div class="col s12">
			<div class="card">
				<div class="card-content">
					<span class="card-title">Verificación</span>
					<div class="row">
						<div class="col s12">
							<ul class="tabs tab-demo z-depth-1" style="width: 100%;">
								<li class="tab col s3"><a href="#test4">Verificación</a></li>
							</ul>
						</div>
						<div id="test4" class="col s12">
							<p class="p-v-sm">
								<div class="row">
									<div class="input-field col s12 m6 l4">
										<select name="_store_verify" id="_store_verify" class="js-states browser-default" style="width: 100%">
											<option value="" disabled="" selected=""> </option>
											<?php foreach (json_decode($listStore) as $key => $value):  ?>
											<option value="<?= $value->id ?>"><?= sprintf("%05d",$value->id)." - ".$value->_store ?></option>
											<?php endforeach; ?>
										</select>
										
									</div>
									<div class="input-field col s12 m6 l2">
										<a href="javascript: void(0)" id="search_o" class="waves-effect waves-light btn"><i class="material-icons right">search</i> Buscar</a>
									</div>
								</div>
								<div class="row">
									<div class="col s12 m6 l12">
										<div id="tbpick" style="text-align: center;"></div>
									</div>
								</div>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
<script src="<?= PATH_PUBLIC_JS.'/app/app.cellar.verify.js' ?>"></script>