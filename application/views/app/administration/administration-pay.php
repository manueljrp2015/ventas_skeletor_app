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
					<span class="card-title">Pagos</span>
					<div class="row">
						<div class="col s12">
							<ul class="tabs tab-demo z-depth-1" style="width: 100%;">
								<li class="tab col s3"><a href="#test4">Listado de Pagos</a></li>
							</ul>
						</div>
						<div id="test4" class="col s12">
							<p class="p-v-sm">
								<div class="row">
									<div class="input-field col s12 m6 l4">
										<select name="_store_pay" id="_store_pay" class="js-states browser-default" style="width: 100%"  multiple="multiple">
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
									<div id="modal12" class="modal" style="width: 400px;">
										<div class="modal-content">
											<h4>Cambiar Estado</h4>
											<h3 style="color: green;" id="tlb-order"></h3>
											<div class="row">
												<div class="row">
													<div class="input-field col s12 statess">
														
													</div>
													<div class="input-field col s12">
														<a href="javascript: void(0)" id="btChangeState" class="waves-effect waves-light btn indigo"><i class="material-icons left">traffic</i> Cambiar</a>
													</div>
												</div>
												<div class="row">
													<div id="loader9" style="text-align: center;">
														
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
											<h4>Información de Pago</h4>
											<h3 style="color: green;" id="tlb-order"></h3>
											<div class="row">
												<ul class="collapsible" data-collapsible="accordion">
													<li>
														<div class="collapsible-header"><i class="material-icons">info</i>Información</div>
														<div class="collapsible-body" id="tbinfo">
														</div>
													</li>
													<li>
														<div class="collapsible-header"><i class="material-icons">timeline</i>Timeline</div>
														<div class="collapsible-body" id="tbtime">
														</div>
													</li>
													<li>
														<div class="collapsible-header"><i class="material-icons">attach_file</i>Adjunto</div>
														<div class="collapsible-body" id="tbattach">
																	
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
								<div class="row">
									<div class="col s12 m6 l12">
										<div id="tbpay" style="text-align: center;"></div>
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
<script src="<?= PATH_PUBLIC_JS.'/app/app.administration.pay.js' ?>"></script>