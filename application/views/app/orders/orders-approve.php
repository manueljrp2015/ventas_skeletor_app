<link href="<?= PATH_PUBLIC_PLUGINS."/datatables/css/jquery.dataTables.min.css" ?>" rel="stylesheet" type="text/css"/>
<script src="<?= PATH_PUBLIC_PLUGINS."/datatables/js/jquery.dataTables.min.js" ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS."/moment/moment.js" ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS."/moment/moment-with-locales.js" ?>"></script>
<main class="mn-inner">
<div class="row">
	<div class="col s12">
		<div class="card">
			<div class="card-content">
				<span class="card-title"><?= lang('app_process_text3') ?></span>
				<div class="row s12 m6 l6">
					<form id="fmbus">

					 
						<div class="row left-text">
							<div class="input-field col s12 m8 l8">
								<select name="store" id="store" class="js-states browser-default">
									<option value="" disabled="" selected=""><?= lang("app_process_text4") ?></option>
									<?php foreach (json_decode($listStore) as $key => $value):  ?>
									<option value="<?= $value->id_tienda ?>"><?= $value->nombres." - ".sprintf("%05d",$value->id_tienda)." - ".$value->nombre_tienda ?></option>
									<?php endforeach; ?>
								</select>
								<br>
								<br>
								<br>
								<div id="loader3">
								</div>
							</div>
							<div class="input-field col s4 m4 l4 right-text">
								<button type="submit" class="btn-floating btn-large waves-effect waves-light btn yellow darken-2" title="buscar informacion de tienda"><i class="material-icons">search</i></button>
								<button type="button" class="btn-floating btn-large waves-effect waves-light btn green darken-1" id="process" title="Liberar tienda para pedido"><i class="material-icons">settings</i></button>
							</div>
						</div>
						
					</form>
				</div>

				<div class="row">
					<div class="col s12 m12 l12" id="result-client">

					</div>
					<div class="col s12 m12 l12" id="result-razon">
					</div>
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
</main>
<script src="<?= PATH_PUBLIC_JS.'/app/app.orders.js' ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS.'/phpjs/number_format.js' ?>"></script>