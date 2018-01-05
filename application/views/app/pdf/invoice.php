<?php
$CI =& get_instance();
$CI->load->model([
	"app/cellar/AppCellarModel",
]);

$order = base64_decode($data["o"]);
$store = base64_decode($data["s"]);
$information = $CI->AppCellarModel->getInformationStore($store);
$resumen = $CI->AppCellarModel->getResumenOrder($order);
?>
<page backtop="20mm" backbottom="5mm" backleft="0mm"  backright="0mm" backimgw="350px" backimg="<?= PATH_PUBLIC_IMG."/logotamy-water.png" ?>">
	<page_header backleft="53mm" backright="3mm">
		<table style="width: 100%; border: solid 0px #d3d3d3; margin-top: 5px; font-size: 5mm;">
			<tr>
				<td style="text-align: center; width: 20%;  border: solid 1px #212121;">
					<img src="<?= PATH_PUBLIC_IMG."/logotamy.png" ?>" style="width: 60px;">
				</td>
				<td style="text-align: left; width: 60%;  border: solid 1px #212121; font-size: 7mm;">
					<table style="width: 100%; border: solid 0px #d3d3d3; font-size: 5mm;">
						<tr>
							<td style="text-align: center; width: 100%;  border: solid 0px #d3d3d3; font-size: 6mm;">Comprobante de Compra</td>
						</tr>
						
					</table>
				</td>
				<td style="text-align: left; width: 20%;  border: solid 1px #d32f2f; font-size: 7mm;">
					<table style="width: 100%; border: solid 0px #d3d3d3; font-size: 5mm;">
						<tr>
							<td style="text-align: center; width: 100%;  color: #d32f2f; font-size: 6mm;">Orden</td>
						</tr>
						<tr>
							<td style="text-align: center; width: 100%;  color: #d32f2f; font-size: 6mm;">#<?= $order ?></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</page_header>
		<table style="width: 100%; border: solid 0px #d3d3d3; margin-top: 0px; font-size: 10mm;">
			<tr>
				<td style="text-align: left; width: 30%; font-size: 4mm;  border: solid 0px #212121; text-decoration: none;">
					<table style="width: 100%; border: solid 0px #d3d3d3;">
						<tr>
							<td style=" font-size: 2.5mm; text-align: left; vertical-align: middle;"><?= TITLE_PDF ?></td>
						</tr>
						<tr>
							<td style=" font-size: 2.5mm; text-align: left; vertical-align: middle;"><?= TITLE_PDF_3 ?></td>
						</tr>
						<tr>
							<td style=" font-size: 2.5mm; text-align: left; vertical-align: middle;"><?= TITLE_PDF_2 ?></td>
						</tr>
					</table>
				</td>
				<td style="text-align: left; width: 50%; font-size: 4mm; border: solid 0px #212121; text-decoration: none;">
					<table style="width: 100%; border: solid 0px #d3d3d3;">
						<tr>
							<td style=" font-size: 2.5mm; text-align: left; vertical-align: middle;"><?= $information->_store ?></td>
						</tr>
						<tr>
							<td style=" font-size: 2.5mm; text-align: left; vertical-align: middle;"><?= $information->_idn ?></td>
						</tr>
						<tr>
							<td style=" font-size: 2.5mm; text-align: left; vertical-align: middle;"><?= $information->_email ?></td>
						</tr>
						<tr>
							<td style=" font-size: 2.5mm; text-align: left; vertical-align: middle;"><?= $information->_dir ?></td>
						</tr>
					</table>
				</td>
				<td style="text-align: center; width: 20%; font-size: 4mm; border: solid 0px #212121; text-decoration: none;">
					<barcode dimension="1D" type="C128B" value="<?= sprintf("%03d",$store)."-".sprintf("%05d",$order) ?>" label="none" style="width:38mm; height: 17mm; color: black; font-size: 4mm"></barcode>
				</td>
			</tr>
		</table>

	<div style="page-break-AFTER: always;">
		<table style="width: 100%; border: solid 0px #d3d3d3; margin-top: 0px;">
			<tr>
				<td style="width: 5%; border: solid 1px #212121; padding-left: 3px; padding-top: 3px; font-size: 2.5mm; text-align: center; vertical-align: middle;">
					item
				</td>
				<td style="width: 10%; border: solid 1px #212121; padding-left: 3px; padding-top: 3px; font-size: 2.5mm; text-align: center; vertical-align: middle;">
					Código
				</td>
				<td style="width: 40%; border: solid 1px #212121; padding-left: 3px; padding-top: 3px; font-size: 2.5mm; text-align: center; vertical-align: middle;">
					Descripción
				</td>
				<td style="width: 10%; border: solid 1px #212121; padding-left: 3px; padding-top: 3px; font-size: 2.5mm; text-align: center; vertical-align: middle;">
					Und
				</td>
				<td style="width: 5%; border: solid 1px #212121; padding-left: 3px; padding-top: 3px; font-size: 2.5mm; text-align: center; vertical-align: middle;">
					Cant
				</td>
				<td style="width: 10%; border: solid 1px #212121; padding-left: 3px; padding-top: 3px; font-size: 2.5mm; text-align: center; vertical-align: middle;">
					Valor/Unidad
				</td>
				<td style="width: 10%; border: solid 1px #212121; padding-left: 3px; padding-top: 3px; font-size: 2.5mm; text-align: center; vertical-align: middle;">
					Desc
				</td>
				<td style="width: 10%; border: solid 1px #212121; padding-left: 3px; padding-top: 3px; font-size: 2.5mm; text-align: center; vertical-align: middle;">
					Total
				</td>
			</tr>
			<?php
			$i = 1;

			$item = $CI->AppCellarModel->getItemOrderWidthStore($order, $store);
				foreach ($item as $key => $value){
			?>
			<tr>
				<td style=" border: solid 0px #eceff1; padding-left: 3px; padding-top: 3px; font-size: 2mm; text-align: center; vertical-align: middle;">
					<?= $i ?>
				</td>

				<td style=" border: solid 0px #eceff1; padding-left: 3px; padding-top: 3px; font-size: 2mm; text-align: center; vertical-align: middle;">
					<?= $value->_producto_sku ?>
				</td>

				<td style=" border: solid 0px #eceff1; padding-left: 3px; padding-top: 3px; font-size: 2mm; text-align: left; vertical-align: middle;">
					<?= $value->_product ?>
				</td>
				<td style="border: solid 0px #eceff1; padding-left: 3px; padding-top: 3px; font-size: 2mm; text-align: center; vertical-align: middle;">
					UND
				</td>
				<td style="width: 5%; border: solid 0px #eceff1; padding-left: 3px; padding-top: 3px; font-size: 2mm; text-align: right; vertical-align: middle;">
					<?= number_format($value->_cant,2) ?>
				</td>
				<td style=" border: solid 0px #eceff1; padding-left: 3px; padding-top: 3px; font-size: 2mm; text-align: right; vertical-align: middle;">
					$<?= number_format($value->_price,2,",",".") ?>
				</td>
				<td style=" border: solid 0px #eceff1; padding-left: 3px; padding-top: 3px; font-size: 2mm; text-align: right; vertical-align: middle;">
					$<?= number_format($value->_discount,2,",",".") ?>
				</td>
				<td style=" border: solid 0px #eceff1; padding-left: 3px; padding-top: 3px; font-size: 2mm; text-align: right; vertical-align: middle;">
					$<?= number_format($value->_rode,2,",",".") ?>
				</td>
			</tr>
			<?php
			$i++;
			}
			?>
		</table>
	</div>
	<div style="page-break-AFTER: always;">
		<table style="width: 100%; border: solid 0px #d3d3d3; margin-top: 0px;">
			<tr>
				<td style="text-align: left; width: 50%; font-size: 4mm;  border: solid 1px #212121; text-decoration: none;">
					<table style="width: 100%; border: solid 0px #d3d3d3;">
						<tr>
							<td style=" font-size: 2mm; text-align: left; vertical-align: middle;">Saldo: $<?= number_format($information->_balance,2,",",".") ?></td>
						</tr>
						<tr>
							<td style=" font-size: 2mm; text-align: left; vertical-align: middle;">Condicón de pago: <?= $information->_paying_to ?> Dias</td>
						</tr>
						<tr>
							<td style=" font-size: 2mm; text-align: left; vertical-align: middle;">Forma de Pago: <?= $information->_type_pay ?></td>
						</tr>
					</table>
				</td>
				<td style="text-align: left; width: 50%; font-size: 4mm;  border: solid 1px #212121; text-decoration: none;">
					<table style="width: 100%; border: solid 0px #d3d3d3;">
						<tr>
							<td style="width: 75%;  font-size: 2mm; text-align: right; vertical-align: middle;">Neto:</td>
							<td style="width: 25%;  font-size: 2mm; text-align: right; vertical-align: middle;">$<?= number_format($resumen->_total_neto,2,",",".") ?></td>
						</tr>
						<tr>
							<td style=" width: 75%;font-size: 2mm; text-align: right; vertical-align: middle;">IVA</td>
							<td style="width: 25%;  font-size: 2mm; text-align: right; vertical-align: middle;">$<?= number_format($resumen->_total_iva,2,",",".") ?></td>
						</tr>
						<tr>
							<td style=" width: 75%;font-size: 2mm; text-align: right; vertical-align: middle;">Descuento:</td>
							<td style="width: 25%;  font-size: 2mm; text-align: right; vertical-align: middle;">$<?= number_format(0,2,",",".") ?></td>
						</tr>
						<tr>
							<td style=" width: 75%;font-size: 2mm; text-align: right; vertical-align: middle;">Total:</td>
							<td style="width: 25%;  font-size: 2mm; text-align: right; vertical-align: middle;">$<?= number_format($resumen->_total_order,2,",",".") ?></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</div>

	<div style="page-break-AFTER: always;">
		<table style="width: 100%; border: solid 0px #d3d3d3; margin-top: 0px;">
			<tr>
				<td style="text-align: left; width: 50%; font-size: 4mm;  border: solid 0px #d3d3d3; text-decoration: none;">
					<table style="width: 100%; border: solid 0px #d3d3d3;">
						<tr>
							<td style=" font-size: 2mm; text-align: left; vertical-align: middle;">
							Puede retirar sus pedidos en nuestra bodega ubicada en Avenida Club Hipico 4676 Bodega B1-41, Comuna Pedro Aguirre Cerda. 
							<p>Este documento no es electrónico es solo un soporte de la orden realizada en nuestra plataforma.</p></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		 <div style="rotate: 90; position: absolute; width: 100mm; height: 4mm; left: 208mm; top: 750px; font-style: italic; font-weight: normal; text-align: center; font-size: 2mm;">
        Documento generado por TAMY SPA <?= date("m-d-Y") ?>
    </div>
	</div>
	<page_footer>
		<table style="width: 100%; border: solid 0px #d3d3d3; margin-top: -20px; font-size: 10mm;">
			
			<tr>
				<td style="text-align: right; width: 100%; font-size: 2mm;  text-decoration: none; font-family: Arial;">
					<i>Quieres acceder a nuestra paltaforma visita http://186.64.122.21/~franquiciasfini/sistema o escanea el código QR con tu teléfono inteligente.</i>
				</td>
			</tr>
		</table>
	</page_footer>
</page>