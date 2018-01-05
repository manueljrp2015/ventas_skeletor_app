<main class="mn-inner">
<div class="row">
	<div class="col s12">
		<div class="page-title">
			<i class="tiny material-icons">assignment_ind</i>
		<?= lang("app_user_myaccount_title") ?></div>
		<div class="row">
			<div class="col s12">
				<ul class="tabs tab-demo z-depth-1" style="width: 100%;">
					<li class="tab col s12 m6 l3"><a href="#basic" class="active"><?= lang("app_user_myaccount_tab1") ?></a></li>
					<li class="tab col s6 m6 l3"><a  href="#access" ><?= lang("app_user_myaccount_tab6") ?></a></li>
					<li class="tab col s6 m6 l3"><a href="#email" ><?= lang("app_user_myaccount_tab3") ?></a></li>
					<li class="tab col s6 m6 l3 disabled"><a href="#pincode"><?= lang("app_user_myaccount_tab4") ?></a></li>
					<li class="tab col s6 m6 l3"><a href="#avatar" ><?= lang("app_user_myaccount_tab5") ?></a></li>
				</ul>
			</div>
			<div id="basic" class="col s12">
				<div class="card">
					<div class="card-content">
						<div class="row">
							<form class="col s12 m8 l8" id="fu">
								<div class="row">
									<div class="input-field col s12 m6 l6">
										<input  id="_first_name" name="_first_name" value="<?= $info_user->_firts_name ?>" type="text" class="validate">
										<label for="_first_name"><?= lang("app_user_myaccount_input1") ?></label>
									</div>
									<div class="input-field col s12 m6 l6">
										<input  id="_last_name" name="_last_name" value="<?= $info_user->_last_name ?>" type="text" class="validate">
										<label for="_last_name"><?= lang("app_user_myaccount_input2") ?></label>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12 m6 l6">
										<select name="_typeid" id="_typeid">
											<option value="" disabled="" selected=""><?= lang("app_title_register_input_type_account_option3") ?></option>
											<?php foreach (json_decode($typeid) as $key => $value):  ?>
											<option value="<?= $value->id ?>"><?= $value->_prefix_typeid." - ".strtoupper($value->_typeid) ?></option>
											<?php endforeach; ?>
										</select>
										<label for="_typeid"><?= lang("app_user_myaccount_input3") ?></label>
									</div>
									<div class="input-field col s12 m6 l6">
										<input id="_idn" name="_idn" type="text" value="<?= $info_user->_identity ?>" class="validate">
										<label for="_idn"><?= lang("app_user_myaccount_input4") ?></label>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12 m6 l6">
										<input placeholder="<?= lang("app_user_myaccount_input5") ?>" value="<?= $info_user->_birthday ?>" id="_birthday" name="_birthday" type="text" class="datepicker">
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12 m6 l6">
										<select name="_countryid" id="_countryid">
											<option value="" disabled="" selected=""><?= lang("app_title_register_input_type_account_option3") ?></option>
											<?php foreach (json_decode($country) as $key => $value):  ?>
											<option value="<?= $value->id ?>"><?= $value->_country." - ".$value->_prefix ?></option>
											<?php endforeach; ?>
										</select>
										<label for="_countryid"><?= lang("app_title_register_input_country") ?></label>
									</div>
									<?php
										$parse = explode(" ", $info_user->_phone);
									?>
									<div class="input-field col s12 m6 l6">
										<input  id="_phone" name="_phone" type="text" value="<?= $parse[1] ?>" class="validate tooltipped" data-inputmask="'mask': '(<?= $info_user->_codephone ?>) 999-9999999'" data-position="bottom" data-delay="30" data-tooltip="<?= lang("app_user_myaccount_tooltip1") ?>">
										<label for="_phone"><?= lang("app_user_myaccount_input13") ?></label>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12 m12 l12">
										<input  id="_website" name="_website"  value="<?= $info_user->_website ?>" type="text" class="validate tooltipped" data-position="bottom" data-delay="30" data-tooltip="<?= lang("app_user_myaccount_tooltip2") ?>">
										<label for="_website"><?= lang("app_user_myaccount_input6") ?></label>
									</div>
									<?php
										$social = unserialize($info_user->_social);
									?>
								</div>
								<div class="row">
									<div class="input-field col s12 m6 l6">
										<input  id="_instagram" name="_instagram" value="<?= $social["_instagram"] ?>"  type="text" class="validate tooltipped" data-position="bottom" data-delay="30" data-tooltip="<?= lang("app_user_myaccount_tooltip3") ?>">
										<label for="_instagram"><?= lang("app_user_myaccount_input7") ?></label>
									</div>
									<div class="input-field col s12 m6 l6">
										<input  id="_twitter" name="_twitter" value="<?= $social["_twitter"] ?>" type="text" class="validate tooltipped" data-delay="30" data-tooltip="<?= lang("app_user_myaccount_tooltip4") ?>">
										<label for="_twitter"><?= lang("app_user_myaccount_input9") ?></label>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12 m12 l12">
										<input  id="_facebook" name="_facebook" value="<?= $social["_facebook"] ?>"  type="text" class="validate tooltipped" data-position="bottom" data-delay="30" data-tooltip="<?= lang("app_user_myaccount_tooltip5") ?>">
										<label for="_facebook"><?= lang("app_user_myaccount_input8") ?></label>
									</div>
									<div class="input-field col s12 m12 l12">
										<input  id="_linkedin" name="_linkedin" value="<?= $social["_linkedin"] ?>" type="text" class="validate tooltipped" data-delay="30" data-tooltip="<?= lang("app_user_myaccount_tooltip6") ?>">
										<label for="_linkedin"><?= lang("app_user_myaccount_input10") ?></label>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12 m12 l12">
										<input  id="_youtube" name="_youtube" value="<?= $social["_youtube"] ?>" type="text" class="validate tooltipped" data-delay="30" data-tooltip="<?= lang("app_user_myaccount_tooltip7") ?>">
										<label for="_youtube"><?= lang("app_user_myaccount_input11") ?></label>
									</div>
									<div class="input-field col s12 m12 l12">
										<input  id="_vimeo" name="_vimeo" value="<?= $social["_vimeo"] ?>" type="text" class="validate tooltipped" data-delay="30" data-tooltip="<?= lang("app_user_myaccount_tooltip8") ?>">
										<label for="_vimeo"><?= lang("app_user_myaccount_input12") ?></label>
									</div>
								</div>
								<div class="row">
									
									<button id="save_info" type="submit" class="btn-floating btn-large waves-effect waves-light teal lighten-2"><i class="material-icons">save</i> </button>
									<div id="loader5"></div>
									
								</div>
							</form>
							<form class="col s12 m4 l4">
								<div class="row">
									<p class="center-align"><i class="large material-icons">verified_user</i></p>
									<p class="center-align flow-text "><?= lang("app_user_myaccount_text1") ?></p>
								</div>
								
							</form>
						</div>
					</div>
				</div>
			</div>
			
			<div id="access" class="col s12 active">
				<div class="card">
					<div class="card-content">
						<div class="row">
							<form class="col s12 m12 l12" id="fus">
								<div class="row">
									<h5><i class="material-icons">account_box</i> <?= lang("app_user_myaccount_title1") ?></h5>
									<div class="input-field col s12 m6 l4">
										<input  id="_username_hidden" name="_username_hidden" type="hidden" class="validate" value="<?= $info_user->_nickname ?>" >
										<input  id="_username" name="_username" type="text" class="validate" value="<?= $info_user->_nickname ?>" >
										<label for="_username"><?= lang("app_user_myaccount_input20") ?></label>
									</div>
									<div class="input-field col s12 m6 l4">
										<input  id="_account" type="text" class="validate" value="<?= $info_user->_account ?>" disabled="disabled">
										<label for="_account"><?= lang("app_user_myaccount_input21") ?></label>
									</div>
								</div>
								<div class="row">
									<button id="save_user" type="submit" class="btn-floating btn-large waves-effect waves-light teal lighten-2">
									<i class="material-icons">save</i> </button>
									<div id="loader3"></div>
									
								</div>
							</form>
							<form class="col s12 m12 l12" id="fpw">
								<div class="row">
									<h5><i class="material-icons">vpn_key</i> <?= lang("app_user_myaccount_title2") ?></h5>
									<div class="input-field col s12 m6 l4">
										<input  id="_pwd" name="_pwd" type="password" placeholder="" class="validate">
										<label for="_pwd"><?= lang("app_user_myaccount_input14") ?></label>
									</div>
									<div class="input-field col s12 m6 l4">
										<input  id="_pwd_new" name="_pwd_new" placeholder="" type="password" class="validate">
										<label for="_pwd_new"><?= lang("app_user_myaccount_input15") ?></label>
										<a href="javascript: void(0)" id="gnp"><i class="tiny material-icons">build</i> <?= lang("app_user_myaccount_title3") ?></a>
									</div>
									<div class="input-field col s12 m6 l4">
										<input  id="_pwd_rpt" name="_pwd_rpt" placeholder="" type="password" class="validate">
										<label for="_pwd_rpt"><?= lang("app_user_myaccount_input16") ?></label>
									</div>
								</div>
								<div class="row">
									
									<button id="change_password" type="submit" class="btn-floating btn-large waves-effect waves-light teal lighten-2">
									<i class="material-icons">save</i> </button>
									<div id="loader4"></div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div id="email" class="col s12">
				<div class="card">
					<div class="card-content">
						<div class="row">
							<form class="col s12 m6 l6" id="femp">
								<div class="row">
									<div class="input-field col s12 m12 l12">
										<input  id="email_active" name="email_active" type="email" value="<?= $this->session->userdata("mail") ?>" class="validate">
										<input  id="email_active_hidden" name="email_active_hidden" type="hidden" value="<?= $this->session->userdata("mail") ?>" >
										<label for="email_active"><?= lang("app_user_myaccount_input18") ?></label>
										<?= lang('app_user_email_label1') ?>
									</div>
								</div>
								<div class="row">
									
									<button id="email_change" type="submit" class="btn-floating btn-large waves-effect waves-light teal lighten-2">
									<i class="material-icons">save</i> </button>
						<div id="loader"></div>
						</div>
					</form>
					<form class="col s12 m6 l6" id="fema">
						<div class="row">
							<div class="input-field col s12 m12 l12">
								<input  id="email_other" name="email_other" type="email" value="<?= $info_user->_mail_recovery ?>" class="validate">
								<input  id="email_other_hidden" name="email_other_hidden" type="hidden" value="<?= $info_user->_mail_recovery ?>" >
								<label for="email_other"><?= lang("app_user_myaccount_input19") ?></label>
								<?= lang('app_user_email_label2') ?>
							</div>
							
						</div>
						<div class="row">
							
							<button id="first_name" type="submit" class="btn-floating btn-large waves-effect waves-light teal lighten-2">
							<i class="material-icons">save</i> </button>
							<div id="loader2"></div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div id="pincode" class="col s12">
		<div class="card">
			<div class="card-content">
				PIN CODE
			</div>
		</div>
	</div>
	<div id="avatar" class="col s12">
		<div class="card">
			<div class="card-content">
				<div class="row">
					<form class="col s12 m6 l6">
						<div class="row">
							<div class="row center-align">
								<p class="center-align flow-text"><?= lang("app_user_myaccount_input24") ?></p>
								<div style="width: 250px; height: 20px; display: inline-block; background-position: center;background-size: cover; max-width: 250px; min-width: 350px;">
									<img class="responsive-img" id="preview"  alt="" style="width: 350px; max-width: 350px; min-width: 100%;" >
								</div>
							</div>
							<div class="file-field input-field col s12 m12 l12">
								<div class="btn teal lighten-1">
									<span><?= lang("app_user_myaccount_input22") ?></span>
									<input type="file" accept="image/*" name="file" onchange="openFile(event)" class="tooltipped" data-position="bottom" data-delay="30" data-tooltip="<?= lang("app_user_myaccount_tooltip2") ?>">
								</div>
								<div class="file-path-wrapper">
									<input class="file-path validate valid" type="text">
								</div>
							</div>
						</div>
						<div class="row">
							<br>
							<br>
							<div class="input-field col s12 m12 l12">
								<div class="fixed-action-btn horizontal click-to-toggle" style="position: absolute; display: inline-block; float: left">
									<a class="btn-floating btn-large red option">
										<i class="material-icons">menu</i>
									</a>
									<ul>
										<li><a class="btn-floating red option1" id="edit_image"><i class="material-icons">photo_size_select_large</i></a></li>
										<li><a class="btn-floating yellow darken-1 rotate-degree-left option2"><i class="material-icons">rotate_left</i></a></li>
										<li><a class="btn-floating green rotate-degree-right option3"><i class="material-icons">rotate_right</i></a></li>
										<li><a class="btn-floating blue scale-pic-in option4"><i class="material-icons">zoom_in</i></a></li>
										<li><a class="btn-floating blue scale-pic-out option5"><i class="material-icons">zoom_out</i></a></li>
										<li><a class="btn-floating blue option6" id="upload"><i class="material-icons">file_upload</i></a></li>
									</ul>
								</div>
							</div>
							<div id="loader6">
								<div id="porcent"></div>
								<div class="progress"><div class="determinate" style="width: 0%" id="process"></div></div>
							</div>
							<br>
							<p class="left-align"><?= lang("app_user_myaccount_avatar_content1") ?></p>
							<blockquote>
								<?= lang("app_user_myaccount_avatar_content5") ?>
							</blockquote>
							<blockquote>
								<?= lang("app_user_myaccount_avatar_content6") ?>
							</blockquote>
							<blockquote>
								<?= lang("app_user_myaccount_avatar_content7") ?>
							</blockquote>
							<blockquote>
								<?= lang("app_user_myaccount_avatar_content8") ?>
							</blockquote>
							<blockquote>
								<?= lang("app_user_myaccount_avatar_content2") ?>
							</blockquote>
							<blockquote>
								<?= lang("app_user_myaccount_avatar_content3") ?>
							</blockquote>
							<blockquote>
								<?= lang("app_user_myaccount_avatar_content4") ?>
							</blockquote>
						</div>
					</form>
					<form class="col s12 m6 l6">
						<p class="center-align flow-text"><?= lang("app_user_myaccount_input23") ?></p>
						<br>
						<div class="row">
							<div class="col s12 m6 l6">
								<div class="circle img-preview" style="width: 200px; height: 200px;"></div>
							</div>
							<div class="col s12 m3 l3">
								<div class="circle img-preview" style="width: 100px; height: 100px;"></div>
							</div>
							<div class="col s12 m3 l3">
								<div class="circle img-preview" style="width: 75px; height: 75px;"></div>
							</div>
						</div>
						
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</main>
<link rel="stylesheet" type="text/css" href="<?= PATH_PUBLIC_PLUGINS."/image-cropper/cropper.min.css" ?>">
<script src="<?= PATH_PUBLIC_PLUGINS."/canvas-toBlob/canvas-toBlob.js" ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS."/image-cropper/cropper.min.js" ?>"></script>
<script src="<?= PATH_PUBLIC_JS.'/app/app.useraccount.js' ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS."/jquery-inputmask/jquery.inputmask.bundle.js" ?>"></script>
<script type="text/javascript">
	$(function() {
selectCountry("<?= $info_user->_country_id ?>");
selectIdentity("<?= $info_user->_IDTypeid ?>");
});
</script>