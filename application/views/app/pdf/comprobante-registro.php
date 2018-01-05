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
	<table style="width: 100%; border: solid 0px #d3d3d3; margin-top: 20px; font-size: 18mm;">
		<tr>
			<td style="text-align: left; width: 30%; font-size: 3mm;  text-decoration: none;">Santiago, <?= date("d-M-y") ?>
			</td>
	
			<td style="text-align: right; width: 70%; font-size: 3mm;  text-decoration: none;">
				<barcode dimension="1D" type="C128B" value="<?= $client->_refer."-".sprintf("%04d",$client->id) ?>" label="label" style="width:50mm; height:6mm; color: black; font-size: 4mm"></barcode>
			</td>
		</tr>
	</table>
	<table style="width: 100%; border: solid 0px #d3d3d3; margin-top: 15px; font-size: 10mm;">
		<tr>
			<td style="text-align: center; width: 100%; font-size: 6mm;  text-decoration: none;">Comprobante de Inclusión
			</td>
		</tr>
	</table>
	<table style="width: 100%; border: solid 0px #d3d3d3; margin-top: 15px; font-size: 10mm;">
		<tr>
			<td style="text-align: justify; width: 100%; font-size: 3.5mm;  text-decoration: none; font-family: Arial;">Se certifica que el cliente <b><?= $client->_store ?></b>, RUT:<b><?= $client->_idn ?></b>, ha sido incluido en nuestra plataforma de compras OnLine el cual podrá hacer uso de la misma de forma inmediata. La ficha de registro del cliente se muestra a :
			</td>
		</tr>
	</table>
	<table style="width: 100%; background-color: #eceff1; border: solid 1px #eceff1; margin-top: 20px; font-size: 18mm;">
		<tr>
			<td style="text-align: left; width: 100%; font-size: 3mm;  text-decoration: none;">Información Básica
			</td>
		</tr>
	</table>
	<div style="page-break-AFTER: always;">
		<table style="width: 100%; border: solid 0px #d3d3d3; margin-top: 0px;">
			<tr>
				<td style="width: 10%; background-color: #eceff1; border: solid 1px #eceff1; padding-left: 5px; padding-top: 5px; font-size: 2.5mm; text-align: center; vertical-align: middle;">
					RUT
				</td>
				<td style="width: 30%; border: solid 1px #eceff1; padding: 3px; font-size: 2.5mm; text-align: left; vertical-align: middle;">
					<?= $client->_idn ?>
				</td>
				<td style="width: 20%; border: solid 0px #d3d3d3; padding: 3px; font-size: 2.5mm; text-align: left; vertical-align: middle;">
					
				</td>
				<td style="width: 10%; background-color: #eceff1; border: solid 1px #eceff1; padding-left: 5px; padding-top: 5px; font-size: 2.5mm; text-align: center; vertical-align: middle;">
					CUENTA
				</td>
				<td style="width: 30%; border: solid 1px #eceff1; padding: 3px; font-size: 2.5mm; text-align: left; vertical-align: middle;">
					<?= $client->_refer."-".sprintf("%04d",$client->id) ?>
				</td>
			</tr>
		</table>
		<table style="width: 100%; border: solid 0px #d3d3d3; margin-top: 0px;">
			<tr>
				
				<td style="width: 10%; background-color: #eceff1; border: solid 1px #eceff1; padding-left: 3px; padding-top: 3px; font-size: 2.5mm; text-align: center; vertical-align: middle;">
					Cliente
				</td>
				<td style="width: 50%; border: solid 1px #eceff1; padding: 3px; font-size: 2.5mm; text-align: left; vertical-align: middle;">
					<?= $client->_store ?>
				</td>
				<td style="width: 10%; background-color: #eceff1; border: solid 1px #eceff1; padding-left: 3px; padding-top: 3px; font-size: 2.5mm; text-align: center; vertical-align: middle;">
					Telf.
				</td>
				<td style="width: 30%; border: solid 1px #eceff1; padding: 3px; font-size: 2.5mm; text-align: left; vertical-align: middle;">
					<?= $client->_phone ?>
					
				</td>
			</tr>
		</table>
		<table style="width: 100%; border: solid 0px #d3d3d3; margin-top: 0px;">
			<tr>
				<td style="width: 10%; background-color: #eceff1; border: solid 1px #eceff1; padding-left: 3px; padding-top: 5px; font-size: 2.5mm; text-align: center; vertical-align: middle;">
					Dirección
				</td>
				<td style="width: 50%; border: solid 1px #eceff1; padding: 3px; font-size: 2.5mm; text-align: left; vertical-align: middle;">
					<?= $client->_dir ?>
				</td>
				
				<td style="width: 10%; background-color: #eceff1; border: solid 1px #eceff1; padding-left: 3px; padding-top: 3px; font-size: 2.5mm; text-align: center; vertical-align: middle;">
					Region
				</td>
				<td style="width: 30%; border: solid 1px #eceff1; padding: 3px;  font-size: 3mm; text-align: left; vertical-align: middle;">
					<?= $client->Descripcion ?>
				</td>
				
			</tr>
		</table>
		<table style="width: 100%; background-color: #eceff1; border: solid 1px #eceff1; margin-top: 10px; font-size: 18mm;">
			<tr>
				<td style="text-align: left; width: 100%; font-size: 3mm;  text-decoration: none;">Condición de Pago
				</td>
			</tr>
		</table>
		<table style="width: 100%; border: solid 0px #d3d3d3; margin-top: 0px;">
			<tr>
				
				<td style="width: 10%; background-color: #eceff1; border: solid 1px #eceff1; padding-right: 3px; padding-top: 5px; font-size: 2.5mm; text-align: right; vertical-align: middle;">
					Linea de Credito
				</td>
				<td style="width: 40%; border: solid 1px #eceff1; padding: 3px; font-size: 2.5mm; text-align: center; vertical-align: middle;">
					<?= "$".number_format($client->_credit,2,",",".") ?>
				</td>
				<td style="width: 10%; background-color: #eceff1; border: solid 1px #eceff1; padding-right: 3px; padding-top: 3px; font-size: 2.5mm; text-align: right; vertical-align: middle;">
					Condicion
				</td>
				<td style="width: 15%; border: solid 1px #eceff1; padding: 3px; font-size: 2.5mm; text-align: center; vertical-align: middle;">
					<?= $client->_paying_to." dias" ?>
					
				</td>
				<td style="width: 10%; background-color: #eceff1; border: solid 1px #eceff1; padding-right: 3px; padding-top: 3px; font-size: 2.5mm; text-align: right; vertical-align: middle;">
					Forma
				</td>
				<td style="width: 15%; border: solid 1px #eceff1; padding: 3px; font-size: 2.5mm; text-align: center; vertical-align: middle;">
					<?= $client->_type_pay ?>
					
				</td>
			</tr>
		</table>
		<table style="width: 100%; background-color: #eceff1; border: solid 1px #eceff1; margin-top: 10px; font-size: 18mm;">
			<tr>
				<td style="text-align: left; width: 100%; font-size: 2.5mm;  text-decoration: none;">Información de Facturación
				</td>
			</tr>
		</table>
		<table style="width: 100%; border: solid 0px #d3d3d3; margin-top: 0px;">
			<tr>
				
				<td style="width: 10%; background-color: #eceff1; border: solid 1px #eceff1; padding-right: 3px; padding-top: 3px; font-size: 2.5mm; text-align: right; vertical-align: middle;">
					Razón Social
				</td>
				<td style="width: 40%; border: solid 1px #eceff1; padding: 3px; font-size: 2.5mm; text-align: left; vertical-align: middle;">
					<?= $client->_razon_social ?>
				</td>
				<td style="width: 10%; background-color: #eceff1; border: solid 1px #eceff1; padding-right: 3px; padding-top: 3px; font-size: 2.5mm; text-align: right; vertical-align: middle;">
					Giro
				</td>
				<td style="width: 40%; border: solid 1px #eceff1; padding: 3px; font-size: 2.5mm; text-align: left; vertical-align: middle;">
					<?= $client->_giro_id."-".$client->GirDes ?>
				</td>
			</tr>
		</table>
		<table style="width: 100%; border: solid 0px #d3d3d3; margin-top: 0px;">
			<tr>
				<td style="width: 10%; background-color: #eceff1; border: solid 1px #eceff1; padding-right: 3px; padding-top: 3px; font-size: 2.5mm; text-align: right; vertical-align: middle;">
					Dirección/Fact
				</td>
				<td style="width: 40%; border: solid 1px #eceff1; padding: 4px; font-size: 2.5mm; text-align: left; vertical-align: middle;">
					<?= $client->_dirfact ?>
					
				</td>
				<td style="width: 10%; background-color: #eceff1; border: solid 1px #eceff1; padding-right: 3px; padding-top: 3px; font-size: 2.5mm; text-align: right; vertical-align: middle;">
					Pais
				</td>
				<td style="width: 40%; border: solid 1px #eceff1; padding: 4px; font-size: 2.5mm; text-align: left; vertical-align: middle;">
					<?= $client->_pais_id." - ".strtoupper($client->PaiDes) ?>
					
				</td>
			</tr>
			<tr>
				<td style="width: 10%; background-color: #eceff1; border: solid 1px #eceff1; padding-right: 3px; padding-top: 3px; font-size: 2.5mm; text-align: right; vertical-align: middle;">
					Ciudad
				</td>
				<td style="width: 40%; border: solid 1px #eceff1; padding: 4px; font-size: 2.5mm; text-align: left; vertical-align: middle;">
					<?= $client->_ciudad_id." - ".strtoupper($client->CiuDes) ?>
					
				</td>
				<td style="width: 10%; background-color: #eceff1; border: solid 1px #eceff1; padding-right: 3px; padding-top: 3px; font-size: 2.5mm; text-align: right; vertical-align: middle;">
					Comuna
				</td>
				<td style="width: 40%; border: solid 1px #eceff1; padding: 4px; font-size: 2.5mm; text-align: left; vertical-align: middle;">
					<?= $client->_comuna_id." - ".strtoupper($client->ComDes) ?>
					
				</td>
			</tr>
			<tr>
				<td style="width: 10%; background-color: #eceff1; border: solid 1px #eceff1; padding-right: 3px; padding-top: 3px; font-size: 2.5mm; text-align: right; vertical-align: middle;">
					Email/DTE
				</td>
				<td style="width: 40%; border: solid 1px #eceff1; padding: 4px; font-size: 2.5mm; text-align: left; vertical-align: middle;">
					<?= $client->_emaildte ?>
					
				</td>
				
			</tr>
		</table>
		<table style="width: 100%; background-color: #eceff1; border: solid 1px #eceff1; margin-top: 10px; font-size: 18mm;">
			<tr>
				<td style="text-align: left; width: 100%; font-size: 3mm;  text-decoration: none;">Despacho
				</td>
			</tr>
		</table>
		<table style="width: 100%; border: solid 0px #d3d3d3; margin-top: 0px;">
			<tr>
				<?php
					$serial = unserialize($client->_values);
				?>
				<td style="width: 10%; background-color: #eceff1; border: solid 1px #eceff1; padding-right: 3px; padding-top: 5px; font-size: 2.5mm; text-align: right; vertical-align: middle;">
					Enviar Por
				</td>
				<td style="width: 40%; border: solid 1px #eceff1; padding: 3px; font-size: 2.5mm; text-align: left; vertical-align: middle;">
					<?= ($serial["_type_courier"] == 1) ? "Reparto Santiago" : "COURIER TNT" ?>
				</td>
				<td style="width: 10%; background-color: #eceff1; border: solid 1px #eceff1; padding-right: 3px; padding-top: 3px; font-size: 2.5mm; text-align: right; vertical-align: middle;">
					Ciudad
				</td>
				<td style="width: 15%; border: solid 1px #eceff1; padding: 3px; font-size: 2.5mm; text-align: center; vertical-align: middle;">
					<?= $serial["_city"] ?>
					
				</td>
				<td style="width: 10%; background-color: #eceff1; border: solid 1px #eceff1; padding-right: 3px; padding-top: 3px; font-size: 2.5mm; text-align: right; vertical-align: middle;">
					Pueblo
				</td>
				<td style="width: 15%; border: solid 1px #eceff1; padding: 3px; font-size: 2.5mm; text-align: center; vertical-align: middle;">
					<?= $serial["_country"] ?>
					
				</td>
			</tr>
		</table>
		<table style="width: 100%; border: solid 0px #d3d3d3; margin-top: 15px; font-size: 10mm;">
			<tr>
				<td style="text-align: justify; width: 100%; font-size: 3.5mm;  text-decoration: none; font-family: Arial;">La información suministrada para la inclusión del cliente fue comprobada y verificada por la empresa, la cual da fe de su veracidad.
				</td>
			</tr>
		</table>

		<table style="width: 100%; border: solid 0px #d3d3d3; margin-top: 15px; font-size: 10mm;">
			<tr>
				<td style="text-align: right; width: 100%; font-size: 3.5mm;  text-decoration: none; font-family: Arial;">TAMY SPA.
				</td>
			</tr>
		</table>
 <div style="rotate: 90; position: absolute; width: 100mm; height: 4mm; left: 206mm; top: 750px; font-style: italic; font-weight: normal; text-align: center; font-size: 2mm;">
        Documento generado por TAMY SPA <?= date("m-d-Y") ?>
    </div>
		
	</div>
	<page_footer>
	<table style="width: 100%; border: solid 0px #d3d3d3; margin-top: -20px; font-size: 10mm;">
			<tr>
				<td style="text-align: right; width: 100%; font-size: 3.5mm;  text-decoration: none; font-family: Arial;">
					<qrcode value="http://186.64.122.21/~franquiciasfini/sistema/" ec="H"  style="border: none; width: 20mm; background-color: white; color: black;">
					</qrcode>
				</td>
			</tr>
			<tr>
				<td style="text-align: right; width: 100%; font-size: 3mm;  text-decoration: none; font-family: Arial;">
					<i>Quieres acceder a nuestra paltaforma visita http://186.64.122.21/~franquiciasfini/sistema o escanea el código QR con tu teléfono inteligente.</i>
				</td>
			</tr>
		</table>
	</page_footer>
</page>