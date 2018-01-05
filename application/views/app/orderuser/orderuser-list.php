<link href="<?= PATH_PUBLIC_PLUGINS."/datatables/css/jquery.dataTables.min.css" ?>" rel="stylesheet" type="text/css"/>
<script src="<?= PATH_PUBLIC_PLUGINS."/datatables/js/jquery.dataTables.min.js" ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS."/moment/moment.js" ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS."/moment/moment-with-locales.js" ?>"></script>
<main class="mn-inner">
<div class="row">
	<div class="col s12">
		<div class="card">
			<div class="card-content">
				<span class="card-title">Ver Lista de Pedidos generados por clientes</span>
				<div class="row s12 m6 l6">
				</div>
				<div class="row" id="tborders" style="overflow-x: auto; white-space: nowrap;">
					<table id="table-warehouse" class="display responsive-table datatable-example" style="font-size: 14px;">
						<thead>
							<tr>
								<th>PREMIO</th>
							   <th>CAMBIAR</th>
								<th>PEDIDO</th>
								<th>FACT</th>
								<th>GUIA</th>
								<th>DESP</th>
								<th>ESTADO</th>
								<th>TIENDA</th>
								<th>RAZON</th>
								<th>INICIO</th>
								<th>FIN</th>
								<th>NETO</th>
								<th>SUBT</th>
								<th>IVA</th>
								<th>TOTAL</th>
							</tr>
						</thead>
						<tfoot>
            <tr>
                <th colspan="4" style="text-align:right">Total:</th>
                <th></th>
            </tr>
        </tfoot>
						<tbody>
							<?php


							foreach ($listAllOrder as $key => $value) {
								$date = new DateTime($value->fecha_inicio);
								$dates = new DateTime($value->fecha_cierre);

								$date1=date_create($date->format('Y-m-d'));
								$date2=date_create($dates->format('Y-m-d'));
								$diff=date_diff($date1,$date2);
								
								if($value->count_promo  == 0){
							?>
							<tr>
								<td align="center"><a href="javascript: void(0)" onclick="gifPromo(<?= $value->id_pedido ?>, 'MA0027')" ><i class="material-icons medium">card_giftcard</i></td>
							<?php
						}
						else{ ?>
						<td align="center"><label class="green-text">ENTREGADO</label></td>
						<?php
					}
							?>
							<td align="center">
							<?php
							if($value->estado_pedido == 3 || $value->estado_pedido == 6 || $value->estado_pedido == 15 || $value->estado_pedido == 7 ){
							?>
							<a href="javascript: void(0)" onclick="changeState(<?= $value->id_pedido ?>, 9)" class="btn indigo">LPD</a>
							<a href="javascript: void(0)" onclick="changeState(<?= $value->id_pedido ?>, 18)" class="btn orange sm">Pickeado</a>
							<?php
						}
						else if($value->estado_pedido == 10 || $value->estado_pedido == 18 || $value->estado_pedido == 19 || $value->estado_pedido == 20 || $value->estado_pedido == 22){
							?>
							<a href="javascript: void(0)" onclick="changeState(<?= $value->id_pedido ?>, 9)" class="btn indigo">LPD</a>

							<?php
						}
						else{

						}
							?>
							</td>
								<td align="center"><a href="javascript: void(0)" onclick="openModal(<?= $value->id_pedido ?>)"><?= sprintf("%05d",$value->id_pedido) ?></a></td>
								<td align="right"><a href="javascript: void(0)" onclick="openModal2(<?= $value->id_pedido ?>)"><?= $value->total_f ?></a></td>
								<td align="right"><?= sprintf("%05d",$value->numero_guia) ?></td>
								<td align="right"><?= sprintf("%05d",$value->despacho) ?></td>
								<td><?= $value->estado ?></td>
								<td style="width: 10%;  overflow-wrap: break-word;"><?= $value->nombre_tienda ?></td>
								<td style="width: 10%;  overflow-wrap: break-word;"><?= $value->nombres ?></td>
								<td><?= $date->format('d-m-Y'); ?></td>
								<td><?= $dates->format('d-m-Y'); ?></td>
								<td><?= number_format($value->neto, 2, ",", "."). " $" ?></td>
								<td><?= number_format($value->subtotal, 2, ",", "."). " $" ?></td>
								<td class="red-text"><?= number_format($value->iva, 2, ",", "."). " $" ?></td>
								<td class="blue-text"><?= number_format(round($value->total_pedido), 2, ",", "."). " $" ?></td>
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
							<h4>Detalle del pedido</h4>
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
					<div id="modal2" class="modal" style=" width: 1024px; height: auto;">
						<div class="modal-content">
							<h4>facturas asociadas a pedido</h4>
							<label class="green-text prd2"></label>
							<div id="tb-list-store-prod2">
								
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
<script src="<?= PATH_PUBLIC_JS.'/app/app.orderuser.js' ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS.'/phpjs/number_format.js' ?>"></script>