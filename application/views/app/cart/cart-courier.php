<main class="mn-inner">
	<div class="row">
		<div class="col s12">
			<div class="card">
				<div class="card-content">
					<span class="card-title">Proceso final</span>
					<div class="row">
						<div class="col s12 m12 l4">
							Orden: <label class="green-text" style="font-size: 16px;"><?= $this->input->get("order") ?></label>
						</div>
						<div class="col s12 m12 l8">
							
						</div>
						
					</div>
					<div class="row">
						<div class="col s12 m6 l8 flow-text">
							Para terminar de culminar con su pedido debe seleccionar la forma de envío, actualmente trabajamos aliados comerciales para traslado de mercancía, si decide enviarlo a través de otro método por favor indíquelo en el formulario. Recuerde que también tiene la opción de retirar su pedido en nuestras bodegas. <strong style="color: #d32f2f;">Si no selecciona ninguna opción de retiro los costos de envió serán cargados en bodega con previo acuerdo.</strong>
							<p>
								<div class="col s12 m6">
								<div class="card small">
									<div class="card-image">
										<img src="<?= PATH_PUBLIC_IMG."/tnt-logo.svg" ?>" alt="" width="120px">
										
									</div>
									<div class="card-content">
										<p>Aliado Comercial Para Envios</p>
									</div>
									<div class="card-action">
										<a href="#">ir al Sitio</a>
									</div>
								</div>
							</div>
							</p>
							<br>
							<?php
							if($resumenOrder->idco == null){
							?>
							<div class="col s12 l12">
								<strong style="color: #1a237e;">Si deseas que enviemos tu orden por nuestros aliados comerciales no selecciones ninguna de las opciones de despacho y acepta conforme tu pedido, los cargos por estos servicios seran cargados en la bodega principal .</strong>
								<h5>Selecciona por donde te despacharemos</h5>
								<ul class="collapsible popout collapsible-accordion" data-collapsible="accordion">
									<!--<li class="disabled">
											<div class="collapsible-header"><i class="material-icons">local_shipping</i>TNT o Tamy</div>
											<div class="collapsible-body" style="display: none;">
												<br>
													<div class="row">
															
																<div class="row">
																		<div class="input-field col s12 green-text" id="msgcour1">
																		</div>
																</div>
																<form class="col s12" id="frmtnt">
																	<div class="row">
																			<div class="input-field col s4">
																				<input id="_factor" name="_factor"  type="hidden">
																				<input id="_param" name="_param"  type="hidden">
																				<input id="_total_weight" name="_total_weight"  type="hidden">
																				<input id="order_id" name="order_id"  type="hidden">
																				<input id="store_id" name="store_id"  type="hidden">
																				<input id="_type_courier" name="_type_courier" value="1"  type="hidden">
															<input id="_order_id" name="_order_id" value="<?= $this->input->get("order") ?>"  type="hidden">
															<input id="_pay" name="_pay" type="text" style="text-align: right; font-size: 20px;">
															<label for="_pay" class="active"></label>
														</div>
														<div class="input-field col s4">
															<a class="waves-effect waves-teal white btn" id="calculate">Calcular</a>
														</div>
														<div class="input-field col s4">
															<a href="javascript: void(0)" id="saveTnt" class="waves-effect waves-light btn orange m-b-xs"> Guardar</a>
														</div>
													</div>
												</form>
											</div>
											
										</div>
									</li>-->
									<li class="">
										<div class="collapsible-header"><i class="material-icons">store_mall_directory</i>Nuestra Bodega TAMY</div>
										<div class="collapsible-body" style="display: none;">
											<br>
											<div class="row">
												<form class="col s12" id="frmbodega">
													<div class="row">
														<div class="input-field col s12 m12 l8">
															<input placeholder="" id="_contact" name="_contact" class="validate" type="text" style="padding: 5px; text-align: right; font-size: 14px; border: 1px solid #BCBCBC; margin-top: 5px; height: 25px;">
															<label for="_contact" class="active" style="color: #1a237e;"><strong>Quien Retira el pedido?</strong></label>
														</div>
														<div class="input-field col s12 m12 l4">
															<input id="_cel_contact" name="_cel_contact" class="validate" type="text" placeholder="" style="padding: 5px; text-align: right; font-size: 14px; border: 1px solid #BCBCBC; margin-top: 5px; height: 25px;">
															<label for="_cel_contact" style="color: #1a237e;"><strong>Teléfono de quien retira?</strong></label>
														</div>
													</div>
													
													<div class="row">
														<div class="input-field col s12 m12 l3">
															<input id="_type_courier2" name="_type_courier2" value="2"  type="hidden">
															<input id="_order_id" name="_order_id" value="<?= $this->input->get("order") ?>"  type="hidden">
															<input id="_store_id" name="_store_id" value="<?= $resumenOrder->_store_id ?>"  type="hidden">
															<input id="_date_courier" name="_date_courier" class="datepicker picker__input" readonly="" tabindex="-1" aria-haspopup="true" aria-expanded="false" aria-readonly="false" aria-owns="birthdate_root" type="text" >
															<label for="first_name" class="active" style="color: #1a237e;"><strong>Fecha en que Retirara?</strong></label>
														</div>
														<div class="input-field col s12 m12 l3">
															<select name="_horario" id="_horario" style="padding: 5px; text-align: right; font-size: 14px; border: 1px solid #BCBCBC; margin-top: 5px; height: 25px;">
																<option value="" selected>Seleccione una opcion</option>
																<?php
																for($i = 8; $i <= 18; $i++):
																?>
																<option value="<?= sprintf("%02d",$i).":00" ?>"><?= sprintf("%02d",$i).":00" ?></option>
																<?php
																endfor;
																?>
															</select>
															<label style="color: #1a237e;"><strong>Horario</strong></label>
														</div>
														<div class="input-field col s4">
															<button type="submit"  class="waves-effect waves-light btn orange m-b-xs">Guardar</button>
														</div>
													</div>
												</form>
											</div>
										</div>
									</li>
									<li>
										<div class="collapsible-header"><i class="material-icons">local_convenience_store</i>Otro Medio de Retiro</div>
										<div class="collapsible-body" style="">
											<br>
											<div class="row">
												<form class="col s12" id="frmotros">
													<div class="row">
														<div class="input-field col s12">
														</div>
													</div>
													<div class="row">
														<input id="_type_courier3" name="_type_courier3" value="3"  type="hidden">
														<div class="input-field col s6">
															<input id="_order_id" name="_order_id" value="<?= $this->input->get("order") ?>"  type="hidden">
															<input id="_store_id" name="_store_id" value="<?= $resumenOrder->_store_id ?>"  type="hidden">
															<input placeholder="" id="_contact" name="_contact" class="validate" type="text">
															<label for="_contact" class="active" style="color: #1a237e;"><strong>Quien Retira el Pedido?</strong></label>
														</div>
														<div class="input-field col s6">
															<input id="_cel_contact" name="_cel_contact" class="validate" type="text" placeholder="">
															<label for="_cel_contact" style="color: #1a237e;"><strong>Teléfono de quien Retira?</strong></label>
														</div>
														
													</div>
													<div class="row">
														<div class="input-field col s12">
															<input id="_dir" name="_dir" class="validate" type="text" placeholder="">
															<label for="_dir" style="color: #1a237e;"><strong>Dirección a donde se enviara?</strong></label>
														</div>
													</div>
													<div class="row">
														<div class="input-field col s12">
															<input id="_emp" name="_emp" class="validate" type="text" placeholder="">
															<label for="_emp" style="color: #1a237e;"><strong>Empresa de Transporte por el cual se enviara el pedido?</strong></label>
														</div>
													</div>
													<div class="row">
														<div class="input-field col s4">
															<button type="submit"  class="waves-effect waves-light btn orange m-b-xs">Guardar</button>
														</div>
													</div>
													
												</form>
											</div>
										</div>
									</li>
								</ul>
							</div>
							<?php
							}
							else{}
							?>
						</div>
						<div class="col s12 m6 l4">
							<h5>Resumen de Pedido</h5>
							<table class="bordered" >
								<thead>
									<tr>
										<th style="text-align: right; font-size: 17px; width: 50%">Orden:</th>
										<th style="text-align: right; font-size: 17px;">#<?= $resumenOrder->_order_id ?></th>
									</tr>
									<tr>
										<th style="text-align: right; font-size: 17px;">Total Neto:</th>
										<th style="text-align: right; font-size: 17px;">$ <?= number_format($resumenOrder->_total_neto,2,",",".") ?></th>
									</tr>
									<tr>
										<th style="text-align: right; font-size: 17px;">IVA:</th>
										<th style="text-align: right; font-size: 17px;">$ <?= number_format($resumenOrder->_total_iva,2,",",".") ?></th>
									</tr>
									<tr>
										<th style="text-align: right; font-size: 17px;">Despacho:</th>
										<th style="text-align: right; font-size: 17px;">$ <?= number_format($resumenOrder->_courier_cost,2,",",".") ?>
											<p style="font-size: 12px; color: #d32f2f;">Este costo será cargado en bodega</p>
										</th>
									</tr>
									<tr>
										<th style="text-align: right; font-size: 17px;">Total	</th>
										<th style="text-align: right; font-size: 17px;">$ <?= number_format($resumenOrder->_total_order + $resumenOrder->_courier_cost,2,",",".") ?></th>
									</tr>
									<tr>
										<th></th>
										<th style="text-align: right; font-size: 17px;"><input id="_order_id" name="_order_id" value="<?= $this->input->get("order") ?>"  type="hidden"><a href="javascript: void(0)" class="waves-effect waves-light btn orange m-b-xs" id="btaccording">Acepto Conforme </a></th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
					<div class="row">
						<div class="col s12 m6 l6">
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
<script src="<?= PATH_PUBLIC_JS.'/app/app.cart.js' ?>"></script>