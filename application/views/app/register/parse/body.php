<body class="signin-page">
	<div class="loader-bg"></div>
	<div class="loader">
		<div class="preloader-wrapper big active">
			<div class="spinner-layer spinner-blue">
				<div class="circle-clipper left">
					<div class="circle"></div>
				</div><div class="gap-patch">
				<div class="circle"></div>
			</div><div class="circle-clipper right">
			<div class="circle"></div>
		</div>
	</div>
	<div class="spinner-layer spinner-red">
		<div class="circle-clipper left">
			<div class="circle"></div>
		</div><div class="gap-patch">
		<div class="circle"></div>
	</div><div class="circle-clipper right">
	<div class="circle"></div>
</div>
</div>
<div class="spinner-layer spinner-yellow">
<div class="circle-clipper left">
	<div class="circle"></div>
</div><div class="gap-patch">
<div class="circle"></div>
</div><div class="circle-clipper right">
<div class="circle"></div>
</div>
</div>
<div class="spinner-layer spinner-green">
<div class="circle-clipper left">
<div class="circle"></div>
</div><div class="gap-patch">
<div class="circle"></div>
</div><div class="circle-clipper right">
<div class="circle"></div>
</div>
</div>
</div>
</div>
<div class="mn-content valign-wrapper">
<main class="mn-inner container">
<div class="valign">
<div class="row">
<div class="col s12 m6 22 offset-16 offset-m3">
<div class="card white darken-1">
<div class="card-content ">
<span class="card-title"><?= lang("app_title_register_div") ?></span>
<div class="row">
<?php
$attributes = array('class' => 'col s12', 'id' => 'fr');
echo form_open(URL_WEB.'register/register-user-exec', $attributes);
?>
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
<div class="input-field col s12 m8 l8">
	<select name="typeAccount" id="typeAccount" class="js-states browser-default">
		<option value="" disabled="" selected=""> </option>
		<?php foreach (json_decode($listTypeAccount) as $key => $value):  ?>
		<option value="<?= $value->id ?>"><?= $value->_account ?></option>
		<?php endforeach; ?>
	</select>
</div>
<div class="col s6 left-align m-t-sm">
	<a href="<?= URL_WEB ?>" class="btn-floating btn-medium waves-effect waves-light red"><i class="material-icons">keyboard_arrow_left</i></a>
</div>
<div class="col s6 right-align m-t-sm">
	<input type="submit" class="waves-effect waves-light btn teal" value="<?= lang("app_title_register") ?>">
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
</main>
</div>
<!-- Javascripts -->
<script src="<?= PATH_PUBLIC_PLUGINS."/jquery/jquery-2.2.0.min.js" ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS."/materialize/js/materialize.min.js" ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS."/material-preloader/js/materialPreloader.min.js" ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS."/jquery-blockui/jquery.blockui.js" ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS."/jquery-validation/jquery.validate.min.js" ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS."/sweetalert/sweetalert.min.js" ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS."/select2/js/select2.min.js" ?>"></script>
<script src="<?= PATH_PUBLIC_JS.'/alpha.min.js' ?>"></script>
<script src="<?= PATH_PUBLIC_JS.'/app/app.register.js' ?>"></script>
<script src="<?= PATH_PUBLIC_JS.'/app/app.lenguaje.js' ?>"></script>
</body>
</html>