<link href="<?= PATH_PUBLIC_PLUGINS."/datatables/css/jquery.dataTables.min.css" ?>" rel="stylesheet" type="text/css"/>
<script src="<?= PATH_PUBLIC_PLUGINS."/datatables/js/jquery.dataTables.min.js" ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS."/moment/moment.js" ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS."/moment/moment-with-locales.js" ?>"></script>
<main class="mn-inner">
<div class="row">
	<div class="col s12">
		<div class="card">
			<div class="card-content">
				<span class="card-title"><?= lang('app_process_text16') ?></span>
				<div class="row s12 m6 l6">
					<form id="fmchange">
						<div class="row left-text">
							<div class="input-field col s12 m6 l4">
								<select name="store_id_rel1" id="store_id_rel1" class="js-states browser-default" style="width: 100%">
									<option value="" disabled="" selected=""> </option>
									<?php foreach (json_decode($listStoreActive) as $key => $value):  ?>
									<option value="<?= $value->id_tienda ?>"><?= sprintf("%05d",$value->id_tienda)." - ".$value->nombre_tienda ?></option>
									<?php endforeach; ?>
								</select>
								<input  id="rewrite" name="rewrite" type="hidden" placeholder="" class="validate" readonly="true">
								<div id="loader-user-rel"></div>
							</div>
							<div class="input-field col s12 m12 l8">
								<select name="user_id_rel1" id="user_id_rel1" class="js-states browser-default" style="width: 100%">
									<option value="" disabled="" selected=""> </option>
									<?php foreach (json_decode($listUserActive) as $key => $value):  ?>
									<option value="<?= $value->id_usuario ?>"><?= sprintf("%05d",$value->id_usuario)." - ".$value->usuario." - ".$value->nombres  ?></option>
									<?php endforeach; ?>
								</select>
								
								<div id="loader-user-rel"></div>
							</div>
							<div class="input-field col s12 m12 l12">
								<div id="loader-user-reltab"></div>
							</div>
							<div class="input-field col s12 m6 l4">
								<button id="save_list_new_q" type="submit" class="btn waves-effect waves-light teal lighten-2" onclick="return false;">
								Relacionar</button>
								
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="<?= PATH_PUBLIC_JS.'/app/app.store.temp.js' ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS.'/phpjs/number_format.js' ?>"></script>