<link href="<?= PATH_PUBLIC_PLUGINS."/datatables/css/jquery.dataTables.min.css" ?>" rel="stylesheet" type="text/css"/>
<script src="<?= PATH_PUBLIC_PLUGINS."/datatables/js/jquery.dataTables.min.js" ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS."/moment/moment.js" ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS."/moment/moment-with-locales.js" ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS."/jquery-inputmask/jquery.inputmask.bundle.js" ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS."/phpjs/file_get_contents.js" ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS."/phpjs/str_replace.js" ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS."/phpjs/explode.js" ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS."/phpjs/unserialize.js" ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS."/phpjs/base64_encode.js" ?>"></script>
<link href="<?= PATH_PUBLIC_PLUGINS."/timeline/progress-wizard.min.css" ?>" rel="stylesheet" type="text/css"/>
<link href="<?= PATH_PUBLIC_PLUGINS."/css-percentage-circle-master/css/circle.css" ?>" rel="stylesheet" type="text/css"/>
<main class="mn-inner">
	
	<div class="row">
		<div class="col s12">
			<div class="card">
				<div class="card-content">
					<span class="card-title">Manejador de ordenes</span>
					<div class="row">
						<div class="col s12">
							<ul class="tabs tab-demo z-depth-1" style="width: 100%;">
								<li class="tab col s3"><a href="#test4">Ordenes</a></li>
							</ul>
						</div>
						<div id="test4" class="col s12">
							<p class="p-v-sm">
								<div class="row">
									<div class="col s12 m6 l12" id="tbpurchases" style="overflow-x: auto; white-space: nowrap;">
									</div>
								</div>
							</p>
						</div>
					</div>
					<div class="row">
						<div id="modal2" class="modal" style="width: 1300px;">
							<div class="modal-content">
								<h4>Información de Despacho</h4>
								<div class="row">
									<div class="input-field col s2">
										<input placeholder="" id="_envio" name="_envio" class="masked" type="text" style="padding: 5px; text-align: right; font-size: 14px; border: 1px solid #BCBCBC; margin-top: 5px;">
										<label for="mask1" class="active">Envio</label>
									</div>
									<div class="input-field col s2">
										<input placeholder="" id="_costo" name="_costo" class="masked" type="text" style="padding: 5px; text-align: right; font-size: 14px; border: 1px solid #BCBCBC; margin-top: 5px;">
										<label for="mask1" class="active">Costo</label>
									</div>
									<div class="input-field col s2">
										<input placeholder="" id="_peso" name="_peso" class="masked" type="text" style="padding: 5px; text-align: right; font-size: 14px; border: 1px solid #BCBCBC; margin-top: 5px;">
										<label for="mask1" class="active">Peso</label>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s4">
										<input placeholder="" id="_fechad" name="_fechad" class="masked" type="text" style="padding: 5px; text-align: right; font-size: 14px; border: 1px solid #BCBCBC; margin-top: 5px;">
										<label for="mask1" class="active">Fecha de Declaración</label>
									</div>
									<div class="input-field col s4">
										<input placeholder="" id="_fechar" name="_fechar" class="masked" type="text" style="padding: 5px; text-align: right; font-size: 14px; border: 1px solid #BCBCBC; margin-top: 5px;">
										<label for="mask1" class="active">Fecha de Retiro</label>
									</div>
									
									<div class="input-field col s4">
										<input placeholder="" id="_contacto" name="_contacto" class="masked" type="text" style="padding: 5px; text-align: right; font-size: 14px; border: 1px solid #BCBCBC; margin-top: 5px;">
										<label for="mask1" class="active">Contacto</label>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s4">
										<input placeholder="" id="_diren" name="_diren" class="masked" type="text" style="padding: 5px; text-align: right; font-size: 14px; border: 1px solid #BCBCBC; margin-top: 5px;">
										<label for="mask1" class="active">Direccion de Envio</label>
									</div>
									<div class="input-field col s4">
										<input placeholder="" id="_telef" name="_telef" class="masked" type="text" style="padding: 5px; text-align: right; font-size: 14px; border: 1px solid #BCBCBC; margin-top: 5px;">
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
						<div id="modal3" class="modal modal-fixed-footer" style="width: 1500px;">
							<div class="modal-content">
								<h4>Detalle de Compra</h4>
								<h3 style="color: green;" id="lb-order"></h3>
								<input type="hidden" name="idstore" id="idstore">
								<input type="hidden" name="idorder" id="idorder">
								<div class="row">
									<a class="waves-effect waves-light btn indigo" onclick="modalProduct()"><i class="material-icons left">add_shopping_cart</i> Incluir Productos</a>
									<div id="tbitems">
									</div>
									<div id="loader1" style="text-align: center;">
										
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Salir</a>
							</div>
						</div>
					</div>
					<div class="row">
						<div id="modal11" class="modal modal-fixed-footer" style="width: 1500px;">
							<div class="modal-content">
								<h4>Lista de Productos</h4>
								<h3 style="color: green;" id="lb-order"></h3>
								<div class="row">
									<div id="tbproductos">
									</div>
									<div id="loader2" style="text-align: center;">
										
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
											<textarea id="_comment" name="_comment" class="materialize-textarea" length="120" readonly="readonly"></textarea>
											<input type="hidden" id="_order_i">
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
						<div id="modal10" class="modal" style="width: 500px;">
							<div class="modal-content">
								<h4>Despacho por TNT</h4>
								<h3 style="color: green;" id="tlb-order"></h3>
								<form class="col s12 m12 l12" id="frmtr" action="put-product">
									<div class="row">
										<div class="row">
											<div class="input-field col s12 m6 l3">
												<input  id="_ancho" name="_ancho" type="text" placeholder="" class="validate" style="padding: 5px; text-align: right; font-size: 14px; border: 1px solid #BCBCBC; margin-top: 5px;">
												<label for="store">Ancho <strong style="color: red;">*</strong></label>
												<span class="text-darken-2" style="color: #b0bec5">Centimetros</span>
											</div>
											<div class="input-field col s12 m6 l3">
												<input  id="_largo" name="_largo" type="text" placeholder="" class="validate" style="padding: 5px; text-align: right; font-size: 14px; border: 1px solid #BCBCBC; margin-top: 5px;">
												<label for="store">Largo <strong style="color: red;">*</strong></label>
												<span class="text-darken-2" style="color: #b0bec5">Centimetros</span>
											</div>
											<div class="input-field col s12 m6 l3">
												<input  id="_alto" name="_alto" type="text" placeholder="" class="validate" style="padding: 5px; text-align: right; font-size: 14px; border: 1px solid #BCBCBC; margin-top: 5px;">
												<label for="store">Alto <strong style="color: red;">*</strong></label>
												<span class="text-darken-2" style="color: #b0bec5">Centimetros</span>
											</div>
											<div class="input-field col s12 m6 l3">
												<input  id="_peso_m" name="_peso_m" type="text" placeholder="" class="validate" style="padding: 5px; text-align: right; font-size: 14px; border: 1px solid #BCBCBC; margin-top: 5px;">
												<label for="store">Peso <strong style="color: red;">*</strong></label>
												<span class="text-darken-2" style="color: #b0bec5">Kilogramos</span>
											</div>
										</div>
										<div class="row">
											<div class="input-field col s12 m6 l6">
												<input  id="_total" name="_total" type="text" placeholder="" class="validate" style="padding: 5px; text-align: right; font-size: 18px; border: 1px solid #BCBCBC; " readonly="readonly">
												<input  id="_order_id" name="_order_id" type="hidden" placeholder="" class="validate"  readonly="readonly">
												<input  id="_store_id" name="_store_id" type="hidden" placeholder="" class="validate"  readonly="readonly">
												<span class="text-darken-2" style="color: #b0bec5">Monto a Cancelar</span>
											</div>
											<div class="input-field col s12 m6 l6">
												<a id="calculate" class="waves-effect waves-light" ><i class="material-icons medium">monetization_on</i>
												</a>
											</div>
											<div class="input-field col s12 m6 l12">
												<p class="p-v-xs">
													<input class="filled-in" id="notransport" name="notransport"  type="checkbox">
													<label for="notransport">No Cobrar Despaho</label>
												</p>
											</div>
										</div>
										<div class="row">
											
											<div class="input-field col s12 m6 l6">
												<button type="submit" class="waves-effect waves-light btn indigo" ><i class="material-icons left">save</i>Grabar</button>
											</div>
										</div>
										<div class="row">
											<div id="loader3" style="text-align: center;">
												
											</div>
										</div>
									</div>
								</form>
								<div class="modal-footer">
									<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Salir</a>
								</div>
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
<script src="<?= PATH_PUBLIC_PLUGINS."/moment/moment.js" ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS."/moment/moment-with-locales.js" ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS."/circular-progress-master/circular-progress.min.js" ?>"></script>
<script src="<?= PATH_PUBLIC_JS.'/app/app.cellar.js' ?>"></script>