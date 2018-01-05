<link href="<?= PATH_PUBLIC_PLUGINS."/datatables/css/jquery.dataTables.min.css" ?>" rel="stylesheet" type="text/css"/>
<script src="<?= PATH_PUBLIC_PLUGINS."/datatables/js/jquery.dataTables.min.js" ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS."/moment/moment.js" ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS."/moment/moment-with-locales.js" ?>"></script>
<main class="mn-inner">
<div class="row">
	<div class="col s12">
		<div class="card">
			<div class="card-content">
				<span class="card-title">CAMBIAR ESTADO DE PEDIDOS</span>
				<div class="row s12 m6 l6">
					<form id="fmbus">
						<div class="row left-text">
							<div class="input-field col s6">
								<input  id="nstore" name="nstore" type="text" placeholder="" class="validate">
								<label for="store">Nombre de Fantasia</label>
								<br>
								<br>
								<br>
								<div id="loader3">
								</div>
							</div>
							<div class="input-field col s6 right-text">
								<button type="submit" class="btn-floating btn-large waves-effect waves-light btn yellow darken-2" title="buscar informacion de tienda"><i class="material-icons">search</i></button>
								
							</div>
						</div>
						
					</form>
				</div>
				<div class="row">
					<div class="col s12 m12 l12" id="result-pending">
					</div>
				</div>
				<div class="row">
					<div class="row no-m-t no-m-b">
						<div class="col s12 m12 l4">
							<div class="card stats-card">
								<div class="card-content">
									<span class="card-title"><?= lang('app_process_text5') ?></span>
									<span class="stats-counter"><span class="counter t1">0</span><small></small></span>
									
								</div>
								<div class="progress stats-card-progress">
									<div class="determinate" style="width: 100%"></div>
								</div>
							</div>
						</div>
						<div class="col s12 m12 l4">
							<div class="card stats-card">
								<div class="card-content">
									<span class="card-title"><?= lang('app_process_text6') ?></span>
									<span class="stats-counter"><span class="counter t2">0</span><small></small></span>
									
								</div>
								<div class="progress stats-card-progress">
									<div class="determinate" style="width: 100%"></div>
								</div>
							</div>
						</div>
						<div class="col s12 m12 l4">
							<div class="card stats-card">
								<div class="card-content">
									<span class="card-title"><?= lang('app_process_text7') ?></span>
									<span class="stats-counter"><span class="counter t3">0</span><small></small></span>
									
								</div>
								<div class="progress stats-card-progress">
									<div class="determinate" style="width: 100%"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row" id="tborders">
					
					
				</div>
				
			</div>
		</div>
	</div>
</div>
<div id="modal1" class="modal" style="z-index: 1003; display: block; opacity: 0; transform: scaleX(0.7); top: 250.516304347826px;">
	<div class="modal-content">
		<h5>Cambiar estado del pedido</h5>
		<label></label>
		<form id="fmconfirm" class="col s12 m8 l8">
			<div class="row left-text">
				<div class="input-field col s12 m12 l12">
					<select name="states" id="states" class="js-states browser-default" width="100%">
						<option value="" disabled="" selected=""><?= lang("app_process_text4") ?></option>
						<?php foreach (json_decode($listState) as $key => $value):  ?>
						<option value="<?= $value->id_estado ?>"><?= sprintf("%05d",$value->id_estado)." - ".$value->estado ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				
				<div class="input-field col s12 m12 l12">
					<textarea id="obs" name="obs" class="materialize-textarea" length="120"></textarea>
					<label for="textarea1" class="">Observación</label>
					<span class="character-counter" style="float: right; font-size: 12px; height: 1px;"></span>
				</div>
				<div class="input-field col s12 m12 l12 right-text">
					<button type="submit" class="btn waves-effect waves-light btn yellow darken-2" title="buscar informacion de tienda">Cambiar Estado</button>
					
				</div>
				<div id="loader13">
					
				</div>
			</div>
		</form>
	</div>
	<div class="modal-footer">
		<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Cerrar</a>
	</div>
</divv
</main>
<script src="<?= PATH_PUBLIC_JS.'/app/app.orders.change.js' ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS.'/phpjs/number_format.js' ?>"></script>