<link href="<?= PATH_PUBLIC_PLUGINS."/datatables/css/jquery.dataTables.min.css" ?>" rel="stylesheet" type="text/css"/>
<script src="<?= PATH_PUBLIC_PLUGINS."/datatables/js/jquery.dataTables.min.js" ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS."/moment/moment.js" ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS."/moment/moment-with-locales.js" ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS."/jquery-inputmask/jquery.inputmask.bundle.js" ?>"></script>
<main class="mn-inner">
	<div class="row">
		<div class="col s12">
			<div class="card">
				<div class="card-content">
					<span class="card-title">Configuración de Tiendas o Clientes</span>
					<div class="row">
						<div class="col s12">
							<ul class="tabs tab-demo z-depth-1" style="width: 100%;">
								<li class="tab col s3"><a href="#test1">Creditos</a></li>
								<li class="tab col s3"><a href="#test3" class="active">Recargar</a></li>
								
							</ul>
						</div>
						<div id="test1" class="col s12"><p class="p-v-sm">
							<div class="row">
								<form class="col s12 m12 l12" id="frmpay" action="put-payment">
									<div class="input-field col s12 m6 l4">
										<select name="store_id_5" id="store_id_5" class="js-example-placeholder-multiple js-states form-control" style="width: 100% margin-top: 150px;" >
											<?php foreach (json_decode($listStoreActive) as $key => $value):  ?>
											<option value="<?= $value->id ?>"><?= sprintf("%05d",$value->id)." - ".$value->_store ?></option>
											<?php endforeach; ?>
										</select>
										<input type="hidden" id="id" name="id">
										<span class="text-darken-2" style="color: #b0bec5">Seleeccione los cliente</span>
										<div id="loader9"></div>
									</div>
									
									<div class="input-field col s12 m6 l3">
										<input  id="_credit" name="_credit" type="text" placeholder="Linea de Credito" class="validate" style="padding: 5px; text-align: right; font-size: 14px; border: 1px solid #BCBCBC; margin-top: 5px;""
										<span class="text-darken-2" style="color: #b0bec5">Credito Limite para realizar compras</span>
									</div>
									<div class="input-field col s12 m6 l3">
										<select name="_type_pay" id="_type_pay" class="js-states browser-default" style="width: 100%;text-align: right;">
											<option value="" disabled="" selected=""> </option>
											<option value="CR">Credito</option>
											<option value="CO">Contado</option>
										</select>
										<span class="text-darken-2" style="color: #b0bec5">Forma en que realizara los pagos</span>
									</div>
									<div class="input-field col s12 m6 l2">
										<select name="_form_pay" id="_form_pay" class="js-states browser-default" style="width: 100%; text-align: right;">
											<option value="" disabled="" selected=""> </option>
											<?php
											$dias = 0;
											for ($i=0; $i<13; $i++):
												if($dias == 0){}
													else{
											?>
											<option value="<?= $dias ?>"> <?= $dias ?> dias</option>
											<?php
											}
											$dias = $dias + 15;
											endfor;
											?>
										</select>
										<span class="text-darken-2" style="color: #b0bec5">Condición de pago</span>
									</div>
									
								</div>
								<div class="row">
									<div class="input-field col s12 m6 l2">
										<button type="submit"  class="waves-effect waves-light btn indigo darken-3 m-b-xs" id="btpay">Guardar</button>
									</div>
									<div class="input-field col s12 m6 l6">
										<a href="javascript: void(0)" class="btn indigo darken-3" onclick="getPaymentConditions()"> <i class="material-icons left">refresh</i> Refrescar</a>
										<a href="javascript: void(0)" class="btn indigo darken-3" onclick="printListPayment()"> <i class="material-icons left">print</i> Imprimir Listados</a>
									</div>
								</div>
								<div class="row" id="loader">
								</div>
							</form>
							<div class="row">
								<div id="tbpayment"></div>
							</div>
							<div class="row">
								<div id="modal1" class="modal" style="width: :150px; height: auto;">
									<div class="modal-content">
										<h4>Genere su Reporte</h4>
										<p>Cientes</p>
										<select name="store_id_6" id="store_id_6" class="js-example-placeholder-multiple js-states form-control" style="width: 100%" multiple="multiple">
											<?php foreach (json_decode($listStoreActive) as $key => $value):  ?>
											<option value="<?= $value->id ?>"><?= sprintf("%05d",$value->id)." - ".$value->_store ?></option>
											<?php endforeach; ?>
										</select>
										<input type="hidden" name="id2" id="id2">
										<input type="hidden" name="id3" id="id3">
										<div id="load" style="text-align: center;"></div>
										<div class="file-field input-field col s12 m6 l6">
											<button class="btn waves-effect waves-light indigo darken-3" id="payment">Generar</button>
										</div>
									</div>
									
									<div class="modal-footer">
										<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cerrar</a>
									</div>
								</div>
							</div>
						</p></div>
						
						<div id="test3" class="col s12"><p class="p-v-sm">
							<form class="col s12 m12 l12" id="fmreload">
								<div class="row">
									<div class="input-field col s12 m6 l3">
										<select name="store_id_7" id="store_id_7" class="js-example-placeholder-multiple js-states form-control" style="width: 100% margin-top: 150px;" >
											<option value=""></option>
											<?php foreach (json_decode($listStoreActive) as $key => $value):  ?>
											<option value="<?= $value->id ?>"><?= sprintf("%05d",$value->id)." - ".$value->_store ?></option>
											<?php endforeach; ?>
										</select>
										<input type="hidden" id="id" name="id">
										<span class="text-darken-2" style="color: #b0bec5">Seleeccione los cliente</span>
									</div>
									<div class="input-field col s12 m6 l3">
										<input  id="_credit_2" name="_credit_2" type="text" placeholder="" class="validate" style="padding: 5px; text-align: right; font-size: 14px; border: 1px solid #BCBCBC; margin-top: 5px;" readonly="readonly">
										<label for="_credit_2">Linea de Credito</label>
									</div>
									<div class="input-field col s12 m6 l3">
										<input  id="_balance" name="_balance" type="text" placeholder="" class="validate" style="padding: 5px; text-align: right; font-size: 14px; border: 1px solid #BCBCBC; margin-top: 5px;" readonly="readonly">
										<label for="_balance">Balance</label>
									</div>
									<div class="input-field col s12 m6 l3">
										<input  id="_reload" name="_reload" type="text" placeholder="" class="validate" style="padding: 5px; text-align: right; font-size: 14px; border: 1px solid #BCBCBC; margin-top: 5px;">
										<label for="_reload">Monto Recarga</label>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12 m6 l2">
										<button type="submit"  class="waves-effect waves-light btn indigo darken-3 m-b-xs" id="btpay">Guardar</button>
									</div>
									<div class="input-field col s12 m6 l4">
										<a href="javascript: void(0)" class="btn indigo darken-3" onclick="printListReload()"> <i class="material-icons left">print</i> Imprimir Listados</a>
									</div>
								</div>
								<div class="row" id="loader2">
								</div>
							</form>
							<div class="row">
								<div id="tbpayment-reload"></div>
							</div>
							<div class="row">
								<div id="modal2" class="modal modal-fixed-footer" style="width: :150px; height: 500px;">
									<div class="modal-content">
										<h4>Genere su Reporte</h4>
										<p>Cientes</p>
										<div class="input-field col s12 m6 l12">
											<select name="store_id_6" id="store_id_8" class="js-example-placeholder-multiple js-states form-control" style="width: 100%" multiple="multiple">
												<?php foreach (json_decode($listStoreActive) as $key => $value):  ?>
												<option value="<?= $value->id ?>"><?= sprintf("%05d",$value->id)." - ".$value->_store ?></option>
												<?php endforeach; ?>
											</select>
										</div>
										<div class="input-field col s12 m6 l3">
											<input  id="from" name="from" type="text" placeholder="" class="validate datepicker" style="padding: 5px; text-align: right; font-size: 14px; border: 1px solid #BCBCBC; margin-top: 5px;" readonly="readonly">
											<label for="from">Desde</label>
										</div>
										<div class="input-field col s12 m6 l3">
											<input  id="to" name="to" type="text" placeholder="" class="validate datepicker" style="padding: 5px; text-align: right; font-size: 14px; border: 1px solid #BCBCBC; margin-top: 5px;" readonly="readonly">
											<label for="to">Hasta</label>
										</div>
										<div id="load" style="text-align: center;"></div>
										<div class="input-field col s12 m6 l3">
											<div class="file-field input-field col s12 m6 l6">
												<button class="btn waves-effect waves-light indigo darken-3" id="reload-print">Generar</button>
											</div>
										</div>
									</div>
									
									<div class="modal-footer">
										<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cerrar</a>
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
<script src="<?= PATH_PUBLIC_JS.'/app/app.settings.js' ?>"></script>