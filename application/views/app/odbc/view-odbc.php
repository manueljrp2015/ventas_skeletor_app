<link href="<?= PATH_PUBLIC_PLUGINS."/datatables/css/jquery.dataTables.min.css" ?>" rel="stylesheet" type="text/css"/>
<script src="<?= PATH_PUBLIC_PLUGINS."/datatables/js/jquery.dataTables.min.js" ?>"></script>
<main class="mn-inner">
<div class="row">
	<div class="col s12">
		<div class="page-title">
			<i class="material-icons">view_module</i>
		Query SoftLand</div>
		<div class="row">
			<div class="col s12 m12 l12">
				<div class="card">
					<div class="card-content">
						<div class="row">
							<form id="fmodbc">
								<div class="row left-text">
									
									<div class="input-field col s12">
										<textarea id="query" name="query" class="materialize-textarea" length="120"></textarea>
										<label for="textarea1" class="">Query</label>
										<span class="character-counter" style="float: right; font-size: 12px; height: 1px;"></span>
									</div>
										<br>
										<br>
										<br>
										<div id="loader3">
										</div>
										
									</div>
									<div class="row">
										<button id="save_store" type="submit" class="waves-effect waves-light btn">
										Procesar </button>
									</div>
								</form>
								<div class="row" id="response">
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</main>
	<script src="<?= PATH_PUBLIC_JS.'/app/app.softland.js' ?>"></script>