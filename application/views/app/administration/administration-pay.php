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
								<li class="tab col s3"><a href="#test5">Pedidos</a></li>
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
										<a href="javascript: void(0)" id="search_o" class="waves-effect waves-light btn indigo"><i class="material-icons right">search</i> Buscar</a>
									</div>
								</div>
								<div class="row">
									<a href="javascript: void(0)" class="btn indigo darken-3" onclick="getPaymentMonth()" style='pointer-events: none; cursor: default;'> <i class="material-icons left">refresh</i> Refrescar</a>
									<a href="javascript: void(0)" class="btn indigo darken-3" onclick="modalPrint()"> <i class="material-icons left">print</i> Imprimir Listados</a>
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
														<button type="button" href="javascript: void(0)" id="btChangeState" class="waves-effect waves-light btn indigo"><i class="material-icons left">traffic</i> Cambiar</button>
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
									<div id="modalPrint" class="modal" style="width: 600px;">
										<div class="modal-content">
											<div class="row">
												<h4>Reportes</h4>
												<form id="frmgenerar">
													<p>Cliente</p>
													<div class="file-field input-field col s12 m12 l12">
														<select name="store_id_7" id="store_id_7" class="js-states browser-default" style="width: 100%" multiple="multiple">
															<option value=""></option>
															<option value="*">Todos (*)</option>
															<?php foreach (json_decode($listStore) as $key => $value):  ?>
															<option value="<?= $value->id ?>"><?= sprintf("%05d",$value->id)." - ".$value->_store ?></option>
															<?php endforeach; ?>
														</select>
													</div>
												</div>
												<div class="row">
													<div class="input-field col s12 m6 l3">
														<input  id="from" name="from" type="text" placeholder="" class="validate datepicker" style="padding: 5px; text-align: right; font-size: 14px; border: 1px solid #BCBCBC; margin-top: 5px;">
														<label for="from">Desde</label>
													</div>
													<div class="input-field col s12 m6 l3">
														<input  id="to" name="to" type="text" placeholder="" class="validate datepicker" style="padding: 5px; text-align: right; font-size: 14px; border: 1px solid #BCBCBC; margin-top: 5px;" >
														<label for="to">Hasta</label>
													</div>
												</div>
												<div class="row">
													<p>Estados</p>
													<div class="file-field input-field col s12 m12 l12">
														<select name="state" id="state" class="js-states browser-default" style="width: 100%" multiple="multiple">
															<option value="10" selected="true">PAGO DECLARADO</option>
															<option value="11" selected="true">VERFICANDO PAGO</option>
															<option value="12" selected="true">PAGADO</option>
														</select>
													</div>
													<div id="load2" style="text-align: center;"></div>
													<div class="file-field input-field col s12 m6 l6">
														<button class="btn waves-effect waves-light indigo darken-3" id="generar">Generar</button>
													</div>
												</form>
											</div>
										</div>
										<div class="modal-footer">
											<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cerrar</a>
										</div>
									</div>
								</div>
								<div class="row">
									<div id="modal13" class="modal" style="width: 600px;">
										<div class="modal-content">
											<h4>Información de Pago</h4>
											<h3 style="color: green;" id="tlb-order"></h3>
											<div class="row">
												<ul class="collapsible popout" data-collapsible="accordion">
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
						<div id="test5" class="col s12">
							<p class="p-v-sm">
						
								<div class="row">
									<div class="col s12 m6 l12" style="overflow-x: auto; white-space: nowrap;" id="tbpays">
										
									</div>
								</div>
								<div class="row">
									<div id="modal5" class="modal modal-fixed-footer" style="width: 2048px;">
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
													<div class="file-field input-field col s12 m6 l8">
														<div class="btn teal lighten-1">
															<span>Soporte</span>
															<input type="file" accept="image/*, application/pdf" name="file" id="file" onchange="onLoadFile(event)">
														</div>
														<div class="file-path-wrapper">
															<input class="file-path validate valid" type="text">
														</div>
													</div>
													<div class="file-field input-field col s12 m6 l4">
														<button id="upload-button" type="submit" onclick="return false;" class="btn btn-small waves-effect waves-light teal lighten-2">
														<i class="material-icons left">file_upload</i> Guardar</button>
													</div>
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