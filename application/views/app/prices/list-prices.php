<link href="<?= PATH_PUBLIC_PLUGINS."/datatables/css/jquery.dataTables.min.css" ?>" rel="stylesheet" type="text/css"/>
<script src="<?= PATH_PUBLIC_PLUGINS."/datatables/js/jquery.dataTables.min.js" ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS."/moment/moment.js" ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS."/moment/moment-with-locales.js" ?>"></script>
<main class="mn-inner">
<div class="row">
	<div class="col s12">
		<div class="card">
			<div class="card-content">
				<span class="card-title">Consulta Rapida de Información de Lista de Productos</span>
				<div class="row s12 m6 l6">
				</div>
				<div class="row" id="tborders" style="overflow-x: auto; white-space: nowrap;">
					<table id="table-warehouse" class="display responsive-table datatable-example">
						<thead>
							<tr>
								<th>CODIGO</th>
								<th>EAN</th>
								<th>EAN-EMPAQ</th>
								<th>EAN-CAJA</th>
								<th>PROD</th>
								<th>COSTE</th>
								<th>INV/TEORICO</th>
								<th>PROD/TIENDA/ACTIVO</th>
								<th>PROD/TIENDA/BLOQUEADO</th>
								<th>PRECIO/MIN</th>
								<th>PRECIO/MAX</th>
								<th>PROMEDIO</th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach ($listProduct as $key => $value) {
							?>
							<tr>
								<td align="center"><?= $value->codigo ?></td>
								<td align="center"><?= $value->ean ?></td>
								<td align="center"><?= $value->ean_empaque ?></td>
								<td align="center"><?= $value->ean_caja ?></td>
								<td align="right"><?= $value->nombre ?></td>
								<td><?= number_format($value->coste, 2, ",", "."). "$" ?></td>
								<td><?= $value->inventario_teorico ?></td>
								<td><a href="javascript: void(0)" onclick=openModalAc("<?= $value->codigo ?>")><?= $value->t_tiendas_ac ?></a></td>
								<td><a href="javascript: void(0)" onclick=openModalIn("<?= $value->codigo ?>")><?= $value->t_tiendas_in ?></a></td>
								<td><?= number_format($value->t_min_price, 2, ",", "."). "$" ?></td>
								<td><?= number_format($value->t_max_price, 2, ",", "."). "$" ?></td>
								<td><?= number_format(round($value->t_promedio), 2, ",", "."). "$" ?></td>
							</tr>
							<?php
							}
							?>
						</tbody>
					</table>
					
				</div>
				<div class="row">
					<div id="modal1" class="modal" style=" width: 1024px; height: 1024px;">
						<div class="modal-content">
							<h4>Productos disponible en Tiendas</h4>
							<label class="green-text prd"></label>
							<div id="tb-list-store-prod">
								
							</div>
						</div>
						<div class="modal-footer">
							<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Salir</a>
						</div>
					</div>
				</div>

				<div class="row">
					<div id="modal2" class="modal" style=" width: 1024px; height: 1024px;">
						<div class="modal-content">
							<h4>Productos en Tienda</h4>
							<label class="green-text prd2"></label>
							<div id="tb-list-store">
								
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
<script src="<?= PATH_PUBLIC_JS.'/app/app.prices.js' ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS.'/phpjs/number_format.js' ?>"></script>