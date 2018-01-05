<link href="<?= PATH_PUBLIC_PLUGINS."/datatables/css/jquery.dataTables.min.css" ?>" rel="stylesheet" type="text/css"/>
<script src="<?= PATH_PUBLIC_PLUGINS."/datatables/js/jquery.dataTables.min.js" ?>"></script>
<main class="mn-inner">
<div class="row">
	<div class="col s12">
		<div class="page-title">
			<i class="small material-icons">face</i>
		<?= lang("app_businessadmin_rext1") ?></div>
		<div class="row">
			<div class="col s12 m12 l12">
				<ul class="tabs tab-demo z-depth-1" id="tbs" >
					<li class="tab col s6 m6 l6"><a  href="#list" class="active"><?= lang("app_businessadmin_tab1") ?></a></li>
					<li class="tab col s6 m6 l6"><a href="#create" ><?= lang("app_businessadmin_tab2") ?></a></li>
				</ul>
			</div>
			<div id="list" class="col s12">
				<div class="card">
					<div class="card-content">
						<div class="row">
							<div class="col s12 m12 l12">
								<a class="waves-effect waves-light btn right-text" id="link-new-client"><i class="material-icons left">face</i><?= lang('app_businessadmin_tab2') ?></a>
								<br>
								<br>
							</div>
							<div class="col s12 m12 l12">
								
								<table id="table-business" class="display responsive-table datatable-example">
									<thead>
										<tr>
											<th><?= lang('app_businessadmin_tbcolumn1') ?></th>
											<th><?= lang('app_businessadmin_tbcolumn2') ?></th>
											<th><?= lang('app_businessadmin_tbcolumn4') ?></th>
											<th><?= lang('app_businessadmin_tbcolumn5') ?></th>
											<th><?= lang('app_businessadmin_tbcolumn6') ?></th>
											<th><?= lang('app_businessadmin_tbcolumn11') ?></th>
											<th><?= lang('app_useradmin_tbcolumn6') ?></th>
										</tr>
									</thead>
									
									<tbody>
										<?php
										$i = 1;
											foreach ($list_business_admin as $key => $value):
										?>
										<tr>
											<td>
												<?= $value->_business ?>
											</td>
											<td><?= $value->_idb ?></td>
											<td><?= ucwords($value->_member) ?></td>
											<td><?= $value->_codepin ?></td>
											<td><?= $value->_phone1." ".$value->_phone2 ?></td>
											<td><?php
															if($value->_status_business == "pend")
																{
																	echo '<a class="btn-floating btn-small waves-effect waves-light yellow darken-2" title="'.lang('app_businnesuser_help9').'"><i class="material-icons">timer</i></a>';
																}
																elseif ($value->_status_business == "block") {
																										
																echo '<a class="btn-floating btn-small waves-effect waves-light red darken-4" title="'.lang('app_businnesuser_help10').'"><i class="material-icons">block</i></a>';
																}
																elseif($value->_status_business == "ac")
																{
																											
																	echo '<a class="btn-floating btn-small waves-effect waves-light light-green accent-4" title="'.lang('app_businnesuser_help12').'"><i class="material-icons">check_circle</i></a>';
																}
											?></td>
											<td style="text-align: center; vertical-align: middle;">
												
												<a class="btn-floating btn-mini waves-effect waves-light light-green accent-4" onclick=ac('<?= $value->id ?>') title="<?= lang('app_businessadmin_text2') ?>"><i class="material-icons">check_circle</i></a>
												<a class="btn-floating btn-small waves-effect waves-light yellow darken-3" onclick=cfg('<?= $value->id ?>') title="<?= lang('app_businessadmin_text5') ?>"><i class="material-icons">build</i></a>
												<a class="btn-floating btn-small waves-effect waves-light blue" onclick=inf('<?= $value->id ?>') title="<?= lang('app_businessadmin_text3') ?>"><i class="material-icons">edit</i></a>
												<a class="btn-floating btn-small waves-effect red darken-4" onclick=block('<?= $value->id ?>') title="<?= lang('app_businessadmin_text4') ?>" ><i class="material-icons">block</i></a>
												
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
			</div>
			<div id="create" class="col s12">
				<div class="card">
					<div class="card-content">
						<div class="row">
							<div class="col s12 m12 l12">
								<div class="row">
									
									<form method="post" action="register-user-exec" class="col s6 m6 l6" id="fusadm">
										
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
<div id="modal1" class="modal modal-fixed-footer" style="z-index: 1003; display: block; opacity: 0; transform: scaleX(0.7); top: 250.516304347826px;">
	<div class="modal-content">
		<h4><?=  lang("app_businessadmin_text5") ?></h4>
		<form class="col s12 m8 l8" id="fcf">
			<div class="row">
				<div class="col s12">
					<h5 class="green-text" id="name_business2"></h5>
				</div>
				<div class="input-field col s12 m12 l12">
					<p class="range-field">
						<input id="_IDBusiness" name="_IDBusiness" type="hidden">
						<input id="_mails" name="_mails" type="hidden" class="validate">
						<input id="min-buy" name="_minbuy" min="6" max="20" class="active" step="2" value="20" type="range"><span class="thumb" style="left: 69.5px; height: 0px; width: 0px; top: 10px; margin-left: -6px;"><span class="value" id="vmin">0</span></span>
					</p>
					<label for="minbuy"><?= lang("app_businessadmin_text6") ?></label>
				</div>
				<div class="input-field col s12 m12 l12">
					<p class="range-field">
						<input id="max-buy" name="_maxbuy" min="20" max="1000" step="2" class="active" value="20" type="range"><span class="thumb" style="left: 69.5px; height: 0px; width: 0px; top: 10px; margin-left: -6px;"><span class="value" id="vmax">0</span></span>
					</p>
					<label for="maxbuy"><?= lang("app_businessadmin_text7") ?></label>
				</div>
				<div class="input-field col s12 m12 l12">
					<p class="p-v-xs">
						<input class="with-gap" name="group1" id="day1" value="1" type="radio" checked="checked">
						<label for="day1"><?= lang('app_date_text1') ?></label>
					</p>
					<p class="p-v-xs">
						<input class="with-gap" name="group1" id="day2"  value="2" type="radio">
						<label for="day2"><?= lang('app_date_text2') ?></label>
					</p>
					<p class="p-v-xs">
						<input class="with-gap" name="group1" id="day3"  value="3" type="radio">
						<label for="day3"><?= lang('app_date_text3') ?></label>
					</p>
					<p class="p-v-xs">
						<input class="with-gap" name="group1" id="day4"  value="4"  type="radio">
						<label for="day4"><?= lang('app_date_text4') ?></label>
					</p>
					<p class="p-v-xs">
						<input class="with-gap" name="group1" id="day5"  value="5" type="radio">
						<label for="day5"><?= lang('app_date_text5') ?></label>
					</p>
					<p class="p-v-xs">
						<input class="with-gap" name="group1" id="day6"  value="6" type="radio">
						<label for="day6"><?= lang('app_date_text6') ?></label>
					</p>
					<p class="p-v-xs">
						<input class="with-gap" name="group1" id="day7"  value="7" type="radio">
						<label for="day7"><?= lang('app_date_text7') ?></label>
					</p>
					<label for="maxbuy"><?= lang("app_businessadmin_text8") ?></label>
				</div>
				<div class="input-field col s12 m12 l12">
					<p class="p-v-xs">
						<input class="with-gap" name="group2" id="frequency1" value="fija" type="radio">
						<label for="frequency1"><?= lang('app_businessadmin_text10') ?></label>
						</p>
					<p class="p-v-xs">
						<input class="with-gap" name="group2" id="frequency2" value="eventual" type="radio" checked="checked">
						<label for="frequency2"><?= lang('app_businessadmin_text11') ?></label>
					</p>
					<label for="maxbuy"><?= lang("app_businessadmin_text9") ?></label>
				</div>
			</div>
			<div class="row">
				
				<button id="save_info" type="submit" class="btn-floating btn-large waves-effect waves-light yellow darken-2"><i class="material-icons">save</i> </button>
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
<div id="modal2" class="modal modal-fixed-footer" style="z-index: 1003; display: block; opacity: 0; transform: scaleX(0.7); top: 250.516304347826px;">
	<div class="modal-content">
		<h4><?=  lang("app_businessadmin_text12") ?></h4>
		<form class="col s12 m8 l8" id="fbus">
			<div class="row">
				<div class="col s12">
					<h5 class="green-text" id="name_business1"></h5>
				</div>
				<div class="input-field col s12">
					<input id="_IDBusiness2" name="_IDBusiness2" type="hidden" class="validate">

					<input placeholder="" id="_razon" name="_razon" type="text" class="validate">
					<label for="first_name"><?= lang('app_businnesuser_text2') ?></label>
					<p style="font-size: 11px"><?= lang('app_businnesuser_help1') ?></p>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<input placeholder="" id="_rif_hidden" name="_rif_hidden" type="hidden" class="validate">
					<input placeholder="" id="_rif" name="_rif" type="text" value="<?= (isset($business->_idb)) ? $business->_idb : "" ?>" class="validate" ">
					<label for="_rif"><?= lang('app_businnesuser_text3') ?></label>
					<p class="" style="font-size: 11px"><?= lang('app_businnesuser_help2') ?></p>
					<div id="loader4">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<input placeholder="" id="_encargado" name="_encargado" type="text" class="validate" ">
					<label for="_rif"><?= lang('app_businnesuser_help7') ?></label>
					
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<input placeholder=""  id="_dir" name="_dir" type="text" class="validate">
					<label for="_dir"><?= lang('app_businnesuser_help6') ?></label>
					
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<input placeholder="" id="_mail" name="_mail" type="email" class="validate">
					<label for="_mail"><?= lang('app_businnesuser_help5') ?></label>
					
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12 m6 l6">
					<input placeholder="" id="_phone1" name="_phone1" type="text" class="validate" data-inputmask="'mask': '(+58) 999-9999999'" >
					<label for="_phone1"><?= lang('app_businnesuser_text6') ?></label>
					<p class="" style="font-size: 11px"><?= lang('app_businnesuser_help3') ?></p>
				</div>
				
				<div class="input-field col s12 m6 l6">
					<input placeholder="" id="_phone2" name="_phone2" type="text" class="validate" data-inputmask="'mask': '(+58) 999-9999999'">
					<label for="_phone1"><?= lang('app_businnesuser_help4') ?></label>
					<p class="" style="font-size: 11px"><?= lang('app_businnesuser_help3') ?></p>
				</div>
			</div>
			<div class="row right-text">
				<button type="submit"  class="btn-floating btn-large waves-effect waves-light btn yellow darken-2"><i class="material-icons">save</i></button>
			</div>
			<div class="input-field col s12">
				<div id="loader3">
				</div>
			</div>
		</form>
	</div>
	<div class="modal-footer">
		<a href="#!" class="modal-action modal-close waves-effect waves-blue btn-flat ">Cerrar</a>
	</div>
