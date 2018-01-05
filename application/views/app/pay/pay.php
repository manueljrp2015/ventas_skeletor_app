
<main class="mn-inner">
  <div class="row">
    <div class="col s12">
      <div class="card">
        <div class="card-content">
          <span class="card-title">Declaraciones de Pago</span>
          <div class="row s12 m12 l12">
            <div class="input-field col s12 m6 l12">
              <h5>Consulta tus pagos.</h5>
              
              <hr style="border: 1px solid #f5f5f5;">
            </div>
            
            <div class="row">
              <div class="col s12 m6 l12" style="overflow-x: auto; white-space: nowrap;">
              <table class="table striped" id="table-payment">
              <thead>
              	<tr>
              		<th>ID#PAGO</th>
              		<th>#CLIENTE</th>
              		<th>#PAGO</th>
              		<th>#BANCO/ORG</th>
              		<th>#BANCO/DES</th>
              		<th>#TRANSACCIÓN</th>
              		<th>#MONTO</th>
              		<th>#FECHA</th>
              		<th style="text-align: center;">#SOPORTE</th>
              	</tr>
              </thead>
               <tfoot>
		            <tr>
		                <th>ID#PAGO</th>
	              		<th>#CLIENTE</th>
	              		<th>#PAGO</th>
	              		<th>#BANCO/ORG</th>
	              		<th>#BANCO/DES</th>
	              		<th>#TRANSACCIÓN</th>
	              		<th>#MONTO</th>
	              		<th>#FECHA</th>
	              		<th style="text-align: center;">#SOPORTE</th>
		            </tr>
		        </tfoot>
              <tbody>
              <?php
              	foreach ($pays as $key => $value):
              ?>
              	<tr>
              		<td style="text-align: center;"><?= $value->id ?></td>
              		<td><?= $value->_store ?></td>
              		<td><?= $value->paym ?></td>
              		<td><?= $value->bank_ori ?></td>
              		<td><?= $value->bank_dest ?></td>
              		<td><?= $value->_transaccion ?></td>
              		<td><?= $value->_rode ?></td>
              		<td><?= $value->_date_pay  ?></td>
              		<td style="text-align: center;"><a href="<?= "../public/files/support-payment/".$value->_Athachment  ?>" target="_blank"><i class="material-icons small">cloud_download</i></a></td>
              	</tr>

              	<?php
              	endforeach;
              	?>
              </tbody>
              </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
 </main>
 <link href="<?= PATH_PUBLIC_PLUGINS."/datatables/css/jquery.dataTables.min.css" ?>" rel="stylesheet" type="text/css"/>
<script src="<?= PATH_PUBLIC_PLUGINS."/datatables/js/jquery.dataTables.min.js" ?>"></script>
<script src="<?= PATH_PUBLIC_JS.'/app/app.payment.js' ?>"></script>