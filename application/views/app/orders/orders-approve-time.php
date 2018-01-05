<link href="<?= PATH_PUBLIC_PLUGINS."/datatables/css/jquery.dataTables.min.css" ?>" rel="stylesheet" type="text/css"/>
<script src="<?= PATH_PUBLIC_PLUGINS."/datatables/js/jquery.dataTables.min.js" ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS."/moment/moment.js" ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS."/moment/moment-with-locales.js" ?>"></script>
<main class="mn-inner">
<div class="row">
	<div class="col s12">
		<div class="card">
			<div class="card-content">
				<span class="card-title">Habilitar usuarios para realizar pedidos por horario</span>
				<div class="row s12 m6 l6">
				</div>
				<div class="row" id="tborders">
					<table id="table-warehouse" class="display responsive-table datatable-example">
						<thead>
							<tr>
								<th>IDTienda</th>
								<th>Tienda</th>
								<th>Razon Social</th>
								<th>Usuario/Pedido</th>
								<th>Rut</th>
								<th>Centro/Costo</th>
								<th>Horario</th>
								<th>#</th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach ($listStoreTimes as $key => $value) {
							?>
							<tr>
								<td align="center"><?= sprintf("%05d",$value->id_tienda) ?></td>
								<td align="right"><?= $value->nombre_tienda ?></td>
								<td align="right"><?= $value->nombres ?></td>
								<td align="right"><?= $value->usuario ?></td>
								<td><?= $value->rut ?></td>
								<td><?= $value->centro_costo ?></td>
								<td><?php

								if($value->habilitar_horario == 0){
									$class = "red-text parpadea";
									$text = "Habilitar Horario";
									$classb = "waves-effect waves-green btn-flat";
								}
								else{
									$class = "green-text";
									$text = "Deshabilitar Horario";
									$classb = "waves-effect waves-red btn-flat";
								}

								echo "<label class=".$class.">".$value->tipo_horario."</label>";
								?></td>
								<td><a class="<?= $classb ?>" onclick="habExec(<?=$value->id_tienda ?>)"><?= $text ?></a></td>
							</tr>
							<?php
							}
							?>
						</tbody>
					</table>
					
				</div>
				
			</div>
		</div>
	</div>
</div>
</main>
<script src="<?= PATH_PUBLIC_JS.'/app/app.orders.js' ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS.'/phpjs/number_format.js' ?>"></script>