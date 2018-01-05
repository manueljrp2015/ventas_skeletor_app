<link href="<?= PATH_PUBLIC_PLUGINS."/datatables/css/jquery.dataTables.min.css" ?>" rel="stylesheet" type="text/css"/>
<script src="<?= PATH_PUBLIC_PLUGINS."/datatables/js/jquery.dataTables.min.js" ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS."/moment/moment.js" ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS."/moment/moment-with-locales.js" ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS."/phpjs/file_get_contents.js" ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS."/phpjs/str_replace.js" ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS."/phpjs/explode.js" ?>"></script>
<main class="mn-inner">
<div class="row">
	<div class="col s12">
		<div class="page-title">
			<i class="tiny material-icons">assignment_ind</i>
		Crear Nuevo Cliente</div>
		<div class="row">
			<div class="col s12">
				<ul class="tabs tab-demo z-depth-1" style="width: 100%;">
					<li class="tab col s12 m6 l3"><a href="#basic" class="active">Crear Cliente</a></li>
					<li class="tab col s6 m6 l3"><a href="#usert">Usuarios Clientes</a></li>
					<li class="tab col s6 m6 l3"><a href="#list"><?= lang("app_process_text12") ?></a></li>
				</ul>
			</div>
			<div id="basic" class="col s12">
				<div class="card">
					<div class="card-content">
						<div class="row">
							<form class="col s12 m12 l12" id="fmstore">
							<div class="row">
									
									<div class="input-field col s12 m12 l6">
										<div class="switch m-b-md">
											<label>
											Pedido Por Boleta
												
												<input type="checkbox" value="1" name="tped" id="tped" checked="true">
												<span class="lever"></span>
												Pedido Por Factura
											</label>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12 m6 l4">
										<input  id="rut" name="rut" type="text" placeholder="" class="validate">
										<label for="rut">RUT</label>
										<a href="javascript:void(0)" onclick="openModal5()" id="msii" style="display: none;">Ver Actividades Para Seleccionar Giro</a>
									</div>
									<div class="input-field col s12 m6 l4">
										<input  id="nstore" name="nstore" type="text" placeholder="" class="validate">
										<label for="store">Nombre de Fantasia</label>
									</div>
									<div class="input-field col s12 m6 l4">
										<select name="store" id="store" class="js-states browser-default" style="width: 100%">
											<option value="" disabled="" selected=""> </option>
											<option value="f"> Franquiciado</option>
											<option value="n"> Mayorista</option>
										</select>
									</div>
									
								</div>
								<div class="row">
									<div class="input-field col s12 m6 l4">
										<select name="ccost" id="ccost" class="js-states browser-default" style="width: 100%">
											<option value="" disabled="" selected=""> </option>
											<?php foreach (json_decode($centerc) as $key => $value):  ?>
											<option value="<?= $value->centro_costo ?>"><?= $value->centro_costo ?></option>
											<?php endforeach; ?>
											<option value="o">Otro...</option>
										</select>
										<div id="other"></div>
									</div>

									<div class="input-field col s12 m6 l8" id="msg-cli">
									
									</div>
									
									
								</div>
								<div class="row">
									<br>
									<h5>Configuración de envio</h5>
									<div class="input-field col s12 m6 l4">
										<select name="send" id="send" class="js-states browser-default">
											<option value="" disabled="" selected=""> </option>
											<option value="1"> Reparto Santiago</option>
											<option value="2"> COURIER TNT</option>
											<option value="3"> PULLMAN BUS</option>
											<option value="4"> CHILEXPRESS</option>
											<option value="5"> TURBUS</option>
											<option value="6"> DHL</option>
											<option value="7"> FEDEX</option>
											<option value="8"> Otro..</option>
										</select>
										<label for="send" style="margin-top: 50px;">Tipo de envio</label>
									</div>
									<div class="input-field col s12 m6 l4 div-country-tnt">
										
									</div>
									<div class="input-field col s12 m6 l4 div-pueblo-tnt">
										
									</div>
									<div class="input-field col s12 m6 l4 div-hidden">
										<input  id="ramal_hiddden" name="ramal_hiddden" type="hidden" placeholder="" class="validate">
										<input  id="costo_hiddden" name="costo_hiddden" type="hidden" placeholder="" class="validate">
									</div>
								</div>
								<div class="row">
									
									<div class="input-field col s12 m12 l3">
										<div class="switch m-b-md">
											<label>
												<input type="checkbox" value="1" name="horario" id="horario">
												<span class="lever"></span>
												Habilitar Horario
											</label>
										</div>
									</div>
									<div class="input-field col s12 m12 l3">
										<div class="switch m-b-md">
											<label>
												<input type="checkbox" value="1" name="userex" id="userex">
												<span class="lever"></span>
												Usuario Externo
											</label>
										</div>
									</div>
								</div>
								<div class="row">
									<div id="modal5" class="modal" style="width: 800px;">
										<div class="modal-content">
											<h4>Lista de actividades segun SII</h4>
											<div id="tb-sii"></div>
										</div>
										<div class="modal-footer">
											<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cerrar</a>
										</div>
									</div>
								</div>
								<div id="area-softlan" style="display: none;">
									<div class="row">
										<br>
										<h5>Información Softland</h5>
										<div class="input-field col s12 m12 l6">
											<input  id="_razon_real" name="_razon_real" type="text" placeholder="" class="validate">
											
											<label for="dirfact">Razón Social</label>
										</div>
										<div class="input-field col s12 m12 l6">
											<input  id="dirfact" name="dirfact" type="text" placeholder="" class="validate">
											<input  id="savesoft" name="savesoft" value="saved" type="text" class="validate" readonly="true">
											<label for="dirfact">Dirección de Facturación</label>
										</div>
										<div class="input-field col s12 m12 l6">
											<input  id="dirdesp" name="dirdesp" type="text" placeholder="" class="validate">
											<label for="dirdesp">Dirección de Desapacho</label>
										</div>
									</div>
									<div class="row">
										<div class="input-field col s12 m12 l6">
											<input  id="emailcontacto" name="emailcontacto" type="text" placeholder="" class="validate">
											<label for="emailcontacto">Email de Contacto</label>
										</div>
										<div class="input-field col s12 m12 l6">
											<input  id="emaildte" name="emaildte" type="text" placeholder="" class="validate">
											<label for="emaildte">Email de DTE</label>
										</div>
									</div>
									<div class="row">
										<div class="input-field col s12 m12 l6">
											<select name="giro" id="giro" class="js-states browser-default" style="width: 100%">
												<option value="" disabled="" selected=""> </option>
												<?php foreach (json_decode($listGiros) as $key => $value):  ?>
												<option value="<?= $value->GirCod  ?>"><?= $value->GirCod." - ".$value->GirDes ?></option>
												<?php endforeach; ?>
											</select>
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
										
									</div>
								</div>
								<div class="row">
									<button id="save_store" type="submit" class="btn-floating btn-large waves-effect waves-light teal lighten-2">
									<i class="material-icons">save</i> </button>
									<div id="loader3"></div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div id="usert" class="col s12 active">
				<div class="card">
					<div class="card-content">
						<div class="row">
							<form class="col s12 m12 l12" id="fmuser">
								<div class="row">
									
									<div class="input-field col s12 m6 l4">
										<select name="store_id" id="store_id" class="js-states browser-default" style="width: 100%">
											<option value="" disabled="" selected=""> </option>
											<?php foreach (json_decode($listStoreActive) as $key => $value):  ?>
											<option value="<?= $value->id_tienda ?>"><?= sprintf("%05d",$value->id_tienda)." - ".$value->nombre_tienda ?></option>
											<?php endforeach; ?>
										</select>
										<div id="loader4"></div>
									</div>
									<div class="input-field col s12 m6 l4">
										<input  id="user" name="user" type="text" placeholder="" class="validate">
										<input  id="rewrite" name="rewrite" type="hidden" placeholder="" class="validate" readonly="true">
										<label for="user">Usuario</label>
										<div id="loader5"></div>
									</div>
									<div class="input-field col s12 m6 l4">
										<input  id="pass" name="pass" type="text" placeholder="" class="validate">
										<label for="pass">Password</label>
										<div id="loader7"></div>
										<a href="javascript: void(0)" id="gnp"><i class="tiny material-icons">build</i> <?= lang("app_user_myaccount_title3") ?></a>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12 m6 l8">
										<input  id="email" name="email" type="text" placeholder="" class="validate">
										<label for="email">Email</label>
										<div id="loader6"></div>
									</div>
									
									<div class="input-field col s12 m6 l4">
										<select name="storetp" id="storetp" class="js-states browser-default" style="width: 100%">
											<option value="" disabled="" selected=""> </option>
											<option value="vc"> Vendedor Comisionista</option>
											<option value="n"> Otro</option>
										</select>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12 m6 l4">
										<input  id="nombre" name="nombre" type="text" placeholder="" class="validate">
										<label for="nombre">Nombres</label>
									</div>
									<div class="input-field col s12 m6 l4">
										<select name="key" id="key" class="js-states browser-default" style="width: 100%">
											<option value="" disabled="" selected=""> </option>
											
											<option value="7"> 7</option>
										</select>
									</div>
									<div class="input-field col s12 m6 l4">
										<select name="ubicacion" id="ubicacion" class="js-states browser-default" style="width: 100%">
											<option value="" disabled="" selected=""> </option>
											<option value="s">Santiago</option>
											<option value="r">Regiones</option>
										</select>
									</div>
									
								</div>
								<div class="row">
									<h5>Parametros Adicionales</h5>
									<div class="input-field col s12 m12 l3">
										<div class="switch m-b-md">
											<label>
												<input type="checkbox" value="1" name="userex1" id="userex1">
												<span class="lever"></span>
												Usuario Externo
											</label>
										</div>
									</div>
									<div class="input-field col s12 m12 l3">
										<div class="switch m-b-md">
											<label>
												Masculino
												<input type="checkbox" value="1" name="sex" id="sex">
												<span class="lever"></span>
												Femenino
											</label>
										</div>
									</div>
								</div>
								<div class="row">
									<br>
									<h5>Notificaciones</h5>
									<div class="input-field col s12 m12 l3">
										<div class="switch m-b-md">
											<label>
												<input type="checkbox" value="1" name="emfp" id="emfp" checked="true">
												<span class="lever"></span>
												Enviar Fact. Pedidos
											</label>
										</div>
									</div>
									<div class="input-field col s12 m12 l3">
										<div class="switch m-b-md">
											<label>
												<input type="checkbox" value="1" name="emfa" id="emfa">
												<span class="lever"></span>
												Enviar Fact. de Arriendo
											</label>
										</div>
									</div>
									<div class="input-field col s12 m12 l3">
										<div class="switch m-b-md">
											<label>
												<input type="checkbox" value="1" name="emex" id="emex" checked="true">
												<span class="lever"></span>
												Enviar Excel
											</label>
										</div>
									</div>
									<div class="input-field col s12 m12 l3">
										<div class="switch m-b-md">
											<label>
												<input type="checkbox" value="1" name="emods" id="emods">
												<span class="lever"></span>
												Enviar ODS
											</label>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12 m12 l3">
										<div class="switch m-b-md">
											<label>
												<input type="checkbox" value="1" name="emerr" id="emerr">
												<span class="lever"></span>
												Envio Error
											</label>
										</div>
									</div>
									<div class="input-field col s12 m12 l3">
										<div class="switch m-b-md">
											<label>
												<input type="checkbox" value="1" name="emff" id="emff">
												<span class="lever"></span>
												Envio Fact. Faltantes
											</label>
										</div>
									</div>
									<div class="input-field col s12 m12 l3">
										<div class="switch m-b-md">
											<label>
												<input type="checkbox" value="1" name="emid" id="emid">
												<span class="lever"></span>
												Envio Info Despacho
											</label>
										</div>
									</div>
								</div>
								
								<div class="row">
									<button id="save_user_new" type="submit" class="btn-floating btn-large waves-effect waves-light teal lighten-2">
									<i class="material-icons">save</i> </button>
									<div id="loader3"></div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div id="list" class="col s12">
				<div class="card">
					<div class="card-content">
						
						<div class="row">
							<h5>Cargar Por Excel</h5>
							<form id="fmfile" class="p-v-xs" enctype="multipart/form-data" method="post">
								<div class="input-field col s12 m6 l4">
									<select name="store_id_5" id="store_id_5" class="js-states browser-default" style="width: 100%">
										<option value="" disabled="" selected=""> </option>
										<?php foreach (json_decode($listStoreActive) as $key => $value):  ?>
										<option value="<?= $value->id_tienda ?>"><?= sprintf("%05d",$value->id_tienda)." - ".$value->nombre_tienda ?></option>
										<?php endforeach; ?>
									</select>
									<div id="loader9"></div>
								</div>
								<div class="file-field input-field col s12 m6 l6">
									<div class="btn teal lighten-1">
										<span>File</span>
										<input type="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" name="file" id="file" onchange="onLoadFile(event)">
									</div>
									<div class="file-path-wrapper">
										<input class="file-path validate valid" type="text">
									</div>
								</div>
								<button id="upload-button" type="submit" onclick="return false;" class="btn-floating btn-large waves-effect waves-light teal lighten-2">
								<i class="material-icons">file_upload</i> </button>
								<div id="info-file"></div>
								<div id="loader10">
									<div id="porcent"></div>
									<div class="progress"><div class="determinate" style="width: 0%" id="process"></div></div>
								</div>
							</form>
						</div>
						
						<div class="row">
							<h5>Replicar de Tienda</h5>
							<form class="col s12 m12 l12" id="fmlistp">
								<div class="row">
									<div class="input-field col s12 m6 l5">
										<select name="store_id_3" id="store_id_3" class="js-states browser-default" style="width: 100%">
											<option value="" disabled="" selected=""> </option>
											<?php foreach (json_decode($listStoreActive) as $key => $value):  ?>
											<option value="<?= $value->id_tienda ?>"><?= sprintf("%05d",$value->id_tienda)." - ".$value->nombre_tienda ?></option>
											<?php endforeach; ?>
										</select>
										<div id="loader8"></div>
									</div>
									
									<div class="input-field col s12 m6 l5">
										<select name="store_id_4" id="store_id_4" class="js-states browser-default" style="width: 100%">
											<option value="" disabled="" selected=""> </option>
											<?php foreach (json_decode($listStoreActive) as $key => $value):  ?>
											<option value="<?= $value->id_tienda ?>"><?= sprintf("%05d",$value->id_tienda)." - ".$value->nombre_tienda ?></option>
											<?php endforeach; ?>
										</select>
										<div id="loader9"></div>
									</div>
									<div class="input-field col s12 m6 l2">
										<button id="save_list_new" type="submit" class="btn-floating btn-large waves-effect waves-light teal lighten-2" title="Transferencia entre clientes"t>
										<i class="material-icons">compare_arrows</i> </button>
										
									</div>
									
								</div>
							</div>
							
						</form>
						<div id="tb-analisis-store">
							
						</div>
						<div id="tb-list-store">
							
						</div>
						<div>
							<div id="modal1" class="modal" >
								<div class="modal-content">
									<h5>Incluir Producto Individual</h5>
									<label></label>
									<div class="row left-text">
										<div class="input-field col s12 m4 l4">
											<input  id="codproduct" name="codproduct" type="text" placeholder=""  class="validate" readonly="true">
											<label for="codproduct">Producto</label>
										</div>
										<div class="input-field col s12 m8 l8">
											<input  id="product" name="product" type="text" placeholder=""  class="validate" readonly="true">
											<label for="product">Producto</label>
										</div>
										<div class="input-field col s12 m6 l6">
											<input  id="price" name="price" type="text"  placeholder="" class="validate" readonly="true">
											<label for="price">Precio</label>
										</div>
										
										<div class="input-field col s12 m6 l6">
											<input  id="price_new" name="price_new" value="empty" type="text" style="display: none;" placeholder="Nuevo Precio">
											<p class="range-field" >
												<input id="range" min="0" max="100" class="active" type="range" value="0" style="display: none;"><span class="thumb" style="left: 219.5px; height: 0px; width: 0px; top: 10px; margin-left: -6px;"><span class="value">0</span></span>
											</p>
										</div>
									</div>
									<div class="row left-text">
										<div class="input-field col s12 m12 l6">
											<div class="switch m-b-md">
												<label>
													<input type="checkbox" value="1" name="actprice" id="actprice">
													<span class="lever"></span>
													Ajustar Precio
												</label>
											</div>
											<br>
											<br>
											<h6 class="red-text">*Si desea ajustar el precio de venta</h6>
										</div>
										
										<div class="input-field col s12 m12 l6">
											<div class="switch m-b-md">
												<label>
													Disminuir %
													<input type="checkbox" value="1" name="factor" id="factor" disabled="">
													<span class="lever"></span>
													Aumentar %
												</label>
											</div>
											<br>
											<br>
											<h6 class="red-text">*Aumentar o Diminuir Porcentaje de precio de venta</h6>
										</div>
										
										
										<br>
										<br>
										<br>
										<div class="input-field col s12 m12 l12">
											<textarea id="obs" name="obs" class="materialize-textarea" length="120"></textarea>
											<label for="textarea1" class="">Observación</label>
											<span class="character-counter" style="float: right; font-size: 12px; height: 1px;"></span>
										</div>
									</div>
									<div class="input-field col s12 m12 l12 right-text">
										<button  id="inprice" class="btn waves-effect waves-light btn yellow darken-2" title="buscar informacion de tienda">Incluir en Tienda</button>
										
									</div>
									<div id="loader13">
										
									</div>
								</div>
								<div class="modal-footer">
									<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Cerrar</a>
								</div>
							</div>
						</div>
						<div>
							<div id="modal2" class="modal" >
								<div class="modal-content">
									<h5>Actualizar Productos</h5>
									<label></label>
									<div class="row left-text">
										<div class="input-field col s12 m4 l4">
											<input  id="codproduct2" name="codproduct2" type="text" placeholder=""  class="validate" readonly="true">
											<label for="codproduct">Producto</label>
										</div>
										<div class="input-field col s12 m8 l8">
											<input  id="product2" name="product2" type="text" placeholder=""  class="validate" readonly="true">
											<label for="product">Producto</label>
										</div>
										<div class="input-field col s12 m6 l6">
											<input  id="price2" name="price2" type="text"  placeholder="" class="validate" readonly="true">
											<label for="price">Precio</label>
										</div>
										
										<div class="input-field col s12 m6 l6">
											<input  id="price_new2" name="price_new2" value="empty" type="text" style="display: none;" placeholder="Nuevo Precio">
											<p class="range-field" >
												<input id="range2" min="0" max="100" class="active" type="range" value="0" style="display: none;"><span class="thumb" style="left: 219.5px; height: 0px; width: 0px; top: 10px; margin-left: -6px;"><span class="value">0</span></span>
											</p>
										</div>
									</div>
									<div class="row left-text">
										<div class="input-field col s12 m12 l6">
											<div class="switch m-b-md">
												<label>
													<input type="checkbox" value="1" name="actprice2" id="actprice2">
													<span class="lever"></span>
													Ajustar Precio
												</label>
											</div>
											<br>
											<br>
											<h6 class="red-text">*Si desea ajustar el precio de venta</h6>
										</div>
										
										<div class="input-field col s12 m12 l6">
											<div class="switch m-b-md">
												<label>
													Disminuir %
													<input type="checkbox" value="1" name="factor2" id="factor2" disabled="">
													<span class="lever"></span>
													Aumentar %
												</label>
											</div>
											<br>
											<br>
											<h6 class="red-text">*Aumentar o Diminuir Porcentaje de precio de venta</h6>
										</div>
										
										
										<br>
										<br>
										<br>
										<div class="input-field col s12 m12 l12">
											<textarea id="obs2" name="obs2" class="materialize-textarea" length="120"></textarea>
											<label for="textarea1" class="">Observación</label>
											<span class="character-counter" style="float: right; font-size: 12px; height: 1px;"></span>
										</div>
									</div>
									<div class="input-field col s12 m12 l12 right-text">
										<button  id="inprice2" class="btn waves-effect waves-light btn yellow darken-2" title="buscar informacion de tienda">Incluir en Tienda</button>
										
									</div>
									<div id="loader13">
										
									</div>
								</div>
								<div class="modal-footer">
									<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Cerrar</a>
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</main>
<script src="<?= PATH_PUBLIC_JS.'/app/app.store.temp.js' ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS.'/phpjs/number_format.js' ?>"></script>