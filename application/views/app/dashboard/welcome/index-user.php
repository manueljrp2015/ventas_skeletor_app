<?php
$CI =& get_instance();
$CI->load->model([
"app/business/appBusinessModel"
	]);
?>
<main class="mn-inner inner-active-sidebar">
<div class="middle-content">
	<div class="row no-m-t no-m-b">
		<div class="col s12 m12 l12">
			<div class="card stats-card">
				<div class="card-content">
					<div class="card-options">
						<ul>
							<?php
							$r = $CI->appBusinessModel->getBusiness();
							
								if($CI->appBusinessModel->getStatus() == null){
									echo '<li><a href="'.base_url("empresa/registrar").'" class="waves-effect waves-light btn yellow darken-2" style="color: white;">'.lang('app_dashboard_text17').'</a></li>';
								}
								elseif ($CI->appBusinessModel->getStatus() == "pend") {
										echo '<li><span class="new badge yellow darken-2" data-badge-caption="'.lang('app_businnesuser_help9').'"></span></li>';
								} else if ($CI->appBusinessModel->getStatus() == "block") {
									echo '<li><span class="new badge red darken-4" data-badge-caption="'.lang('app_businnesuser_help10').'"></span></li>';
								} else if ($CI->appBusinessModel->getStatus() == "ac") {
									echo '<li><span class="new badge light-green accent-4" data-badge-caption="'.lang('app_businnesuser_help12').'"></span></li>';
								}
							?>
							
							
						</ul>
					</div>
					<?php
					if ($CI->appBusinessModel->getName() !== null){
					?>
					<?php
					if ($CI->appBusinessModel->getPinCode() !== null){
							echo "";
					}
					else{
							echo '<span class="stats-counter red-text" >'.lang("app_businnesuser_text10").' </span>';
					}
					?>
					<span class="stats-counter"><?=$CI->appBusinessModel->getFullName() ?></span>
					
					<?php
					} else {
					?>
					
					<?php
					}
					
					?>
					
				</div>
			</div>
		</div>
		<div class="col s12 m12 l4">
			<div class="card stats-card">
				<div class="card-content">
					<div class="card-options">
						<ul>
							<li class="red-text"><span class="badge cyan lighten-1">gross</span></li>
						</ul>
					</div>
					<span class="card-title"><?= lang('app_dashboard_text1') ?></span>
					<span class="stats-counter">$<span class="counter">0</span><small><?= lang('app_dashboard_text2') ?></small></span>
				</div>
				<div id="sparkline-bar"></div>
			</div>
		</div>
		
		<div class="col s12 m12 l4">
			<div class="card stats-card">
				<div class="card-content">
					<div class="card-options">
						<ul>
							<li><a href="javascript:void(0)"><i class="material-icons">more_vert</i></a></li>
						</ul>
					</div>
					<span class="card-title"><?= lang('app_dashboard_text3') ?></span>
					<span class="stats-counter"><span class="counter">0</span><small><?= lang('app_dashboard_text2') ?></small></span>
				</div>
				<div id="sparkline-line"></div>
			</div>
		</div>
		<div class="col s12 m12 l4">
			<div class="card stats-card">
				<div class="card-content">
					<span class="card-title"><?= lang('app_dashboard_text4') ?></span>
					<span class="stats-counter"><span class="counter">23230</span><small><?= lang('app_dashboard_text5') ?></small></span>
					<div class="percent-info green-text">8% <i class="material-icons">trending_up</i></div>
				</div>
				<div class="progress stats-card-progress">
					<div class="determinate" style="width: 10%"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="row no-m-t no-m-b">
		<div class="col s12 m12 l12">
			<div class="card visitors-card">
				<div class="card-content">
					<div class="card-options">
						<ul>
							<li><a href="javascript:void(0)" class="card-refresh"><i class="material-icons">refresh</i></a></li>
						</ul>
					</div>
					<span class="card-title"><?= lang('app_dashboard_text4') ?><span class="secondary-title"><?= lang('app_dashboard_text6') ?></span></span>
					<div id="flotchart1"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="row no-m-t no-m-b">
		<div class="col s12 m12 l12">
			<div class="card invoices-card">
				<div class="card-content">
					<div class="card-options">
						<input type="text" class="expand-search" placeholder="Search" autocomplete="off">
					</div>
					<span class="card-title">Pedidos Pendientes</span>
					<table class="responsive-table bordered">
						<thead>
							<tr>
								<th data-field="id">ID</th>
								<th data-field="number">Cliente</th>
								<th data-field="company">Cantidad</th>
								<th data-field="date">Fecha</th>
								<th data-field="progress">Progress</th>
								<th data-field="total">Total</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>#00001</td>
								<td>Manuel Rodriguez</td>
								<td>8000</td>
								<td>Mar 17, 18:12</td>
								<td><span class="pie">3/8</span></td>
								<td>800.000,00 Bs</td>
							</tr>
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col s12 m12 l12">
			<div class="card invoices-card">
				<div class="card-content">
					<div class="card-options">
						<input type="text" class="expand-search" placeholder="Search" autocomplete="off">
					</div>
					<span class="card-title">Pagos Pendientes</span>
					<table class="responsive-table bordered">
						<thead>
							<tr>
								<th data-field="id">ID</th>
								<th data-field="number">Pedido</th>
								<th data-field="number">Tipo/Pago</th>
								<th data-field="company">Cliente</th>
								<th data-field="date">Fecha</th>
								<th data-field="progress">Progress</th>
								<th data-field="total">Total</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>#00001</td>
								<td>#00001</td>
								<td>Transferencia</td>
								<td>Manuel Rodriguez</td>
								<td>Mar 17, 18:12</td>
								<td><span class="pie">3/8</span></td>
								<td>800.000,00 Bs</td>
							</tr>
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
</main>
<script src="<?= PATH_PUBLIC_PLUGINS.'/jquery-sparkline/jquery.sparkline.min.js' ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS.'/flot/jquery.flot.min.js' ?>"></script>
<script src="<?= PATH_PUBLIC_JS.'/app/app.dashboard.user.js' ?>"></script>