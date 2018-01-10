<?php
$CI =& get_instance();
$CI->load->model([
	"app/administration/appAdministrationModel"
]);
	if($_REQUEST["to"] != 0 && $_REQUEST["from"] != 0 && $_REQUEST["state"] != 0 && $_REQUEST["store"] != 0){
			$criterio = "desde: ".$_REQUEST["from"]." / hasta: ".$_REQUEST["to"].", clientes: ".$_REQUEST["store"].", estados: ".$_REQUEST["state"];
		}
		elseif ($_REQUEST["to"] == 0 && $_REQUEST["from"] == 0 && $_REQUEST["state"] != 0 && $_REQUEST["store"] != 0) {
			$criterio = "clientes: ".$_REQUEST["store"].", estados: ".$_REQUEST["state"];
		}
		elseif ($_REQUEST["to"] != 0 && $_REQUEST["from"] != 0 && $_REQUEST["state"] == 0 && $_REQUEST["store"] == 0) {
			$criterio = "desde: ".$_REQUEST["from"]." / hasta: ".$_REQUEST["to"];
		}
		elseif ($_REQUEST["to"] != 0 && $_REQUEST["from"] != 0 && $_REQUEST["state"] == 0 && $_REQUEST["store"] != 0) {
			$criterio = "desde: ".$_REQUEST["from"]." / hasta: ".$_REQUEST["to"].", clientes: ".$_REQUEST["store"];
		}
		elseif ($_REQUEST["to"] != 0 && $_REQUEST["from"] != 0 && $_REQUEST["state"] != 0 && $_REQUEST["store"] == 0) {
			$criterio = "desde: ".$_REQUEST["from"]." / hasta: ".$_REQUEST["to"].", estados: ".$_REQUEST["state"];
		}
	$pay = $CI->appAdministrationModel->queryReportBank($this->input->get());
