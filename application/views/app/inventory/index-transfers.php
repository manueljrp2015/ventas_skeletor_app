<link href="<?= PATH_PUBLIC_PLUGINS."/datatables/css/jquery.dataTables.min.css" ?>" rel="stylesheet" type="text/css"/>
<script src="<?= PATH_PUBLIC_PLUGINS."/datatables/js/jquery.dataTables.min.js" ?>"></script>
<main class="mn-inner">
<div class="row">
	<div class="col s12">
		<div class="page-title">
			<i class="material-icons">view_module</i>
		<?= lang("app_transfer_text1") ?></div>
		<div class="row">
			<div class="col s12 m12 l12">
				<ul class="tabs tab-demo z-depth-1" id="tbs" >
					<li class="tab col s6 m6 l6"><a  href="#list" class="active"><?= lang("app_transfer_text1") ?></a></li>
					<li class="tab col s6 m6 l6"><a href="#create"><?= lang("app_transfer_text2") ?></a></li>
				
				</ul>
			</div>
			<div id="list" class="col s12">
				<div class="card">
					<div class="card-content">
						<div class="row">
							<table id="table-warehouse" class="display responsive-table datatable-example">
								<thead>
									<tr>
										<th><?= lang('app_transfer_text3') ?></th>
										<th><?= lang('app_transfer_text4') ?></th>
										<th><?= lang('app_transfer_text5') ?></th>
										<th><?= lang('app_transfer_text6') ?></th>
										<th><?= lang('app_transfer_text7') ?></th>
										<th><?= lang('app_transfer_text8') ?></th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><?= lang('app_transfer_text3') ?></td>
										<td><?= lang('app_transfer_text4') ?></td>
										<td><?= lang('app_transfer_text5') ?></td>
										<td><?= lang('app_transfer_text6') ?></td>
										<td><?= lang('app_transfer_text6') ?></td>
										<td><?= lang('app_transfer_text6') ?></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div id="create" class="col s12">
				<div class="card">
					<div class="card-content">
						<div class="row">
							<form method="post" action="register-user-exec" class="col s6 m12 l12" id="fusadm">
								<div class="input-field col s12 m6 l6">
									<select name="country" id="country">
										<option value="" disabled="" selected=""><?= lang("app_title_register_input_type_account_option3") ?></option>
										<?php foreach (json_decode($country) as $key => $value):  ?>
										<option value="<?= $value->id ?>"><?= $value->_country." - ".$value->_prefix ?></option>
										<?php endforeach; ?>
									</select>
									<label><?= lang("app_transfer_text4") ?></label>
								</div>
								<div class="input-field col s12 m6 l6">
									<select name="country" id="country">
										<option value="" disabled="" selected=""><?= lang("app_title_register_input_type_account_option3") ?></option>
										<?php foreach (json_decode($country) as $key => $value):  ?>
										<option value="<?= $value->id ?>"><?= $value->_country." - ".$value->_prefix ?></option>
										<?php endforeach; ?>
									</select>
									<label><?= lang("app_transfer_text5") ?></label>
								</div>
								
								<div class="input-field col s12 m6 l6">
									<input id="email" name="email" type="email" class="validate">
									<label for="email"><?= lang("app_transfer_text9") ?></label>
									<div id="loader2"></div>
								</div>
								<div class="row right-text">
									<button disabled="disabled" type="submit" class="btn-floating btn-large waves-effect waves-light btn yellow darken-2"><i class="material-icons">save</i></button>
								</div>
								<div class="input-field col s12">
									<div id="loader3">
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</main>
<script src="<?= PATH_PUBLIC_JS.'/app/app.inventory.js' ?>"></script>