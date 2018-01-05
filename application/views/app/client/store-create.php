<link href="<?= PATH_PUBLIC_PLUGINS."/datatables/css/jquery.dataTables.min.css" ?>" rel="stylesheet" type="text/css"/>
<script src="<?= PATH_PUBLIC_PLUGINS."/datatables/js/jquery.dataTables.min.js" ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS."/moment/moment.js" ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS."/moment/moment-with-locales.js" ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS."/jquery-inputmask/jquery.inputmask.bundle.js" ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS."/phpjs/file_get_contents.js" ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS."/phpjs/str_replace.js" ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS."/phpjs/explode.js" ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS."/phpjs/unserialize.js" ?>"></script>
<main class="mn-inner">
	
	<div class="row">
		<div class="col s12">
			<div class="card">
				<div class="card-content">
					<span class="card-title">Configuración de Tiendas o Clientes</span>
					<div class="row">
						<div class="col s12">
							<ul class="tabs tab-demo z-depth-1" style="width: 100%;">
								<li class="tab col s3"><a href="#test4">Nuevo Cliente o Tienda</a></li>
								<li class ="tab col s3"><a href="#test5" class="active">Clientes o Tiendas</a></li>
							</ul>
						</div>
						<div id="test4" class="col s12"><p class="p-v-sm">
							<blockquote>
								<h5>Información Principal</h5>
							</blockquote>
							<form id="fmclient" method="post" accept-charset="utf-8" action="put-client">
								<div class="row">
									<div class="input-field col s12 m6 l2">
										<input  id="_rut" name="_rut" type="text" placeholder="" class="validate" style="padding: 5px; text-align: right; font-size: 14px; border: 1px solid #BCBCBC; margin-top: 5px;">
										<input  id="_band" name="_band" type="hidden" placeholder="" class="validate" style="padding: 5px; text-align: right; font-size: 14px; border: 1px solid #BCBCBC; margin-top: 5px;">
										<input  id="id" name="id" type="hidden" placeholder="" class="validate" style="padding: 5px; text-align: right; font-size: 14px; border: 1px solid #BCBCBC; margin-top: 5px;">
										<label for="_id_store">RUT</label>
										<span class="text-darken-2" style="color: #b0bec5">RUT de Cliente, sera validado en SII..</span>
									</div>
									<div class="input-field col s12 m6 l4">
										<input  id="_name" name="_name" type="text" placeholder="" class="validate" style="padding: 5px; text-align: right; font-size: 14px; border: 1px solid #BCBCBC; margin-top: 5px;">
										<label for="_name">Nombre de la Tienda</label>
										<span class="text-darken-2" style="color: #b0bec5">Nombre de Fantasia o razón social</span>
									</div>
									<div class="input-field col s12 m6 l2">
										<input  id="_phone" name="_phone" type="text" placeholder="" class="validate" style="padding: 5px; text-align: right; font-size: 14px; border: 1px solid #BCBCBC; margin-top: 5px;" data-inputmask="'mask': '+56 9 9999-9999'">
										<label for="_phone">Teléfono</label>
										<span class="text-darken-2" style="color: #b0bec5">Numero de Contacto del cliente</span>
									</div>
									<div class="input-field col s12 m6 l4">
										<input  id="_email" name="_email" type="text" placeholder="" class="validate" style="padding: 5px; text-align: right; font-size: 14px; border: 1px solid #BCBCBC; margin-top: 5px;">
										<label for="_email">Email</label>
										<span class="text-darken-2" style="color: #b0bec5">Email de Contacto del cliente</span>
									</div>
									<div>
										<div class="row">
										</div>
										<div class="input-field col s12 m6 l6">
											<input  id="_dir" name="_dir" type="text" placeholder="" class="validate" style="padding: 5px; text-align: right; font-size: 14px; border: 1px solid #BCBCBC; margin-top: 5px;">
											<label for="_dir">Dirección</label>
											<span class="text-darken-2" style="color: #b0bec5">Dirección comercial de la empresa</span>
										</div>
										<div class="input-field col s12 m6 l4">
											<select name="_region_c" id="_region_c" class="js-states browser-default" style="width: 100%">
												<option value="" disabled="" selected=""> </option>
												<?php foreach (json_decode($listRegion) as $key => $value):  ?>
												<option value="<?= $value->id_Region  ?>"><?= $value->region_id." - ".$value->Descripcion ?></option>
												<?php endforeach; ?>
											</select>
											<span class="text-darken-2" style="color: #b0bec5">Region de ubicación del cliente</span>
										</div>
									</div>
								</div>
								<div class="row" id="slideGiro">
									<div id="loader" style="text-align: center;"></div>
									<div id="bt-giro"></div>
									<div id="msg-cli"></div>
									<div id="tb-sii"></div>
								</div>
								<blockquote>
									<h5>Condición de Pago</h5>
									<span class="text-darken-2" style="color: #b0bec5">Condición y formas de pago</span>
								</blockquote>
								<div class="row">
									<div class="input-field col s12 m6 l2">
										<input  id="_credit" name="_credit" type="text" placeholder="0.00" class="validate" style="padding: 5px; text-align: right; font-size: 14px; border: 1px solid #BCBCBC; margin-top: 5px;" >
										<label for="store">Linea de Credito</label>
										<span class="text-darken-2" style="color: #b0bec5">Limite de credito con que el cliete prodra realizar compras</span>
									</div>
									
									<div class="input-field col s12 m6 l2">
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
										<span class="text-darken-2" style="color: #b0bec5">Condición de pago que tendra el cliente para relaizar pagos</span>
									</div>
								</div>
								
								<blockquote>
									<h5>Transporte</h5>
									<span class="text-darken-2" style="color: #b0bec5">Información para las cotizaciones de despacho de pedidos</span>
								</blockquote>
								
								<div class="row">
									
									<div class="input-field col s12 m6 l4">
										<select name="send" id="send" class="js-states browser-default" style="width: 100%;">
											<option value="" disabled="" selected=""> </option>
											<option value="1"> Reparto Santiago</option>
											<option value="2"> COURIER TNT</option>
											
										</select>
									</div>
									<div class="input-field col s12 m6 l4 div-country-tnt">
										<select name="_country_tnt" id="_country_tnt" class="js-states browser-default" style="width: 100%;">
											<option value=""></option>
										</select>
										<label for="send" style="margin-top: 50px;">Ciudad de Envio</label>
										
									</div>
									<div class="input-field col s12 m6 l4 div-pueblo-tnt">
										<select name="_pueblo_tnt" id="_pueblo_tnt" class="js-states browser-default" style="width: 100%;">
											<option value=""></option>
										</select>
										<label for="send" style="margin-top: 50px;">Pueblo de Envio</label>
									</div>
									<div class="input-field col s12 m6 l4 div-hidden">
										<input  id="ramal_hiddden" name="ramal_hiddden" type="hidden" placeholder="" class="validate">
										<input  id="costo_hiddden" name="costo_hiddden" type="hidden" placeholder="" class="validate">
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12 m6 l1">
										<input  id="_factor" name="_factor" type="text" placeholder="" class="validate" style="padding: 5px; text-align: right; font-size: 14px; border: 1px solid #BCBCBC; margin-top: 5px;" >
										<label for="store">Factor %</label>
										<span class="text-darken-2" style="color: #b0bec5">Porcentaje adicional para calculo de pedido</span>
									</div>
									<div class="input-field col s12 m12 l6">
										<input  id="dirdesp" name="dirdesp" type="text" placeholder="" class="validate" style="padding: 5px; text-align: right; font-size: 14px; border: 1px solid #BCBCBC; margin-top: 5px;">
										<label for="dirdesp">Dirección de Desapacho</label>
										<span class="text-darken-2" style="color: #b0bec5">Dirección en que se despachara los pedidos</span>
									</div>
								</div>
								<br>
								<blockquote>
									<h5>Información Softland</h5>
									<span class="text-darken-2" style="color: #b0bec5">La información aqui contenida se registrara directamente en softland</span>
								</blockquote>
								<div class="row">
									<div class="input-field col s12 m12 l6">
										<input  id="_razon_real" name="_razon_real" type="text" placeholder="" class="validate" style="padding: 5px; text-align: right; font-size: 14px; border: 1px solid #BCBCBC; margin-top: 5px;">
										
										<label for="dirfact">Razón Social</label>
										<span class="text-darken-2" style="color: #b0bec5">Razón Social de la empresa o cliente, puede completarse directamente desde SII</span>
									</div>
									<div class="input-field col s12 m12 l6">
										<input  id="dirfact" name="dirfact" type="text" placeholder="" class="validate" style="padding: 5px; text-align: right; font-size: 14px; border: 1px solid #BCBCBC; margin-top: 5px;">
										
										<label for="dirfact">Dirección de Facturación</label>
										<span class="text-darken-2" style="color: #b0bec5">Dirección fiscal en el cual se generaran las facturas.</span>
									</div>
									
								</div>
								
								<div class="row">
									<div class="input-field col s12 m12 l6">
										<select name="giro" id="giro"  style="padding: 5px; text-align: right; font-size: 14px; border: 1px solid #BCBCBC; margin-top: 5px; width: 100%"">
											<option value="" disabled="" selected=""> </option>
											<?php foreach (json_decode($listGiros) as $key => $value):  ?>
											<option value="<?= $value->GirCod  ?>"><?= $value->GirCod." - ".$value->GirDes ?></option>
											<?php endforeach; ?>
										</select>
										<span class="text-darken-2" style="color: #b0bec5">Giro o actividad comercial que realiza el cliente.</span>
									</div>
									<div class="input-field col s12 m12 l6">
										<select name="pais" id="pais" class="js-states browser-default" style="width: 100%">
											<option value="" disabled="" selected=""> </option>
											<?php foreach (json_decode($listPais) as $key => $value):  ?>
											<option value="<?= $value->PaiCod  ?>"><?= $value->PaiCod." - ".$value->PaiDes ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12 m12 l6">
										<select name="region" id="region" class="js-states browser-default" style="width: 100%">
											<option value="" disabled="" selected=""> </option>
											<?php foreach (json_decode($listRegion) as $key => $value):  ?>
											<option value="<?= $value->id_Region  ?>"><?= $value->id_Region." - ".$value->Descripcion ?></option>
											<?php endforeach; ?>
										</select>
									</div>
									<div class="input-field col s12 m12 l6">
										<select name="ciudad" id="ciudad" class="js-states browser-default" style="width: 100%">
										</select>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12 m12 l6">
										<select name="comuna" id="comuna" class="js-states browser-default" style="width: 100%">
											<option value="" disabled="" selected=""> </option>
											
										</select>
									</div>
									<div class="input-field col s4">
										<button type="submit" class="waves-effect waves-light btn orange m-b-xs" disabled="disabled" id="save_store"> Guardar</button>
									</div>
								</div>
							</form>
						</p></div>
						<div id="test5" class="col s12">
							<p class="p-v-sm">
								<div class="row">
									<a href="clientes" class="waves-effect waves-light btn green m-b-xs" target="_blank">Generar Listado de Clientes</a>
									<div class="row" id="div-tbstores" style="overflow-x: auto; white-space: nowrap;">
										<table id="tbstores" class="display responsive-table datatable-example">
											<thead>
												<tr>
													<th>ID#</th>
													<th>TIENDA</th>
													<th>RUT</th>
													<th>CENTRO/COSTO</th>
													<th>REFERENCIA</th>
													<th>#</th>
													<th>#</th>
													<th>#</th>
													<th>.</th>
												</tr>
											</thead>
											<tfoot>
											<tr>
												<th>ID#</th>
												<th>TIENDA</th>
												<th>RUT</th>
												<th>CENTRO/COSTO</th>
												<th>REFERENCIA</th>
												<th>#</th>
												<th>#</th>
												<th>#</th>
												<th>.</th>
											</tr>
											</tfoot>
											<tbody>
												<?php
												$i = 1;
													foreach($stores as $store){
												?>
												<tr>
													<td><?= sprintf("%09d",$store->id) ?></td>
													<td><?= $store->_store ?></td>
													<td><?= $store->_idn ?></td>
													<td><?= $store->_cost_center ?></td>
													<td><?= $store->_refer ?></td>
													<td><a class="waves-effect waves-blue btn-flat" href="javascript: void(0)" onclick="editStore(<?= $store->id ?>)"><i class="material-icons left">mode_edit</i>Basicó</a></td>
													<td><a href="javascript: void(0)" class="waves-effect waves-blue btn-flat" onclick="getClientUpdate(<?= $store->id ?>, <?= $i ?>)"><i class="material-icons left">format_align_justify</i>Ficha</a></td>
													<td><a href="comprobante?client=<?= $store->id ?>" class="waves-effect waves-blue btn-flat" target="_blank"><i class="material-icons left">picture_as_pdf</i>Comprobante</a></td>
													<td id="tb_<?= $i ?>" style="text-align: center;"></td>
												</tr>
												<?php
												$i++;
												}
												?>
											</tbody>
										</table>
									</div>
								</div>
								<div class="row">
									<div id="modal7" class="modal" style="width: 1300px;">
										<div class="modal-content">
											<h4>Comentario de tu pedido</h4>
											<h3 style="color: green;" id="tlb-order"></h3>
											<form id="frm-update-store">
												<div class="row">
													<div class="row">
														<div class="input-field col s12 m12 l6">
															<input  id="id_2" name="id_2" type="hidden" placeholder="" class="validate">
															<input  id="_store_2" name="_store_2" type="text" placeholder="" class="validate">
															<label for="_store_2">Tienda o Cliente</label>
														</div>
														<div class="input-field col s12 m12 l3">
															<input  id="_rut_2" name="_rut_2" type="text" placeholder="" class="validate">
															<label for="_rut_2">Rut</label>
														</div>
														<div class="input-field col s12 m12 l3">
															<input  id="_center" name="_center" type="text" placeholder="" class="validate" disabled="disabled">
															<label for="_center">Centro de Costos</label>
														</div>
													</div>
													<div class="row">
														<div class="input-field col s12 m12 l6">
															<input  id="_email_2" name="_email_2" type="text" placeholder="" class="validate">
															<label for="_email_2">Email de Contacto</label>
														</div>
														<div class="input-field col s12 m12 l4">
															<input  id="_phone_2" name="_phone_2" type="text" placeholder="" class="validate">
															<label for="_phone_2">Teléfono Celular</label>
														</div>
													</div>
													<div class="row">
														<div class="input-field col s12">
															<button class="waves-effect waves-light btn orange m-b-xs" type="submit"><i class="material-icons small left">edit</i> Actualizar
															</button>
														</div>
													</div>
												</div>
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
	<script src="<?= PATH_PUBLIC_JS.'/app/app.client.js' ?>"></script>