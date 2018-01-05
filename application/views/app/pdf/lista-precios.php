<?php
$CI =& get_instance();
$CI->load->model([
	"app/product/AppProductModel",
]);
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
			<td style="text-align: center; width: 100%; font-size: 4mm;  text-decoration: none;">Lista de Precios
			</td>
		</tr>
	</table>
	<div style="page-break-AFTER: always;">
		<table style="width: 100%; border: solid 0px #d3d3d3; margin-top: 0px;">
			<tr>
				
				<td style="width: 7%; background-color: #eceff1; border: solid 1px #eceff1; padding-left: 3px; padding-top: 3px; font-size: 2.5mm; text-align: center; vertical-align: middle;">
					ID
				</td>
				<td style="width: 7%; background-color: #eceff1; border: solid 1px #eceff1; padding-left: 3px; padding-top: 3px; font-size: 2.5mm; text-align: center; vertical-align: middle;">
					SKU
				</td>
				<td style="width: 36%; background-color: #eceff1; border: solid 1px #eceff1; padding-left: 3px; padding-top: 3px; font-size: 2.5mm; text-align: center; vertical-align: middle;">
					ITEM
				</td>
				<td style="width: 10%; background-color: #eceff1; border: solid 1px #eceff1; padding-left: 3px; padding-top: 3px; font-size: 2.5mm; text-align: center; vertical-align: middle;">
					LINEA
					
				</td>
				<td style="width: 10%; background-color: #eceff1; border: solid 1px #eceff1; padding-left: 3px; padding-top: 3px; font-size: 2.5mm; text-align: center; vertical-align: middle;">
					PRECIO A
					
				</td>
				<td style="width: 10%; background-color: #eceff1; border: solid 1px #eceff1; padding-left: 3px; padding-top: 3px; font-size: 2.5mm; text-align: center; vertical-align: middle;">
					PRECIO A
					
				</td>
				<td style="width: 10%; background-color: #eceff1; border: solid 1px #eceff1; padding-left: 3px; padding-top: 3px; font-size: 2.5mm; text-align: center; vertical-align: middle;">
					PRECIO A
					
				</td>
				<td style="width: 10%; background-color: #eceff1; border: solid 1px #eceff1; padding-left: 3px; padding-top: 3px; font-size: 2.5mm; text-align: center; vertical-align: middle;">
					PRECIO D
					
				</td>
			</tr>
			<?php
				$prod = $CI->AppProductModel->getProductList($data["product"]);
				foreach ($prod as $key => $value){
			?>
			<tr>
				<td style="border: solid 1px #eceff1; padding: 0px; font-size: 2.5mm; text-align: center; vertical-align: middle;">
					<?= sprintf("%05d",$value->id) ?>
				</td>
				<td style="border: solid 1px #eceff1; padding: 0px; font-size: 2.5mm; text-align: center; vertical-align: middle;">
					<?= $value->_sku ?>
				</td>
				<td style="border: solid 1px #eceff1; padding: 0px; font-size: 2.5mm; text-align: left; vertical-align: middle;">
					<?= $value->_product ?>
				</td>
				<td style="border: solid 1px #eceff1; padding: 0px; font-size: 2.5mm; text-align: center; vertical-align: middle;">
					<?= $value->_line ?>
				</td>
				<td style="border: solid 1px #eceff1; padding: 0px; font-size: 2.5mm; text-align: right; vertical-align: middle;">
					<?= number_format($value->_price_a,2,",",".") ?>
				</td>
				<td style="border: solid 1px #eceff1; padding: 0px; font-size: 2.5mm; text-align: right; vertical-align: middle;">
					<?= number_format($value->_price_b,2,",",".")  ?>
				</td>
				<td style="border: solid 1px #eceff1; padding: 0px; font-size: 2.5mm; text-align: right; vertical-align: middle;">
					<?= number_format($value->_price_c,2,",",".")  ?>
				</td>

				<td style="border: solid 1px #eceff1; padding: 0px; font-size: 2.5mm; text-align: right; vertical-align: middle;">
					<?= number_format($value->_price_d,2,",",".")  ?>
				</td>
				
			</tr>
			<?php
			}
			?>
		</table>
		
		<div style="rotate: 90; position: absolute; width: 100mm; height: 4mm; left: 206mm; top: 750px; font-style: italic; font-weight: normal; text-align: center; font-size: 2mm;">
			Documento generado por TAMY SPA <?= date("m-d-Y") ?>
		</div>
		
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
