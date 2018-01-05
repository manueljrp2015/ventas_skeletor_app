<main class="mn-inner">
<div class="row">
	<div class="col s12">
		<div class="card">
			<div class="card-content">
				<span class="card-title"><?= lang('app_businnesuser_text1') ?></span>
				<div class="row">
					<div  class="col s12 m12 l12">
						<div class="row">
						
							<p class="left-align"><?= lang("app_businnesuser_text9") ?></p>
						</div>
					</div>
				</div>
				<div class="row">
					<form class="col s12 m7 l7" id="fmbus">
						<div class="row">
							<?php
									if(isset($business->_status_business) == null){}
									elseif (isset($business->_status_business) == "pend") {
							?>
							<div class="input-field col s8">
								<p class="red-text"><?= lang('app_businnesuser_help8') ?></p>
							</div>
							<div class="input-field col s4">
								<span class="new badge yellow darken-2" data-badge-caption="<?= lang('app_businnesuser_help9') ?>"></span>
							</div>
							<?php
									} else if(isset($business->_status_business) == "block") {
							?>
							<div class="input-field col s8">
								<p class="red-text"><?= lang('app_businnesuser_help11') ?></p>
							</div>
							<div class="input-field col s4">
								<span class="new badge red darken-4" data-badge-caption="<?= lang('app_businnesuser_help10') ?>"></span>
							</div>
							<?php
							} else if(isset($business->_status_business) == "ac") {
							?>
							<div class="input-field col s8">
								<p class="green-text"></p>
							</div>
							<div class="input-field col s4">
								<span class="new badge light-green accent-4" data-badge-caption="<?= lang('app_businnesuser_help12') ?>"></span>
							</div>
							<?php
							}
							?>
						</div>
						<div class="row">
							<div class="input-field col s12">
								<input placeholder="" id="_razon" name="_razon" type="text" value="<?= (isset($business->_business)) ? $business->_business : "" ?>" class="validate">
								<label for="first_name"><?= lang('app_businnesuser_text2') ?></label>
								<p style="font-size: 11px"><?= lang('app_businnesuser_help1') ?></p>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12">
								<input placeholder="" id="_rif_hidden" name="_rif_hidden" type="hidden" value="<?= (isset($business->_idb)) ? $business->_idb : "" ?>" class="validate">
								<input placeholder="" id="_rif" name="_rif" type="text" value="<?= (isset($business->_idb)) ? $business->_idb : "" ?>" class="validate" ">
								<label for="_rif"><?= lang('app_businnesuser_text3') ?></label>
								<p class="" style="font-size: 11px"><?= lang('app_businnesuser_help2') ?></p>
								<div id="loader4">
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12">
									<input placeholder="" id="_encargado" name="_encargado"  value="<?= (isset($business->_member)) ? ucwords($business->_member) : "" ?>" type="text" class="validate" ">
									<label for="_rif"><?= lang('app_businnesuser_help7') ?></label>
									
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12">
									<input placeholder=""  id="_dir" name="_dir" value="<?= (isset($business->_direcction)) ? ucwords($business->_direcction) : "" ?>" type="text" class="validate">
									<label for="_dir"><?= lang('app_businnesuser_help6') ?></label>
									
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12">
									<input placeholder="" id="_mail" name="_mail" value="<?= (isset($business->_mail)) ? $business->_mail : "" ?>" type="email" class="validate">
									<label for="_mail"><?= lang('app_businnesuser_help5') ?></label>
									
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12 m6 l6">
									<input placeholder="" id="_phone1" name="_phone1" type="text" value="<?= (isset($business->_phone1)) ? $business->_phone1 : " " ?>" class="validate" data-inputmask="'mask': '(+58) 999-9999999'" >
									<label for="_phone1"><?= lang('app_businnesuser_text6') ?></label>
									<p class="" style="font-size: 11px"><?= lang('app_businnesuser_help3') ?></p>
								</div>
								
								<div class="input-field col s12 m6 l6">
									<input placeholder="" id="_phone2" name="_phone2" value="<?= (isset($business->_phone2)) ? $business->_phone2 : " " ?>" type="text" class="validate" data-inputmask="'mask': '(+58) 999-9999999'">
									<label for="_phone1"><?= lang('app_businnesuser_help4') ?></label>
									<p class="" style="font-size: 11px"><?= lang('app_businnesuser_help3') ?></p>
								</div>
							</div>
							<div class="row right-text">
								<button type="submit" class="btn-floating btn-large waves-effect waves-light btn yellow darken-2"><i class="material-icons">save</i></button>
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
		</main>
		<script src="<?= PATH_PUBLIC_PLUGINS."/jquery-inputmask/jquery.inputmask.bundle.js" ?>"></script>
		<script src="<?= PATH_PUBLIC_JS.'/app/app.business.user.js' ?>"></script>