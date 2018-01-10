<link href="<?= PATH_PUBLIC_PLUGINS."/datatables/css/jquery.dataTables.min.css" ?>" rel="stylesheet" type="text/css"/>
<script src="<?= PATH_PUBLIC_PLUGINS."/datatables/js/jquery.dataTables.min.js" ?>"></script>
<main class="mn-inner">
	<div class="row">
		<div class="col s12">
			<div class="page-title">
				<i class="small material-icons">group</i>
			<?= lang("app_sidebar_option_usermanagement") ?></div>
			<div class="row">
				<div class="col s12 m12 l12">
					<ul class="tabs tab-demo z-depth-1" id="tbs" >
						<li class="tab col s6 m6 l6"><a  href="#list" class="active"><?= lang("app_useradmin_tab1") ?></a></li>
						<li class="tab col s6 m6 l6"><a href="#create"><?= lang("app_useradmin_tab2") ?></a></li>
					</ul>
				</div>
				<div id="list" class="col s12">
					<div class="card">
						<div class="card-content">
							<div class="row">
								<div class="col s12 m12 l12">
									<a class="waves-effect waves-light btn right-text indigo" id="link-new-user"><i class="material-icons left">group_add</i><?= lang('app_useradmin_button1') ?></a>
									<br>
									<br>
								</div>
								<div class="col s12 m12 l12">
									
									<table id="table-user" class="display responsive-table datatable-example">
										<thead>
											<tr>
												<th><?= lang('app_useradmin_tbcolumn7') ?></th>
												<th><?= lang('app_useradmin_tbcolumn1') ?></th>
												<th><?= lang('app_useradmin_tbcolumn2') ?></th>
												<th><?= lang('app_useradmin_tbcolumn3') ?></th>
												<th><?= lang('app_useradmin_tbcolumn4') ?></th>
												<th>#</th>
												<th>#</th>
												<th>#</th>
												<th>#</th>
											</tr>
										</thead>
										
										<tbody>
											<?php
											$i = 1;
												foreach ($list_user_admin as $key => $value):
											?>
											<tr>
												<td>
													<img class="circle responsive-img" src="<?= (!$value->_avatar_thumb) ? PATH_PUBLIC_IMG."/profile-image.png" : URL_WEB.$value->_avatar_thumb ?>" width="50px">
												</td>
												<td><?= $value->_nickname ?></td>
												<td><?= $value->_mail ?></td>
												<td><?= $value->_account ?></td>
												<td><?= $value->_country ?></td>
												<td style="text-align: center; vertical-align: middle;">
													
													<a class="btn-floating btn-small waves-effect waves-light blue" onclick=gi('<?= $value->id ?>') title="<?= lang('app_useradmin_title2') ?>"><i class="material-icons">info_outline</i></a>
												</td>
												<td style="text-align: center; vertical-align: middle;">
													<a class="btn-floating btn-small waves-effect waves-light light-green" onclick=rp('<?= $value->id ?>') title="<?= lang('app_useradmin_title3') ?>"><i class="material-icons">vpn_key</i></a>
												</td>
												<td style="text-align: center; vertical-align: middle;">
													<a class="btn-floating btn-small waves-effect waves-light green" onclick=bcku('<?= $value->id ?>') title="<?= lang('app_useradmin_title4') ?>" ><i class="material-icons">lock_outline</i></a>
												</td>
												<td style="text-align: center; vertical-align: middle;">
													<a class="btn-floating btn-small waves-effect waves-light yellow" onclick=storeAsig('<?= $value->id ?>') title="Asignar tiendas" ><i class="material-icons">store</i></a>
												</td>
											</tr>
											<?php
											$i++;
											endforeach;
											?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div id="modal2" class="modal" style="width: 1024px;">
							<div class="modal-content">
								<h4>Asignar Clientes a Usuario</h4>
								<form method="post" action="asigned-store-user" class="col s6 m12 l12" id="fastore">
									<div class="input-field col s12 m6 l12">
										<select name="_stores[]" id="_stores" class="js-example-basic-multiple browser-default  form-control" multiple="multiple" style="width: 100%; max-width: 80%;">
											
											<?php foreach (json_decode($listStore) as $key => $value):  ?>
											<option value="<?= $value->id ?>"><?= $value->id." - ".$value->_store ?></option>
											<?php endforeach; ?>
											<option value="9999999">9999999 - TODOS</option>
										</select>
										<input  id="_hidden_user" name="_hidden_user" placeholder="" type="hidden" class="validate">
									</div>
									<div class="row">
										<div class="input-field col s12 m6 l12">
											<button id="save_info" type="submit" class="btn btn-small waves-effect waves-light indigo">Asignar </button>
										</div>
										<div id="loader5"></div>
										
									</div>
								</form>
								<div id="tb-resutl">
									
								</div>
							</div>
							<div class="modal-footer">
								<a href="#!" class="modal-action modal-close waves-effect waves-blue btn-flat ">Cerrar</a>
							</div>
						</div>
						<div id="modal1" class="modal modal-fixed-footer" style="width: 1024px;">
							<div class="modal-content">
								<h4><?=  lang("app_useradmin_modal1") ?></h4>
								<form class="col s12 m8 l8" id="fus">
									<div class="row">
										<div class="input-field col s12 m6 l6">
											<input  id="idu" name="idu" type="hidden">
											<input  id="_first_name" name="_first_name" placeholder="" type="text" class="validate">
											<label for="_first_name"><?= lang("app_user_myaccount_input1") ?></label>
										</div>
										<div class="input-field col s12 m6 l6">
											<input  id="_last_name" name="_last_name" placeholder="" type="text" class="validate">
											<label for="_last_name"><?= lang("app_user_myaccount_input2") ?></label>
										</div>
									</div>
									<div class="row">
										<div class="input-field col s12 m6 l6">
											<input  id="_username_hidden" name="_username_hidden" type="hidden" placeholder="" class="validate"  >
											<input  id="_username" name="_username" type="text" placeholder="" class="validate"  >
											<label for="_username"><?= lang("app_user_myaccount_input20") ?></label>
											<div id="loader3"></div>
										</div>
										<div class="input-field col s12 m6 l6">
											<input  id="_mail" name="_mail" type="email" placeholder="" class="validate">
											<input  id="email_active_hidden" name="email_active_hidden" placeholder="" type="hidden"  >
											<label for="_mail"><?= lang("app_user_myaccount_input18") ?></label>
											<?= lang('app_user_email_label1') ?>
											<div id="loader"></div>
										</div>
									</div>
									<div class="row">
										<div class="input-field col s12 m6 l6">
											<input  id="email_other" name="email_other" type="email" placeholder="" class="validate">
											<input  id="email_other_hidden" name="email_other_hidden" placeholder="" type="hidden" >
											<label for="email_other"><?= lang("app_user_myaccount_input19") ?></label>
											<?= lang('app_user_email_label2') ?>
											<div id="loader2"></div>
										</div>
										
									</div>
									<div class="row">
										<div class="input-field col s12 m6 l6">
											<input  id="_typeid" name="_typeid"  type="text" placeholder="" class="validate" disabled="disabled">
											<label for="_typeid"><?= lang("app_user_myaccount_input3") ?></label>
										</div>
										<div class="input-field col s12 m6 l6">
											<input id="_idn" name="_idn" type="text" placeholder="" class="validate">
											<label for="_idn"><?= lang("app_user_myaccount_input4") ?></label>
										</div>
									</div>
									<div class="row">
										<div class="input-field col s12 m6 l6">
											<input placeholder="<?= lang("app_user_myaccount_input5") ?>" placeholder=""  id="_birthday" name="_birthday" type="text" class="datepicker">
										</div>
									</div>
									<div class="row">
										<div class="input-field col s12 m6 l6">
											<input  id="_countryid" name="_countryid"  type="text" placeholder="" class="validate" disabled="disabled">
											<label for="_countryid"><?= lang("app_title_register_input_country") ?></label>
										</div>
										
										<div class="input-field col s12 m6 l6">
											<input  id="_phone" name="_phone" type="text" placeholder=""  class="validate tooltipped" data-inputmask="'mask': '(99) 999-9999999'" data-position="bottom" data-delay="30" data-tooltip="<?= lang("app_user_myaccount_tooltip1") ?>">
											<label for="_phone"><?= lang("app_user_myaccount_input13") ?></label>
										</div>
									</div>
									<div class="row">
										<div class="input-field col s12 m12 l12">
											<input  id="_website" name="_website" placeholder=""  type="text" class="validate tooltipped" data-position="bottom" data-delay="30" data-tooltip="<?= lang("app_user_myaccount_tooltip2") ?>">
											<label for="_website"><?= lang("app_user_myaccount_input6") ?></label>
										</div>
									</div>
									<div class="row">
										<div class="input-field col s12 m6 l6">
											<input  id="_instagram" name="_instagram" placeholder="" type="text" class="validate tooltipped" data-position="bottom" data-delay="30" data-tooltip="<?= lang("app_user_myaccount_tooltip3") ?>">
											<label for="_instagram"><?= lang("app_user_myaccount_input7") ?></label>
										</div>
										<div class="input-field col s12 m6 l6">
											<input  id="_twitter" name="_twitter" placeholder="" type="text" class="validate tooltipped" data-delay="30" data-tooltip="<?= lang("app_user_myaccount_tooltip4") ?>">
											<label for="_twitter"><?= lang("app_user_myaccount_input9") ?></label>
										</div>
									</div>
									<div class="row">
										<div class="input-field col s12 m12 l12">
											<input  id="_facebook" name="_facebook" placeholder="" type="text" class="validate tooltipped" data-position="bottom" data-delay="30" data-tooltip="<?= lang("app_user_myaccount_tooltip5") ?>">
											<label for="_facebook"><?= lang("app_user_myaccount_input8") ?></label>
										</div>
										<div class="input-field col s12 m12 l12">
											<input  id="_linkedin" name="_linkedin" placeholder="" type="text" class="validate tooltipped" data-delay="30" data-tooltip="<?= lang("app_user_myaccount_tooltip6") ?>">
											<label for="_linkedin"><?= lang("app_user_myaccount_input10") ?></label>
										</div>
									</div>
									<div class="row">
										<div class="input-field col s12 m12 l12">
											<input  id="_youtube" name="_youtube" placeholder="" type="text" class="validate tooltipped" data-delay="30" data-tooltip="<?= lang("app_user_myaccount_tooltip7") ?>">
											<label for="_youtube"><?= lang("app_user_myaccount_input11") ?></label>
										</div>
										<div class="input-field col s12 m12 l12">
											<input  id="_vimeo" name="_vimeo" placeholder="" type="text" class="validate tooltipped" data-delay="30" data-tooltip="<?= lang("app_user_myaccount_tooltip8") ?>">
											<label for="_vimeo"><?= lang("app_user_myaccount_input12") ?></label>
										</div>
									</div>
									<div class="row">
										
										<button id="save_info" type="submit" class="btn-large waves-effect waves-light indigo"><i class="material-icons left">save</i> Grabar</button>
										<div id="loader5"></div>
										<div class="input-field col s12 m12 l12">
											<div id="loader5"></div>
										</div>
									</div>
								</form>
							</div>
							<div class="modal-footer">
								<a href="#!" class="modal-action modal-close waves-effect waves-blue btn-flat ">Cerrar</a>
							</div>
						</div>
					</div>
				</div>
				<div id="create" class="col s12">
					<div class="card">
						<div class="card-content">
							<div class="row">
								<div class="col s12 m12 l12">
									<div class="row">
										
										<form method="post" action="register-user-exec" class="col s6 m12 l12" id="fusadm">
											<div class="input-field col s12">
												<input id="user" name="user" type="text" class="validate">
												<label for="user"><?= lang("app_title_register_input_new_user") ?></label>
												<div id="loader1"></div>
											</div>
											<div class="input-field col s12">
												<input id="email" name="email" type="email" class="validate">
												<label for="email"><?= lang("app_title_register_input_email") ?></label>
												<div id="loader2"></div>
											</div>
											<div class="input-field col s12">
												<input id="password" name="password" type="password" class="validate">
												<label for="password"><?= lang("app_title_register_input_password") ?></label>
											</div>
											<div class="input-field col s12">
												<input id="rpassword" name="rpassword" type="password" class="validate">
												<label for="rpassword"><?= lang("app_title_register_input_repeat_passowrd") ?></label>
											</div>
											<div class="input-field col s12 m6 l12">
												<select name="typeAccount" id="typeAccount" class="js-states browser-default" style="width: 100%;">
													<option value="" disabled="" selected=""><?= lang("app_title_register_input_type_account_option3") ?></option>
													<?php foreach (json_decode($typeAccount) as $key => $value):  ?>
													<option value="<?= $value->id ?>"><?= $value->_account ?></option>
													<?php endforeach; ?>
												</select>
												
											</div>
											<div class="input-field col s12 m6 l12">
												<select name="_store[]" id="_store" class="js-example-basic-multiple browser-default" multiple="multiple" style="width: 100%;">
													<option value="" disabled="" selected=""><?= lang("app_title_register_input_type_account_option3") ?></option>
													<?php foreach (json_decode($listStore) as $key => $value):  ?>
													<option value="<?= $value->id ?>"><?= $value->id." - ".$value->_store ?></option>
													<?php endforeach; ?>
													<option value="9999999">9999999 - TODOS</option>
												</select>
												
											</div>
											<div class="input-field col s12 m6 l12">
												<div class="row right-text">
													<button type="submit" class="btn-large waves-effect waves-light btn indigo"><i class="material-icons left">save</i>Grabar</button>
												</div>
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
		</div>
	</div>
</main>
<script src="<?= PATH_PUBLIC_JS.'/app/app.unserialize.js' ?>"></script>
<script src="<?= PATH_PUBLIC_JS.'/app/app.useradmin.js' ?>"></script>