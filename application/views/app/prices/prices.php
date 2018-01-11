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
					<span class="card-title">Manejador de Precios</span>
					<div class="row">
						<div class="col s12">
							<ul class="tabs tab-demo z-depth-1" style="width: 100%;">
								<li class="tab col s3"><a href="#test4" class="active">Lista de Precios General</a></li>
								<li class ="tab col s3"><a href="#test5">Precios clientes</a></li>
							</ul>
						</div>
						<div id="test4" class="col s12">
							<p class="p-v-sm">
								<div class="row">
									<a href="javascript: void(0)" class="btn indigo darken-3" onclick="getListPrice()"> <i class="material-icons left">refresh</i> Refrescar</a>
									<a href="javascript: void(0)" class="btn indigo darken-3" onclick="printPriceList()"> <i class="material-icons left">print</i> Imprimir Listados</a>
								</div>
								<div class="row" id="div-price" style="overflow-x: auto; white-space: nowrap; font-size: 13px;"></div>
								<div id="modal4" class="modal" style="width: :150px; height: auto;">
									<div class="modal-content">
										<h4>Imprimir Precios</h4>
										<p>Productos</p>
										<select name="store_id_11" id="store_id_11" class="js-example-placeholder-multiple js-states form-control" style="width: 75%" multiple="multiple">
											<option value="*">(*) Todos</option>}
											<?php foreach ($listProduct as $key => $value):  ?>
											<option value="<?= $value->id ?>"><?= sprintf("%05d",$value->id)." - ".$value->_product ?></option>
											<?php endforeach; ?>
										</select>
										<div id="load3" style="text-align: center;"></div>
										<div class="file-field input-field col s12 m6 l6">
											<button class="btn waves-effect waves-light indigo darken-3" id="print-price-list">Generar Reporte</button>
										</div>
									</div>
									<div class="modal-footer">
										<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cerrar</a>
									</div>
								</div>
							</p>
						</div>
						<div id="test5" class="col s12">
							<p class="p-v-sm">
								<div class="row">
									<h5>Clientes</h5>
									<form id="fmfile" class="p-v-xs" enctype="multipart/form-data" method="post">
										<div class="col s12 m6 l4">
											<select name="store_id_5" id="store_id_5" class="js-example-placeholder-multiple js-states form-control" style="width: 100%" multiple="multiple">
												<?php foreach (json_decode($listStoreActive) as $key => $value):  ?>
												<option value="<?= $value->id ?>"><?= sprintf("%05d",$value->id)." - ".$value->_store ?></option>
												<?php endforeach; ?>
											</select>
											<span class="text-darken-2" style="color: #b0bec5">Seleeccione los cliente, puede seleccinar multiples.</span>
											<div id="loader9"></div>
										</div>
										<div class="file-field input-field col s12 m6 l6">
											<div class="btn indigo darken-3">
												<span>File</span>
												<input type="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" name="file" id="file" onchange="onLoadFile(event)" >
											</div>
											<div class="file-path-wrapper">
												<input class="file-path validate valid" type="text" >
												<span class="text-darken-2" style="color: #b0bec5">Arrastre o seleccione el archivo a importar.</span>
											</div>
										</div>
										<button id="upload-button" type="submit" onclick="return false;" class="btn waves-effect waves-light indigo darken-3">
										<i class="material-icons left">file_upload</i> Subir Archivo </button>
										<div id="info-file"></div>
										<div id="loader10">
											<div id="porcent"></div>
											<div class="progress"><div class="determinate" style="width: 0%" id="process"></div></div>
										</div>
									</form>
								</div>
								<div class="row">
									<a href="javascript: void(0)" class="btn indigo darken-3" onclick="getPriceStore()"> <i class="material-icons left">refresh</i> Refrescar</a>
									<a href="javascript: void(0)" class="btn indigo darken-3" onclick="openModalMulti()"> <i class="material-icons left">queue</i> Transferir Multiples productos</a>
									<a href="javascript: void(0)" class="btn indigo darken-3" onclick="printPrice()"> <i class="material-icons left">print</i> Imprimir Listados</a>
									<div id="tb-prices" style="overflow-x: auto; white-space: nowrap; width: 100%; text-align: center;">
										<h4>Consulte los clientes para visualizar su listado de precios.
										</h4>
									</div>
								</div>
								<div class="row">
									<div id="modal1" class="modal" style="width: :150px; height: auto;">
										<div class="modal-content">
											<h4>Clientes a transferir productos</h4>
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
												<button class="btn waves-effect waves-light indigo darken-3" id="tranfer">Transferir</button>
											</div>
										</div>
										<div class="modal-footer">
											<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cerrar</a>
										</div>
									</div>
									<div id="modal2" class="modal" style="width: :150px; height: auto;">
										<div class="modal-content">
											<h4>Transferir Productos Multiple</h4>
											<form id="fmmultiple">
												<p>Origen</p>
												<select name="store_id_7" id="store_id_7" class="js-example-placeholder-multiple js-states form-control" style="width: 100%">
													<option value=""></option>
													<?php foreach (json_decode($listStoreActive) as $key => $value):  ?>
													<option value="<?= $value->id ?>"><?= sprintf("%05d",$value->id)." - ".$value->_store ?></option>
													<?php endforeach; ?>
												</select>
												<p>Productos</p>
												<select name="lprod" id="lprod" class="js-example-placeholder-multiple js-states form-control" style="width: 100%" multiple="multiple">
												</select>
												<p>Destino</p>
												<select name="store_id_8" id="store_id_8" class="js-example-placeholder-multiple js-states form-control" style="width: 100%">
													<?php foreach (json_decode($listStoreActive) as $key => $value):  ?>
													<option value="<?= $value->id ?>"><?= sprintf("%05d",$value->id)." - ".$value->_store ?></option>
													<?php endforeach; ?>
												</select>
												<div id="load2" style="text-align: center;"></div>
												<div class="file-field input-field col s12 m6 l6">
													<button class="btn waves-effect waves-light indigo darken-3" id="tranfer-multiple">Transferir</button>
												</div>
											</form>
										</div>
										<div class="modal-footer">
											<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cerrar</a>
										</div>
									</div>
									<div id="modal3" class="modal" style="width: :150px; height: auto;">
										<div class="modal-content">
											<h4>Imprimir Precios de Clientes</h4>
											<p>Cientes</p>
											<select name="store_id_9" id="store_id_9" class="js-example-placeholder-multiple js-states form-control" style="width: 100%" multiple="multiple">
												<?php foreach (json_decode($listStoreActive) as $key => $value):  ?>
												<option value="<?= $value->id ?>"><?= sprintf("%05d",$value->id)." - ".$value->_store ?></option>
												<?php endforeach; ?>
											</select>
											<p>Productos</p>
											<select name="store_id_10" id="store_id_10" class="js-example-placeholder-multiple js-states form-control" style="width: 100%" multiple="multiple">
												<option value="*">(*) Todos</option>}
												
												<?php foreach ($listProduct as $key => $value):  ?>
												<option value="<?= $value->id ?>"><?= sprintf("%05d",$value->id)." - ".$value->_product ?></option>
												<?php endforeach; ?>
											</select>
											<div id="load3" style="text-align: center;"></div>
											<div class="file-field input-field col s12 m6 l6">
												<button class="btn waves-effect waves-light indigo darken-3" id="print-price">Generar Reporte</button>
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
	<script src="<?= PATH_PUBLIC_JS.'/app/app.prices.management.js' ?>"></script>