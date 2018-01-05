<link href="<?= PATH_PUBLIC_PLUGINS."/datatables/css/jquery.dataTables.min.css" ?>" rel="stylesheet" type="text/css"/>
<script src="<?= PATH_PUBLIC_PLUGINS."/datatables/js/jquery.dataTables.min.js" ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS."/moment/moment.js" ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS."/moment/moment-with-locales.js" ?>"></script>
<main class="mn-inner">
	<div class="row">
		<div class="col s12">
			<div class="card">
				<div class="card-content">
					<span class="card-title">Creación de productos</span>
					<div class="row">
						<div class="col s12">
							<ul class="tabs tab-demo z-depth-1" style="width: 100%;">
								<li class="tab col s3"><a href="#test1">Crear Productos</a></li>
								<li class="tab col s3"><a class="active" href="#test2">Lista de Produtos</a></li>
								
							</ul>
						</div>
						<div id="test1" class="col s12">
							<p class="p-v-sm">
								<form class="col s12 m12 l12" id="fmprd" action="put-product">
									<div class="row">
										<h4>Datos Principales</h4>
										<div class="input-field col s12 m6 l2">
											<input  id="_sku" name="_sku" type="text" placeholder="000000"  style="padding: 5px; text-align: right; font-size: 14px; border: 1px solid #BCBCBC; margin-top: 5px;">
											<input  id="id" name="id" type="hidden" placeholder="000000"  style="padding: 5px; text-align: right; font-size: 14px; border: 1px solid #BCBCBC; margin-top: 5px;">
											<label for="_id_store">SKU <strong style="color: red;">*</strong></label>
											<span class="text-darken-2" style="color: #b0bec5">Código interno del producto.</span>
										</div>
										<div class="input-field col s12 m6 l4">
											<input  id="_product" name="_product" type="text" placeholder="" class="validate" style="padding: 5px; text-align: right; font-size: 14px; border: 1px solid #BCBCBC; margin-top: 5px;">
											<label for="store">PRODUCTO <strong style="color: red;">*</strong></label>
											<span class="text-darken-2" style="color: #b0bec5">Nombre o descripción del producto.</span>
										</div>
										<div class="input-field col s12 m6 l2">
											<input  id="_ean" name="_ean" type="text" placeholder="" class="validate" style="padding: 5px; text-align: right; font-size: 14px; border: 1px solid #BCBCBC; margin-top: 5px;">
											<label for="store">EAN <strong style="color: red;">*</strong></label>
											<span class="text-darken-2" style="color: #b0bec5">Código de 13 digitos del empaque.</span>
										</div>
										<div class="input-field col s12 m6 l2">
											<input  id="_eanbox" name="_eanbox" type="text" placeholder="" class="validate" style="padding: 5px; text-align: right; font-size: 14px; border: 1px solid #BCBCBC; margin-top: 5px;">
											<label for="store">EAN-BOX <strong style="color: red;">*</strong></label>
											<span class="text-darken-2" style="color: #b0bec5">Código de 13 digitos del empaque.</span>
										</div>
										
										<div class="input-field  col s12 m6 l2">
											<input  id="_dun" name="_dun" type="text" placeholder="" class="validate" style="padding: 5px; text-align: right; font-size: 14px; border: 1px solid #BCBCBC; margin-top: 5px;">
											<label for="store">DUN <strong style="color: red;">*</strong></label>
											<span class="text-darken-2" style="color: #b0bec5">DUN del producto.</span>
										</div>
									</div>
									<div class="row">
										<div class="col s12 m6 l2">
											<select name="_und" id="_und" class="js-states browser-default" style="padding: 5px; text-align: right; font-size: 14px; border: 1px solid #BCBCBC; margin-top: 5px;">
												<option value=""></option>
												<?php
												foreach ($undProduct as $key => $value) {
												?>
												<option value="<?= $value->_prefix ?>"><?= $value->_prefix." - ".$value->_und ?></option>
												<?php
												}
												?>
											</select>
											<label for="_id_store">UNIDAD <strong style="color: red;">*</strong></label>
											<span class="text-darken-2" style="color: #b0bec5">Unidad de Medida.</span>
										</div>
										<div class="input-field col s12 m6 l2">
											<input  id="_codrela" name="_codrela" type="text" placeholder="" class="validate" style="padding: 5px; text-align: right; font-size: 14px; border: 1px solid #BCBCBC; margin-top: 5px;" readonly="readonly">
											<label for="store">CODIGO-RELACÍON</label>
											<span class="text-darken-2" style="color: #b0bec5">Código de la venta por caja se genera automaticamente. .</span>
										</div>
										<div class="input-field col s12 m6 l2">
											<input  id="_cost" name="_cost" type="text" placeholder="0.00" class="validate" style="padding: 5px; text-align: right; font-size: 14px; border: 1px solid #BCBCBC; margin-top: 5px;">
											<label for="store">COSTO <strong style="color: red;">*</strong></label>
											<span class="text-darken-2" style="color: #b0bec5">Costo del Producto, no es precio de venta.</span>
										</div>
										<div class="input-field col s12 m6 l2">
											<input  id="_descu" name="_descu" type="text" placeholder="0.00" class="validate" style="padding: 5px; text-align: right; font-size: 14px; border: 1px solid #BCBCBC; margin-top: 5px;">
											<label for="store">DESCUENTO</label>
											<span class="text-darken-2" style="color: #b0bec5">Costo del Producto, no es precio de venta.</span>
										</div>

										<div class="input-field  col s12 m6 l2">
											<input  id="_expire" name="_expire" type="text" placeholder="" class="datepicker" style="padding: 5px; text-align: right; font-size: 14px; border: 1px solid #BCBCBC; margin-top: 5px;">
											<label for="store">Expiración <strong style="color: red;">*</strong></label>
											<span class="text-darken-2" style="color: #b0bec5">Fecha de expiración del producto.</span>
										</div>
									</div>
									<div class="row">
										<div class=" col s12 m6 l4">
											<select name="_cate" id="_cate" class="js-states browser-default" style="padding: 5px; text-align: right; font-size: 14px; border: 1px solid #BCBCBC; margin-top: 5px;">
												<option value=""></option>
												<?php
												foreach ($groupProduct as $key => $value) {
												?>
												<option value="<?= $value->id ?>"><?= $value->_group ?></option>
												<?php
												}
												?>
											</select>
											<label for="_id_store">CATEGORIA <strong style="color: red;">*</strong></label>
										</div>
										<div class="col s12 m6 l4">
											<select name="_subcate" id="_subcate" class="js-states browser-default" style="padding: 5px; text-align: right; font-size: 14px; border: 1px solid #BCBCBC; margin-top: 5px;">
												<option value=""></option>
												<?php
												foreach ($subgroupProduct as $key => $value) {
												?>
												<option value="<?= $value->id ?>"><?= $value->_sub_group ?></option>
												<?php
												}
												?>
											</select>
											<label for="store">SUB-CATEGORIA <strong style="color: red;">*</strong></label>
										</div>
										<div class="col s12 m6 l4">
											<select name="_line" id="_line"  class="js-states browser-default" style="padding: 5px; text-align: right; font-size: 14px; border: 1px solid #BCBCBC; margin-top: 5px;">
												<option value=""></option>
												<?php
												foreach ($listLineProduct as $key => $value) {
												?>
												<option value="<?= $value->id ?>"><?= $value->_line ?></option>
												<?php
												}
												?>
											</select>
											<label for="store">LINEA <strong style="color: red;">*</strong></label>
										</div>
										
									</div>
									<div class="row">
										<h4>Precios Referencia</h4>
										<div class="input-field  col s12 m6 l2">
											<input  id="_price1" name="_price1" type="text" placeholder="0.00" class="validate" style="padding: 5px; text-align: right; font-size: 14px; border: 1px solid #BCBCBC; margin-top: 5px;">
											<label for="_id_store">PRECIO A <strong style="color: red;">*</strong></label>
											<span class="text-darken-2" style="color: #b0bec5">Precio de Muestra Máximo.</span>
										</div>
										<div class="input-field  col s12 m6 l2">
											<input  id="_price2" name="_price2" type="text" placeholder="0.00" class="validate" style="padding: 5px; text-align: right; font-size: 14px; border: 1px solid #BCBCBC; margin-top: 5px;">
											<label for="store">PRECIO B <strong style="color: red;">*</strong></label>
											<span class="text-darken-2" style="color: #b0bec5">Precio de Muestra Medio.</span>
										</div>
										<div class="input-field  col s12 m6 l2">
											<input  id="_price3" name="_price3" type="text" placeholder="0.00" class="validate" style="padding: 5px; text-align: right; font-size: 14px; border: 1px solid #BCBCBC; margin-top: 5px;">
											<label for="store">PRECIO C <strong style="color: red;">*</strong></label>
											<span class="text-darken-2" style="color: #b0bec5">Precio de Muestra Minimo.</span>
										</div>
										<div class="input-field  col s12 m6 l2">
											<input  id="_price4" name="_price4" type="text" placeholder="0.00" class="validate" style="padding: 5px; text-align: right; font-size: 14px; border: 1px solid #BCBCBC; margin-top: 5px;">
											<label for="store">PRECIO C <strong style="color: red;">*</strong></label>
											<span class="text-darken-2" style="color: #b0bec5">Precio de Muestra Alternativo.</span>
										</div>
									</div>
									<div class="row">
										<h4>Dimensiones</h4>
										<div class="input-field col s12 m6 l2">
											<input  id="_wieght" name="_wieght" type="text" placeholder="0.00" class="validate" style="padding: 5px; text-align: right; font-size: 14px; border: 1px solid #BCBCBC; margin-top: 5px;">
											<label for="_id_store">PESO <strong style="color: red;">*</strong></label>
											<span class="text-darken-2" style="color: #b0bec5">Peso expresado en gramos.</span>
										</div>
										<div class="input-field col s12 m6 l2">
											<input  id="_height" name="_height" type="text" placeholder="0.00" class="validate" style="padding: 5px; text-align: right; font-size: 14px; border: 1px solid #BCBCBC; margin-top: 5px;">
											<label for="store">ALTO <strong style="color: red;">*</strong></label>
											<span class="text-darken-2" style="color: #b0bec5">Alto expresado en Cm.</span>
										</div>
										<div class="input-field col s12 m6 l2">
											<input  id="_width" name="_width" type="text" placeholder="0.00" class="validate" style="padding: 5px; text-align: right; font-size: 14px; border: 1px solid #BCBCBC; margin-top: 5px;">
											<label for="store">ANCHO <strong style="color: red;">*</strong></label>
											<span class="text-darken-2" style="color: #b0bec5">Ancho expresado en Cm.</span>
										</div>
										<div class="input-field col s12 m6 l2">
											<input  id="_large" name="_large" type="text" placeholder="0.00" class="validate" style="padding: 5px; text-align: right; font-size: 14px; border: 1px solid #BCBCBC; margin-top: 5px;">
											<label for="store">PROFUNDO <strong style="color: red;">*</strong></label>
											<span class="text-darken-2" style="color: #b0bec5">Profundida expresada en Cm.</span>
										</div>
									</div>
									<div class="row">
										<h4>Otra Información</h4>
										<div class="input-field col s12 m6 l2">
											<input  id="_available_real " name="_available_real" type="text" placeholder="0.00" class="validate" style="padding: 5px; text-align: right; font-size: 14px; border: 1px solid #BCBCBC; margin-top: 5px;">
											<label for="_available_real">Disponibilidad</label>
										</div>
										<div class="input-field col s12 m6 l2">
											<input  id="_available" name="_available" type="text" placeholder="0.00" class="validate" style="padding: 5px; text-align: right; font-size: 14px; border: 1px solid #BCBCBC; margin-top: 5px;">
											<label for="_available">Disponibilidad Real</label>
										</div>
										<div class="input-field col s12 m6 l2">
											<input  id="_min_measure" name="_min_measure" type="text" placeholder="0.00" class="validate" style="padding: 5px; text-align: right; font-size: 14px; border: 1px solid #BCBCBC; margin-top: 5px;">
											<label for="_min_measure">Unidad Minima de Venta</label>
										</div>
										<div class="input-field col s12 m6 l2">
											<input  id="_max_measure" name="_max_measure" type="text" placeholder="0.00" class="validate" style="padding: 5px; text-align: right; font-size: 14px; border: 1px solid #BCBCBC; margin-top: 5px;">
											<label for="_max_measure">Unidad Maxima de Venta</label>
										</div>
									</div>
									<div class="row">
										<div class="input-field col s12 m6 l3">
											<button type="submit" class="waves-effect waves-light btn" id="btsaveprod"><i class="material-icons left">save</i>Grabar</button>
										</div>
									</div>
								</form>
							</p>
						</div>
						<div id="test2" class="col s12">
							<p class="p-v-sm">
								<a href="productos" class="waves-effect waves-light btn green m-b-xs" target="_blank">Generar Listado de Productos</a>
								<div class="row" id="div-tbstores" style="overflow-x: auto; white-space: nowrap; font-size: 13px;">
									<table id="tbstores" class="display responsive-table datatable-example" >
										<thead>
											<tr>
												<th style="border-right: 1px solid #cfd8dc;">#</th>
												<th style="border-right: 1px solid #cfd8dc;">ID#</th>
												<th style="border-right: 1px solid #cfd8dc;">SKU</th>
												<th style="border-right: 1px solid #cfd8dc;">ESTADO</th>
												<th style="border-right: 1px solid #cfd8dc;">PRODUCTO</th>
												<th style="border-right: 1px solid #cfd8dc;">EAN</th>
												<th style="border-right: 1px solid #cfd8dc;">EAN-PACK</th>
												<th style="border-right: 1px solid #cfd8dc;">DUN</th>
												<th style="border-right: 1px solid #cfd8dc;">EXPIRA</th>
												<th style="border-right: 1px solid #cfd8dc;">CREADO</th>
											  <th style="border-right: 1px solid #cfd8dc;">ACTUALIZADO</th>
												<th style="border-right: 1px solid #cfd8dc;">UND</th>
												<th style="border-right: 1px solid #cfd8dc;">COD.RELA</th>
												<th style="border-right: 1px solid #cfd8dc;">COSTO</th>
												<th style="border-right: 1px solid #cfd8dc;">DESCUENTO</th>
												<th style="border-right: 1px solid #cfd8dc;">CATEGORIA</th>
												<th style="border-right: 1px solid #cfd8dc;">SUBCATEGORIA</th>
												<th style="border-right: 1px solid #cfd8dc;">LINEA</th>
												<th style="border-right: 1px solid #cfd8dc;">PRECIO A</th>
												<th style="border-right: 1px solid #cfd8dc;">PRECIO B</th>
												<th style="border-right: 1px solid #cfd8dc;">PRECIO C</th>
												<th style="border-right: 1px solid #cfd8dc;">PRECIO D</th>
												<th style="border-right: 1px solid #cfd8dc;">PESO</th>
												<th style="border-right: 1px solid #cfd8dc;">ALTO</th>
												<th style="border-right: 1px solid #cfd8dc;">ANCHO</th>
												<th style="border-right: 1px solid #cfd8dc;">PROFUNDO</th>
												<th style="border-right: 1px solid #cfd8dc;">STOCK REAL</th>
												<th style="border-right: 1px solid #cfd8dc;">RESERVA</th>
											</tr>
										</thead>
										<tfoot>
										<tr>
											<th>#</th>
											<th>ID#</th>
											<th>SKU</th>
											<th>ESTADO</th>
											
											<th>PRODUCTO</th>
											<th>EAN</th>
											<th>EAN-PACK</th>
											<th>DUN</th>
											<th>EXPIRA</th>
											<th>CREADO</th>
											<th>ACTUALIZADO</th>
											<th>UND</th>
											<th>COD.RELA</th>
											<th>COSTO</th>
											<th>DESCUENTO</th>
											<th>CATEGORIA</th>
											<th>SUBCATEGORIA</th>
											<th>LINEA</th>
											<th>PRECIO A</th>
											<th>PRECIO B</th>
											<th>PRECIO C</th>
											<th>PRECIO D</th>
											<th>PESO</th>
											<th>ALTO</th>
											<th>ANCHO</th>
											<th>PROFUNDO</th>
											<th>STOCK REAL</th>
											<th>RESERVA</th>
										</tr>
										</tfoot>
										<tbody>
											<?php
												foreach($listProduct as $store){
											?>
											<tr>
												<td><a href="javascript: void(0)" onclick="getProduct(<?= $store->id ?>)" title="editar producto"><i class="material-icons">mode_edit</i></a></td>
												<td style="border-right: 1px solid #cfd8dc;"><?= sprintf("%09d",$store->id) ?></td>
												<td style="border-right: 1px solid #cfd8dc;"><?= $store->_sku ?></td>
												<td style="border-right: 1px solid #cfd8dc;"><?= $store->_status ?></td>
												<td style="border-right: 1px solid #cfd8dc;"><?= $store->_product ?></td>
												<td style="border-right: 1px solid #cfd8dc;"><?= $store->_ean ?></td>
												<td style="border-right: 1px solid #cfd8dc;"><?= $store->_ean_pack ?></td>
												<td style="border-right: 1px solid #cfd8dc;"><?= $store->_ean_box ?></td>
												<td style="border-right: 1px solid #cfd8dc;"><?= $store->_expire ?></td>
												<td style="border-right: 1px solid #cfd8dc;"><?= $store->_create_at ?></td>
												<td style="border-right: 1px solid #cfd8dc;"><?= $store->_update_at ?></td>
												<td style="border-right: 1px solid #cfd8dc;"><?= $store->_und ?></td>
												<td style="border-right: 1px solid #cfd8dc;"><?= $store->_relacionship_package ?></td>
												<td style="border-right: 1px solid #cfd8dc;"><?= $store->_cost ?></td>
												<td style="border-right: 1px solid #cfd8dc;"><?= $store->_discount ?></td>
												<td style="border-right: 1px solid #cfd8dc;"><?= $store->grp ?></td>
												<td style="border-right: 1px solid #cfd8dc;"><?= $store->sgrp ?></td>
												<td style="border-right: 1px solid #cfd8dc;"><?= $store->_line ?></td>
												<td style="border-right: 1px solid #cfd8dc;"><?= number_format($store->_price_a,2,",",".") ?></td>
												<td style="border-right: 1px solid #cfd8dc;"><?= number_format($store->_price_b,2,",",".") ?></td>
												<td style="border-right: 1px solid #cfd8dc;"><?= number_format($store->_price_c,2,",",".") ?></td>
												<td style="border-right: 1px solid #cfd8dc;"><?= number_format($store->_price_d,2,",",".") ?></td>
												<td style="border-right: 1px solid #cfd8dc;"><?= $store->_weight ?></td>
												<td style="border-right: 1px solid #cfd8dc;"><?= $store->_height ?></td>
												<td style="border-right: 1px solid #cfd8dc;"><?= $store->_width ?></td>
												<td style="border-right: 1px solid #cfd8dc;"><?= $store->_large ?></td>
												<td style="border-right: 1px solid #cfd8dc;"><?= $store->_available_real ?></td>
												<td style="border-right: 1px solid #cfd8dc;"><?= $store->_available ?></td>
												
											</tr>
											<?php
											}
											?>
										</tbody>
									</table>
								</div>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
<script src="<?= PATH_PUBLIC_JS.'/app/app.product.js' ?>"></script>y