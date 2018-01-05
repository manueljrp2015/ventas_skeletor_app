<link href="<?= PATH_PUBLIC_PLUGINS."/datatables/css/jquery.dataTables.min.css" ?>" rel="stylesheet" type="text/css"/>
<script src="<?= PATH_PUBLIC_PLUGINS."/datatables/js/jquery.dataTables.min.js" ?>"></script>
<main class="mn-inner">
<div class="row">
	<div class="col s12">
		<div class="page-title">
			<i class="small material-icons">store</i>
		<?= lang("app_warehouse_text3") ?></div>
		<div class="row">
			<div class="col s12 m12 l12">
				<ul class="tabs tab-demo z-depth-1" id="tbs" >
					<li class="tab col s6"><a  href="#list" class="active"><?= lang("app_warehouse_text1") ?></a></li>
					<li class="tab col s6"><a href="#create" ><?= lang("app_warehouse_text2") ?></a></li>
				</ul>
			</div>
			<div id="list" class="col s12">
				<div class="card">
					<div class="card-content">
						<div class="row">
							<table id="table-warehouse" class="display responsive-table datatable-example">
								<thead>
									<tr>
										<th><?= lang('app_warehouse_text4') ?></th>
										<th><?= lang('app_warehouse_text5') ?></th>
										<th><?= lang('app_warehouse_text6') ?></th>
										<th><?= lang('app_warehouse_text7') ?></th>
										<th>#</th>
									</tr>
								</thead>
								<tbody>
									<?php
									foreach ($warehouse as $key => $value):
									?>
									<tr>
										<td><?= sprintf("%05d",$value->id) ?></td>
										<td><?= $value->_warehouse  ?></td>
										<td><?= $value->_managment  ?></td>
										<td><?= $value->_warehouse_type  ?></td>
										<td><a class="btn-floating btn-mini waves-effect waves-light light-green accent-4" onclick=w('<?= $value->id ?>') title="<?= lang('app_businessadmin_text2') ?>"><i class="material-icons">edit</i></a></td>
									</tr>
								</tbody>
								<?php
								endforeach;
								?>
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
						<form method="post" action="register-user-exec" class="col s12" id="fware">
							<div class="input-field col s12">
								<input placeholder="" id="_warehouse" name="_warehouse" type="text" class="validate">
								<input placeholder="" id="_IDUser" value="<?= $this->session->userdata("id") ?>" name="_IDUser" type="hidden" class="validate">
								<label for="_warehouse"><?= lang("app_warehouse_text5") ?></label>
							</div>
							<div class="input-field col s12">
								<input placeholder="" id="_management" name="_management" type="text" class="validate">
								<label for="_management"><?= lang("app_warehouse_text6") ?></label>
							</div>
							
							
							<div class="input-field col s12">
								<select name="_IDTypew" id="_IDTypew">
									<option value="" disabled="" selected=""><?= lang("app_title_register_input_type_account_option3") ?></option>
									<?php foreach (json_decode($warehouse_type) as $key => $value):  ?>
									<option value="<?= $value->id ?>"><?= $value->_warehouse_type ?></option>
									<?php endforeach; ?>
								</select>
								<label><?= lang("app_warehouse_text7") ?></label>
							</div>
							
							<div class="row right-text">
								<button  type="submit" class="btn-floating btn-large waves-effect waves-light btn yellow darken-2"><i class="material-icons">save</i></button>
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
<div id="modal3" class="modal modal-fixed-footer" style="z-index: 1003; display: block; opacity: 0; transform: scaleX(0.7); top: 250.516304347826px;">
<div class="modal-content">
	<h4>Actualizar Almacen</h4>
	<form method="post" action="register-user-exec" class="col s12" id="fware_edit">
		<div class="input-field col s12">
			<input placeholder="" id="_warehouse2" name="_warehouse2" type="text" class="validate">
			<input placeholder="" id="id_hidden" name="id_hidden"  value="<?= $this->session->userdata("id") ?>"  type="hidden" class="validate">
			<label for="_warehouse"><?= lang("app_warehouse_text5") ?></label>
		</div>
		<div class="input-field col s12">
			<input placeholder="" id="_management2" name="_management2" type="text" class="validate">
			<label for="_management"><?= lang("app_warehouse_text6") ?></label>
		</div>
		
		
		<div class="input-field col s12">

			<select name="_IDTypew2" id="_IDTypew2">
				<option value="" disabled="" selected=""><?= lang("app_title_register_input_type_account_option3") ?></option>
				<?php foreach (json_decode($warehouse_type) as $key => $value):  ?>
				<option value="<?= $value->id ?>"><?= $value->_warehouse_type ?></option>
				<?php endforeach; ?>
			</select>
			
		</div>
		<br>
		<div class="row right-text">
			<button  type="submit" class="btn-floating btn-large waves-effect waves-light btn yellow darken-2"><i class="material-icons">save</i></button>
		</div>
		<div class="input-field col s12">
			<div id="loader9">
			</div>
		</div>
	</form>
</div>
<div class="modal-footer">
	<a href="#!" class="modal-action modal-close waves-effect waves-blue btn-flat ">Cerrar</a>
</div>
</div>
</main>
<script src="<?= PATH_PUBLIC_JS.'/app/app.inventory.js' ?>"></script>
<link href="<?= PATH_PUBLIC_PLUGINS."/select2/css/select2.css" ?>" rel="stylesheet" type="text/css"/>
<script src="<?= PATH_PUBLIC_PLUGINS.'/select2/js/select2.min.js' ?>"></script>