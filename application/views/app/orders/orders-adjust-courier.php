<link href="<?= PATH_PUBLIC_PLUGINS."/datatables/css/jquery.dataTables.min.css" ?>" rel="stylesheet" type="text/css"/>
<script src="<?= PATH_PUBLIC_PLUGINS."/datatables/js/jquery.dataTables.min.js" ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS."/moment/moment.js" ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS."/moment/moment-with-locales.js" ?>"></script>
<main class="mn-inner">
	<div class="row">
		<div class="col s4">
			<div class="card">
				<div class="card-content">
					<span class="card-title">Ajustar Transporte</span>
					<div class="row s12 m6 l6">
						<form id="fmfo">
							
							<div class="row left-text">
								<div class="input-field col s12 m8 l8">
									<input  id="nordenf" name="nordenf" type="text" placeholder="" class="validate" style="text-align: right; font-size: 25px;">
									<label for="nordenf">Nro. Orden</label>
									<br>
									
									<div id="loader3">
									</div>
								</div>

								<div class="input-field col s4 m4 l4 right-text">
									<button id="forden" class="btn-floating btn-large waves-effect waves-light btn yellow darken-2" title="buscar informacion de tienda"><i class="material-icons">search</i></button>
									
								</div>
							</div>
							<div class="row left-text">
								<div class="input-field col s12 m12 l12">
									<input  id="descuento" name="descuento" type="number" placeholder="" class="validate" style="text-align: center; font-size: 25px;" value="0" min="0" max="100">
									<label for="transport">Descuento expresado en %</label>
								</div>
							</div>
							<div class="row left-text">
								<div class="input-field col s12 m12 l12">


								<input  id="transport1" name="transport1" type="hidden" placeholder="" class="validate" style="text-align: right; font-size: 25px;" readonly="reandonly">
									<input  id="descuento1" name="descuento1" type="hidden" placeholder="" class="validate" style="text-align: right; font-size: 25px;" readonly="reandonly">
									<input  id="neto_orden1" name="neto_orden1" type="hidden" placeholder="" class="validate" style="text-align: right; font-size: 25px;" readonly="reandonly">
									<input  id="sub_orden1" name="sub_orden1" type="hidden" placeholder="" class="validate" style="text-align: right; font-size: 25px;" readonly="reandonly">
									<input  id="iva_orden1" name="iva_orden1" type="hidden" placeholder="" class="validate" style="text-align: right; font-size: 25px;" readonly="reandonly">
									<input  id="total_orden1" name="total_orden1" type="hidden" placeholder="" class="validate" style="text-align: right; font-size: 25px;" readonly="reandonly">

									<input  id="transport" name="transport" type="text" placeholder="" class="validate" style="text-align: right; font-size: 25px;" readonly="reandonly">
									<label for="transport">Transporte</label>
								</div>
							</div>
							<div class="row left-text">
								<div class="input-field col s12 m12 l12">
									<input  id="neto_orden" name="neto_orden" type="text" placeholder="" class="validate" style="text-align: right; font-size: 25px;" readonly="reandonly">
									<label for="neto_orden">Neto de la orden</label>
								</div>
							</div>
							<div class="row left-text">
								<div class="input-field col s12 m12 l12">
									<input  id="sub_orden" name="sub_orden" type="text" placeholder="" class="validate" style="text-align: right; font-size: 25px;" readonly="reandonly">
									<label for="sub_orden">Subtotal de la orden</label>
								</div>
							</div>
							<div class="row left-text">
								<div class="input-field col s12 m12 l12">
									<input  id="iva_orden" name="iva_orden" type="text" placeholder="" class="validate" style="text-align: right; font-size: 25px;" readonly="reandonly">
									<label for="iva_orden">Iva</label>
								</div>
							</div>
							
							<div class="row left-text">
								<div class="input-field col s12 m12 l12">
									<input  id="total_orden" name="total_orden" type="text" placeholder="" class="validate" style="text-align: right; font-size: 25px;" readonly="reandonly">
									<label for="total_orden">total</label>
								</div>
								<div class="input-field col s4 m4 l8 right-text">
									<button type="submit" id="btajust" class="btn btn-large waves-effect waves-light btn yellow darken-2" title="ajustar despacho" disabled="disabled"><i class="material-icons left">build</i> Ajustar Despacho </button>
									
								</div> 
							</div>
							
						</form>
					</div>
					<div class="row" id="tborders">
						
						
					</div>
					
				</div>
			</div>
		</div>
	</div>
</main>
<script src="<?= PATH_PUBLIC_JS.'/app/app.orders.js' ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS.'/phpjs/number_format.js' ?>"></script>