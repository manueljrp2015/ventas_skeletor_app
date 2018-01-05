<?php
$CI =& get_instance();
$CI->load->model([
	"app/cellar/AppCellarModel",
]);

$order = base64_decode($data["order"]);
?>
<page backtop="20mm" backbottom="5mm" backleft="0mm"  backright="0mm" backimgw="350px" backimg="<?= PATH_PUBLIC_IMG."/logotamy-water.png" ?>">
	<page_header backleft="53mm" backright="3mm">
		<table style="width: 100%; border: solid 0px #d3d3d3; margin-top: 5px; font-size: 5mm;">
			<tr>
				<td style="text-align: center; width: 20%;  border: solid 1px #37474f;">
					<img src="<?= PATH_PUBLIC_IMG."/logotamy.png" ?>" style="width: 30px;">
				</td>
				<td style="text-align: left; width: 60%;  border: solid 1px #37474f; font-size: 7mm;">
					<table style="width: 100%; border: solid 0px #d3d3d3; font-size: 5mm;">
						<tr>
							<td style="text-align: center; width: 100%;  border: solid 0px #d3d3d3; font-size: 6mm;">CHECKLIST VERIFICACIÓN</td>
						</tr>
					</table>
				</td>
				<td style="text-align: left; width: 20%;  border: solid 1px #d32f2f; font-size: 7mm;">
					<table style="width: 100%; border: solid 0px #d3d3d3; font-size: 5mm;">	
						<tr>
							<td style="text-align: center; width: 100%;  color: #d32f2f; font-size: 6mm;">#<?= $order ?></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</page_header>

	<div style="page-break-AFTER: always;">
		<table style="width: 100%; border: solid 0px #d3d3d3; margin-top: 0px;">
			<tr>
				
				<td style="width: 12%; background-color: #eceff1; border: solid 1px #eceff1; padding-left: 3px; padding-top: 3px; font-size: 2.5mm; text-align: center; vertical-align: middle;">
					SKU
				</td>
				<td style="width: 12%; background-color: #eceff1; border: solid 1px #eceff1; padding-left: 3px; padding-top: 3px; font-size: 2.5mm; text-align: center; vertical-align: middle;">
					EAN
				</td>
				<td style="width: 12%; background-color: #eceff1; border: solid 1px #eceff1; padding-left: 3px; padding-top: 3px; font-size: 2.5mm; text-align: center; vertical-align: middle;">
					EAN-BOX
					
				</td>
				<td style="width: 10%; background-color: #eceff1; border: solid 1px #eceff1; padding-left: 3px; padding-top: 3px; font-size: 2.5mm; text-align: center; vertical-align: middle;">
					DUN
					
				</td>
				<td style="width: 30%; background-color: #eceff1; border: solid 1px #eceff1; padding-left: 3px; padding-top: 3px; font-size: 2.5mm; text-align: center; vertical-align: middle;">
					ITEM
					
				</td>
				<td style="width: 10%; background-color: #eceff1; border: solid 1px #eceff1; padding-left: 3px; padding-top: 3px; font-size: 2.5mm; text-align: center; vertical-align: middle;">
					CANT
					
				</td>
				<td style="width: 10%; background-color: #eceff1; border: solid 1px #eceff1; padding-left: 3px; padding-top: 3px; font-size: 2.5mm; text-align: center; vertical-align: middle;">
					
					VERIFICADO
				</td>
				<td style="width: 4%; background-color: transparent; border: solid 0px #eceff1; padding-left: 3px; padding-top: 3px; font-size: 2.5mm; text-align: center; vertical-align: middle;">
					
					
				</td>
			</tr>
			<?php
				$order = ["order" => base64_decode($data["order"])];
				$item = $CI->AppCellarModel->getItemOrderForVerify($order);
				foreach ($item as $key => $value){
			?>
			<tr>
				<td style="border: solid 1px #eceff1; padding: 0px; font-size: 2mm; text-align: center; vertical-align: middle;  height: 30px;">
					<?= $value->_producto_sku ?>
				</td>
				<td style="border: solid 1px #eceff1; padding: 0px; font-size: 2mm; text-align: center; vertical-align: middle;">
					<?= $value->_ean ?>
				</td>
				<td style="border: solid 1px #eceff1; padding: 0px; font-size: 2mm; text-align: center; vertical-align: middle;">
					<?= $value->_ean_pack ?>
				</td>
				<td style="border: solid 1px #eceff1; padding: 0px; font-size: 2mm; text-align: center; vertical-align: middle;">
					<?= $value->_ean_box ?>
				</td>
				<td style="border: solid 1px #eceff1; padding-left:  5px; font-size: 2mm; text-align: right; vertical-align: middle;">
					<?= $value->_product ?>
				</td>
				<td style="border: solid 1px #eceff1; padding: 0px; font-size: 2mm; text-align: center; vertical-align: middle;">
					<?= $value->_cant?>
				</td>

				<td style="border: solid 1px #eceff1; padding: 0px; font-size: 2mm; text-align: right; vertical-align: middle;">
					
				</td>

				<td style="border: solid 1px black; padding: 0px; font-size: 2mm; text-align: center; vertical-align: middle;">
					
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

	<table style="width: 100%; border: solid 1px #37474f; margin-top: 10px;">
			<tr>
				
				<td style="width: 100%; background-color: transparent; border: solid 0px #eceff1; padding-left: 3px; padding-top: 3px; font-size: 2.5mm; text-align: left; vertical-align: middle;">
					Observación:
				</td>
			</tr>
			<tr>
				<td style="width: 100%; background-color: transparent; border: solid 0px #eceff1; padding-left: 3px; padding-top: 3px; font-size: 2.5mm; text-align: left; vertical-align: middle; height: 50px;">
					
				</td>
			</tr>
		</table>

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