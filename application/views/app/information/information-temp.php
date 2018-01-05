<link href="<?= PATH_PUBLIC_PLUGINS."/datatables/css/jquery.dataTables.min.css" ?>" rel="stylesheet" type="text/css"/>
<script src="<?= PATH_PUBLIC_PLUGINS."/datatables/js/jquery.dataTables.min.js" ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS."/moment/moment.js" ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS."/moment/moment-with-locales.js" ?>"></script>
<main class="mn-inner">
	<div class="row">
		<div class="col s12">
			<div class="card">
				<div class="card-content">
					<span class="card-title">Consulta Rapida de Información de tiendas</span>
					<div class="row s12 m6 l6">
					</div>
					<div class="row" id="tborders">
						<table id="table-warehouse" class="display responsive-table datatable-example">
							<thead>
								<tr>
									<th>IDTienda</th>
									<th>Tienda</th>
									<th>Rut</th>
									<th>Centro/Costo</th>
									<th>Razon Social</th>
									<th>Acceso</th>
								</tr>
							</thead>
							<tbody>
								<?php
								foreach ($listInfo as $key => $value) {
								?>
								<tr>
									<td align="center"><a href="javascript: void(0)" onclick="addInfo(<?= $value->id_tienda ?>)"><?= sprintf("%05d",$value->id_tienda) ?></a></td>
									<td align="right"><?= $value->nombre_tienda ?></td>
									<td><?= $value->rut ?></td>
									<td><?= $value->centro_costo ?></td>
									<td><?= $value->nombres ?></td>
									<td> <?= $value->pw ?> </td>
								</tr>
								<?php
								}
								?>
							</tbody>
						</table>
						
					</div>
					<div class="row">
						<div id="modal1" class="modal" style=" width: 1024px; height: auto;">
							<div class="modal-content">
								<h4>Información Adicional</h4>
								<label class="green-text prd"></label>
								<div class="row">
									<div class="input-field col s12 m6 l2">
										<input  id="rut" name="rut" type="text" placeholder="" class="validate" readonly="true">
										<label for="rut">RUT</label>
										
									</div>
									<div class="input-field col s12 m6 l10">
										<input  id="infof" name="infof" type="text" placeholder="" class="validate" readonly="true">
										<label for="infof">NOMBRE DE FANTASIA</label>
									</div>
									<div class="input-field col s12 m6 l12">
										<input  id="infora" name="infora" type="text" placeholder="" class="validate" readonly="true">
										<label for="store">RAZON SOCIAL</label>
									</div>
								</div>

								<div class="row">
									<div class="input-field col s12 m6 l4">
										<input  id="inforutc" name="inforutc" type="text" placeholder="" class="validate" readonly="true">
										<label for="inforutc">RUT-COMPLETO</label>
										
									</div>
									<div class="input-field col s12 m6 l4">
										<input  id="codgiro" name="codgiro" type="text" placeholder="" class="validate" readonly="true">
										<label for="codgiro">CODIGO-GIRO</label>
									</div>
									<div class="input-field col s12 m6 l4">
										<input  id="codpais" name="codpais" type="text" placeholder="" class="validate" readonly="true">
										<label for="codpais">CODIGO-PAIS</label>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12 m6 l4">
										<input  id="codreg" name="codreg" type="text" placeholder="" class="validate" readonly="true">
										<label for="codreg">CODIGO-REGIÓN</label>
									
									</div>
									<div class="input-field col s12 m6 l4">
										<input  id="codciu" name="codciu" type="text" placeholder="" class="validate" readonly="true">
										<label for="codciu">CODIGO-CIUDAD</label>
									</div>
									<div class="input-field col s12 m6 l4">
										<input  id="codcom" name="codcom" type="text" placeholder="" class="validate" readonly="true">
										<label for="codcom">CODIGO-COMUNA</label>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12 m6 l6">
										<input  id="dird" name="dird" type="text" placeholder="" class="validate" readonly="true">
										<label for="dird">DIRECCIÓN DE DESPACHO</label>
										
									</div>
									<div class="input-field col s12 m6 l6">
										<input  id="dirfac" name="dirfac" type="text" placeholder="" class="validate" readonly="true">
										<label for="dirfac">DIRECCIÓN DE FACTURACIÓN</label>
									</div>
									<div class="input-field col s12 m6 l4">
										<input  id="emcon" name="emcon" type="text" placeholder="" class="validate" readonly="true">
										<label for="emcon">EMAIL DE CONTACTO</label>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12 m6 l4">
										<input  id="emaildte" name="emaildte" type="text" placeholder="" class="validate" readonly="true">
										<label for="emaildte">EMAIL DTE</label>
										
									</div>
									
								</div>
							</div>
							<div class="modal-footer">
								<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Salir</a>
							</div>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</main>
<script src="<?= PATH_PUBLIC_JS.'/app/app.information.js' ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS.'/phpjs/number_format.js' ?>"></script>