</div>
<div id="modal3" class="modal modal-fixed-footer" style="z-index: 1003; display: block; opacity: 0; transform: scaleX(0.7); top: 250.516304347826px;">
	<div class="modal-content">
		<h4><?=  lang("app_businessadmin_text13") ?></h4>
		<form class="col s12 m8 l8" id="fblock">
			<div class="row">
				<div class="col s12">
					<h5 class="green-text" id="name_business3"></h5>
				</div>
				<div class="input-field col s12 m12 l12">
				<input id="_IDBusiness3" name="_IDBusiness3" type="hidden" class="validate">
				<input id="_mails2" name="_mails2" type="hidden" class="validate">
					<textarea placeholder="" id="msg" name="msg" class="materialize-textarea" length="120"></textarea>
					<label for="textarea1" class=""><?= lang("app_businessadmin_text14") ?></label>
					<span class="character-counter" style="float: right; font-size: 12px; height: 1px;"></span>
				</div>
			</div>
			<div class="row">
				
				<button  id="save_info" type="submit" class="btn-floating btn-large waves-effect waves-light yellow darken-2"><i class="material-icons">save</i> </button>
				<div class="input-field col s12 m12 l12">
					<div id="loader6"></div>
				</div>
			</div>
		</form>
	</div>
	<div class="modal-footer">
		<a href="#!" class="modal-action modal-close waves-effect waves-blue btn-flat ">Cerrar</a>
	</div>
</div>
</main>
<script src="<?= PATH_PUBLIC_JS.'/app/app.unserialize.js' ?>"></script>
<script src="<?= PATH_PUBLIC_JS.'/app/app.business.admin.js' ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS."/jquery-inputmask/jquery.inputmask.bundle.js" ?>"></script>