?>
<page backtop="20mm" backbottom="10mm" backleft="0mm"  backright="0mm" backimgw="350px" backimg="<?= PATH_PUBLIC_IMG."/logotamy-water.png" ?>">
	<page_header backleft="53mm" backright="3mm">
		<table style="width: 100%; border: solid 1px #eceff1; margin-top: 5px; font-size: 5mm;" >
			<tr>
				<td style="text-align: center; width: 10%;  border: solid 0px #d3d3d3;">
					<img src="<?= PATH_PUBLIC_IMG."/logotamy.png" ?>" style="width: 50px;">
				</td>
				<td style="text-align: left; width: 90%;  border: solid 0px #d3d3d3; font-size: 7mm;">
					<table style="width: 100%; border: solid 0px #d3d3d3; margin-top: 5px; font-size: 5mm;">
						<tr>
							<td style="text-align: left; width: 100%;  border: solid 0px #d3d3d3; font-size: 3.3mm;"><?= TITLE_PDF ?></td>
						</tr>
						<tr>
							<td style="text-align: left; width: 100%;  border: solid 0px #d3d3d3; font-size: 2.5mm;"><?= TITLE_PDF_3 ?></td>
						</tr>
						<tr>
							<td style="text-align: left; width: 100%;   font-size: 2.5mm;"><?= TITLE_PDF_2 ?></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</page_header>
	<table style="width: 100%; border: solid 0px #d3d3d3; margin-top: 15px; font-size: 10mm;">
		<tr>
			<td style="text-align: center; width: 100%; font-size: 4mm;  text-decoration: none;">Reporte de Pagos
			</td>
		</tr>
	</table>
	<table style="width: 100%; border: solid 0px #d3d3d3; margin-top: 15px; font-size: 10mm;">
		<tr>
			<td style="text-align: left; width: 100%; font-size: 2.5mm;  text-decoration: none;">Criterio: <?= $criterio ?>
			</td>
		</tr>
	</table>
	<div style="page-break-AFTER: always;">
		<table style="width: 100%; border: solid 0px #d3d3d3; margin-top: 0px;">
			<tr>
				
				<td style="width: 5%; background-color: #eceff1; border: solid 1px #eceff1; padding-left: 3px; padding-top: 3px; font-size: 2.5mm; text-align: center; vertical-align: middle;">
					ID
				</td>
				<td style="width: 5%; background-color: #eceff1; border: solid 1px #eceff1; padding-left: 3px; padding-top: 3px; font-size: 2.5mm; text-align: center; vertical-align: middle;">
					ORDEN
				</td>
				<td style="width: 20%; background-color: #eceff1; border: solid 1px #eceff1; padding-left: 3px; padding-top: 3px; font-size: 2.5mm; text-align: right; vertical-align: middle;">
					CLIENTE
				</td>
				<td style="width: 6%; background-color: #eceff1; border: solid 1px #eceff1; padding-left: 3px; padding-top: 3px; font-size: 2.5mm; text-align: center; vertical-align: middle;">
					FECHA
					
				</td>
				<td style="width: 10%; background-color: #eceff1; border: solid 1px #eceff1; padding-left: 3px; padding-top: 3px; font-size: 2.5mm; text-align: right; vertical-align: middle;">
					PAGO
					
				</td>
				<td style="width: 13%; background-color: #eceff1; border: solid 1px #eceff1; padding-left: 3px; padding-top: 3px; font-size: 2.5mm; text-align: right; vertical-align: middle;">
					ORIGEN
					
				</td>
				<td style="width: 13%; background-color: #eceff1; border: solid 1px #eceff1; padding-left: 3px; padding-top: 3px; font-size: 2.5mm; text-align: right; vertical-align: middle;">
					DEST.
					
				</td>
				<td style="width: 10%; background-color: #eceff1; border: solid 1px #eceff1; padding-left: 3px; padding-top: 3px; font-size: 2.5mm; text-align: right; vertical-align: middle;">
					NRO.TRANS
					
				</td>
				<td style="width: 10%; background-color: #eceff1; border: solid 1px #eceff1; padding-left: 3px; padding-top: 3px; font-size: 2.5mm; text-align: right; vertical-align: middle;">
					MONTO
					
				</td>
				<td style="width: 8%; background-color: #eceff1; border: solid 1px #eceff1; padding-left: 3px; padding-top: 3px; font-size: 2.5mm; text-align: right; vertical-align: middle;">
					ESTADO
					
				</td>
			</tr>
			<?php
			$total = 0;
				foreach ($pay as $key => $value) {
			?>
			<tr>
				
				<td style="width: 5%; border: solid 1px #eceff1; padding: 0px; font-size: 2.5mm; text-align: center; vertical-align: middle;">
					<?= sprintf("%05d",$value->id) ?>
				</td>
				<td style="width: 5%; border: solid 1px #eceff1; padding: 0px; font-size: 2.5mm; text-align: center; vertical-align: middle;">
					<?= $value->_order_id ?>
				</td>
				<td style="width: 20%; border: solid 1px #eceff1; padding: 0px; font-size: 2.5mm; text-align: right; vertical-align: middle;">
					<?= $value->_store ?>
				</td>
				<td style="width: 6%; border: solid 1px #eceff1; padding: 0px; font-size: 2.5mm; text-align: center; vertical-align: middle;">
					<?= $value->_date_pay ?>
				</td>
				<td style="width: 10%;  border: solid 1px #eceff1; padding: 0px; font-size: 2.5mm; text-align: right; vertical-align: middle;">
					<?= $value->paym ?>
				</td>
				<td style="width: 13%;  border: solid 1px #eceff1; padding: 0px; font-size: 2.5mm; text-align: right; vertical-align: middle;">
					<?= $value->bank_ori ?>
				</td>
				<td style="width: 13%; border: solid 1px #eceff1; padding: 0px; font-size: 2.5mm; text-align: right; vertical-align: middle;">
					<?= $value->bank_dest ?>
					
				</td>
				<td style="width: 10%;  border: solid 1px #eceff1; padding: 0px; font-size: 2.5mm; text-align: right; vertical-align: middle;">
					<?= $value->_transaccion ?>
					
				</td>
				<td style="width: 10%;  border: solid 1px #eceff1; padding: 0px; font-size: 2.5mm; text-align: right; vertical-align: middle;">
					<?= number_format($value->_rode,2,",",".") ?>
					
				</td>
				<td style="width: 8%;  border: solid 1px #eceff1; padding: 0px; font-size: 2.5mm; text-align: right; vertical-align: middle;">
					<?= $value->_description_state ?>
				</td>
				
			</tr>
			<?php
			$total = $total + $value->_rode;
			}
			?>
			<tr>
				
				<td style="width: 5%; background-color: transparent; border-top: solid 1px black; padding-left: 3px; padding-top: 3px; font-size: 2.5mm; text-align: center; vertical-align: middle;">
					
				</td>
				<td style="width: 5%;  background-color: transparent; border-top: solid 1px black; padding-left: 3px; padding-top: 3px; font-size: 2.5mm; text-align: center; vertical-align: middle;">
					
				</td>
				<td style="width: 20%; background-color: transparent; border-top: solid 1px black; padding-left: 3px; padding-top: 3px; font-size: 2.5mm; text-align: right; vertical-align: middle;">
					
				</td>
				<td style="width: 6%; background-color: transparent; border-top: solid 1px black; padding-left: 3px; padding-top: 3px; font-size: 2.5mm; text-align: center; vertical-align: middle;">
					
					
				</td>
				<td style="width: 10%; background-color: transparent; border-top: solid 1px black; padding-left: 3px; padding-top: 3px; font-size: 2.5mm; text-align: right; vertical-align: middle;">
					
					
				</td>
				<td style="width: 13%; background-color: transparent; border-top: solid 1px black; padding-left: 3px; padding-top: 3px; font-size: 2.5mm; text-align: right; vertical-align: middle;">
					
					
				</td>
				<td style="width: 13%; background-color: transparent; border-top: solid 1px black; padding-left: 3px; padding-top: 3px; font-size: 2.5mm; text-align: right; vertical-align: middle;">
					
					
				</td>
				<td style="width: 10%; background-color: transparent; border-top: solid 1px black; padding-left: 3px; padding-top: 3px; font-size: 2.5mm; text-align: right; vertical-align: middle;">
					
					Total:
				</td>
				<td style="width: 10%; background-color: transparent; border: solid 1px black; padding-left: 3px; padding-top: 3px; font-size: 2.5mm; text-align: right; vertical-align: middle;">
					
					<?= number_format($total,2,",",".") ?>
				</td>
				<td style="width: 8%; background-color: transparent; border-top: solid 1px black; padding-left: 3px; padding-top: 3px; font-size: 2.5mm; text-align: right; vertical-align: middle;">
					
					
				</td>
			</tr>
		</table>
	</div>
	<page_footer>
		<table style="width: 100%; border: solid 0px #d3d3d3; margin-top: -20px; font-size: 10mm;">
			
			<tr>
				<td style="text-align: right; width: 100%; font-size: 3mm;  text-decoration: none; font-family: Arial;">
					<i>Quieres acceder a nuestra paltaforma visita http://186.64.122.21/~franquiciasfini/sistema o escanea el código QR con tu teléfono inteligente.</i>
				</td>
			</tr>
		</table>
	</page_footer>
</page>