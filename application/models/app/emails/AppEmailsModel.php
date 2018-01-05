<?php

/**
* 
*/
class appEmailsModel extends CI_Model
{
	
	private $header;
	private $footer;
	private $colortop = "white";
	private $remit = 'apptamy@tamymayorista.cl';
	
	function __construct()
	{
		parent::__construct();
		$this->header = '
				<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
				<html>
					<head>
						<!-- If you delete this meta tag, the ground will open and swallow you. -->
						<meta name="viewport" content="width=device-width" />
						<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
						<title>'.NAME_SITE.'</title>
						
						<style type="text/css" media="screen">
							* {
						margin:0;
						padding:0;
						}
						* { font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; }
						img {
						max-width: 100%;
						}
						.collapse {
						margin:0;
						padding:0;
						}
						body {
						-webkit-font-smoothing:antialiased;
						-webkit-text-size-adjust:none;
						width: 100%!important;
						height: 100%;
						}
						a { color: #2BA6CB;}
						.btn {
						text-decoration:none;
						color: #FFF;
						background-color: #666;
						padding:10px 16px;
						font-weight:bold;
						margin-right:10px;
						text-align:center;
						cursor:pointer;
						display: inline-block;
						}
						p.callout {
						padding:15px;
						background-color:#ECF8FF;
						margin-bottom: 15px;
						}
						.callout a {
						font-weight:bold;
						color: #2BA6CB;
						}
						table.social {
						/* 	padding:15px; */
						background-color: #ebebeb;
						
						}
						.social .soc-btn {
						padding: 3px 7px;
						font-size:12px;
						margin-bottom:10px;
						text-decoration:none;
						color: #FFF;font-weight:bold;
						display:block;
						text-align:center;
						}
						a.fb { background-color: #3B5998!important; }
						a.tw { background-color: #1daced!important; }
						a.gp { background-color: #DB4A39!important; }
						a.ms { background-color: #000!important; }
						.sidebar .soc-btn {
						display:block;
						width:100%;
						}
						table.head-wrap { width: 100%;}
						.header.container table td.logo { padding: 15px; }
						.header.container table td.label { padding: 15px; padding-left:0px;}
						table.body-wrap { width: 100%;}
						table.footer-wrap { width: 100%;	clear:both!important;
						}
						.footer-wrap .container td.content  p { border-top: 1px solid rgb(215,215,215); padding-top:15px;}
						.footer-wrap .container td.content p {
						font-size:10px;
						font-weight: bold;
						
						}
						h1,h2,h3,h4,h5,h6 {
						font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif; line-height: 1.1; margin-bottom:15px; color:#000;
						}
						h1 small, h2 small, h3 small, h4 small, h5 small, h6 small { font-size: 60%; color: #6f6f6f; line-height: 0; text-transform: none; }
						h1 { font-weight:200; font-size: 44px;}
						h2 { font-weight:200; font-size: 37px;}
						h3 { font-weight:500; font-size: 27px;}
						h4 { font-weight:500; font-size: 23px;}
						h5 { font-weight:900; font-size: 17px;}
						h6 { font-weight:900; font-size: 14px; text-transform: uppercase; color:#444;}
						.collapse { margin:0!important;}
						p, ul {
						margin-bottom: 10px;
						font-weight: normal;
						font-size:14px;
						line-height:1.6;
						}
						p.lead { font-size:17px; }
						p.last { margin-bottom:0px;}
						ul li {
						margin-left:5px;
						list-style-position: inside;
						}
						ul.sidebar {
						background:#ebebeb;
						display:block;
						list-style-type: none;
						}
						ul.sidebar li { display: block; margin:0;}
						ul.sidebar li a {
						text-decoration:none;
						color: #666;
						padding:10px 16px;
						/* 	font-weight:bold; */
						margin-right:10px;
						/* 	text-align:center; */
						cursor:pointer;
						border-bottom: 1px solid #777777;
						border-top: 1px solid #FFFFFF;
						display:block;
						margin:0;
						}
						ul.sidebar li a.last { border-bottom-width:0px;}
						ul.sidebar li a h1,ul.sidebar li a h2,ul.sidebar li a h3,ul.sidebar li a h4,ul.sidebar li a h5,ul.sidebar li a h6,ul.sidebar li a p { margin-bottom:0!important;}
						/* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
						.container {
						display:block!important;
						max-width:600px!important;
						margin:0 auto!important; /* makes it centered */
						clear:both!important;
						}
						/* This should also be a block element, so that it will fill 100% of the .container */
						.content {
						padding:15px;
						max-width:600px;
						margin:0 auto;
						display:block;
						}
						.content table { width: 100%; }
						.column {
						width: 300px;
						float:left;
						}
						.column tr td { padding: 15px; }
						.column-wrap {
						padding:0!important;
						margin:0 auto;
						max-width:600px!important;
						}
						.column table { width:100%;}
						.social .column {
						width: 280px;
						min-width: 279px;
						float:left;
						}
						.clear { display: block; clear: both; }
						@media only screen and (max-width: 600px) {
						
						a[class="btn"] { display:block!important; margin-bottom:10px!important; background-image:none!important; margin-right:0!important;}
						div[class="column"] { width: auto!important; float:none!important;}
						
						table.social div[class="column"] {
						width:auto!important;
						}
						}
						</style>
					</head>
					
					<body bgcolor="#FFFFFF" topmargin="0" leftmargin="0" marginheight="0" marginwidth="0">
						<!-- HEADER -->
						<table class="head-wrap" bgcolor="'.$this->colortop.'">
							<tr>
								<td></td>
								<td class="header container" align="">
									
									<!-- /content -->
									<div class="content">
										<table bgcolor="'.$this->colortop.'" >
											<tr>
												<td><img src="'.PATH_PUBLIC_IMG."/logotamy.png".'" width="100px" /></td>
												<td align="right"><h6 class="collapse" style="color: black">'.NAME_SITE.'</h6></td>
											</tr>
										</table>
										</div><!-- /content -->
										
									</td>
									<td></td>
								</tr>
								</table><!-- /HEADER -->
								<table class="body-wrap" bgcolor="">
									<tr>
										<td></td>
										<td class="container" align="" bgcolor="#FFFFFF">
		';
		$this->footer = '
							<!-- content -->
										<!-- FOOTER -->
										<table class="footer-wrap">
											<tr>
												<td></td>
												<td class="container">
													
													<!-- content -->
													<div class="content">
														<table>
															<tr>
																<td align="center">
																	<p>
																		
																	</p>
																</td>
															</tr>
														</table>
														</div><!-- /content -->
														
													</td>
													<td></td>
												</tr>
												</table><!-- /FOOTER -->
											</body>
										</html>
	';
	}

	public function emailRenewPassword($email, $new_passowrd)
	{
		$this->email->from($this->remit, NAME_SITE);
        $this->email->to($email);
        $this->email->subject(lang('app_user_email_subject1'));
        $texto = $this->header;
        $texto .= '
			<!-- content -->
			<div class="content">
				<table>
					<tr>
						<td>
							
							<h1>'.lang('app_user_email_title1').'</h1>
							<p>'.lang('app_user_email_content1').' </p>
							<h3>'.$new_passowrd.'</h3>
						</td>
					</tr>
				</table>
				</div><!-- /content -->
				';
        $texto .= $this->footer;
        $this->email->message($texto);
        $this->email->send();
	}

	public function emailChangeUser($email, $new_user)
	{
		$this->email->from($this->remit, NAME_SITE);
        $this->email->to($email);
        $this->email->subject(lang('app_user_email_subject2'));
        $texto = $this->header;
        $texto .= '
			<!-- content -->
			<div class="content">
				<table>
					<tr>
						<td>
							
							<h1>'.lang('app_user_email_title2').'</h1>
							<p>'.lang('app_user_email_content2').' </p>
							<h3>'.$new_user.'</h3>
						</td>
					</tr>
				</table>
				</div><!-- /content -->
				';
        $texto .= $this->footer;
        $this->email->message($texto);
        $this->email->send();
	}

	public function emailChangeMail($email)
	{
		$this->email->from($this->remit, NAME_SITE);
        $this->email->to($email);
        $this->email->subject(lang('app_user_email_subject4'));
        $texto = $this->header;
        $texto .= '
			<!-- content -->
			<div class="content">
				<table>
					<tr>
						<td>
							
							<h1>'.lang('app_user_email_title4').'</h1>
							<p>'.lang('app_user_email_content4').' </p>
						</td>
					</tr>
				</table>
				</div><!-- /content -->
				';
        $texto .= $this->footer;
        $this->email->message($texto);
        $this->email->send();
	}

	public function emailChangeMailRecovery($email)
	{
		$this->email->from($this->remit, NAME_SITE);
        $this->email->to($email);
        $this->email->subject(lang('app_user_email_subject5'));
        $texto = $this->header;
        $texto .= '
			<!-- content -->
			<div class="content">
				<table>
					<tr>
						<td>
							
							<h1>'.lang('app_user_email_title5').'</h1>
							<p>'.lang('app_user_email_content5').' </p>
						</td>
					</tr>
				</table>
				</div><!-- /content -->
				';
        $texto .= $this->footer;
        $this->email->message($texto);
        $this->email->send();
	}

	public function emailWelcome($data)
	{
		$this->email->from($this->remit, NAME_SITE);
        $this->email->to($data["email"]);
        $this->email->subject(lang('app_user_email_subject6').NAME_SITE);
        $texto = $this->header;
        $texto .= '
			<!-- content -->
			<div class="content">
				<table>
					<tr>
						<td>
							
							<h1>'.lang('app_user_email_title6').$data["user"].'</h1>
							<p>'.lang('app_user_email_content6').' </p>
						</td>
					</tr>
				</table>
				</div><!-- /content -->
				';
        $texto .= $this->footer;
        $this->email->message($texto);
        $this->email->send();
	}

	public function emailChangePassword($email, $new_pass)
	{
		$this->email->from($this->remit, NAME_SITE);
        $this->email->to($email);
        $this->email->subject(lang('app_user_email_subject3'));
        $texto = $this->header;
        $texto .= '
			<!-- content -->
			<div class="content">
				<table>
					<tr>
						<td>
							
							<h1>'.lang('app_user_email_title3').'</h1>
							<p>'.lang('app_user_email_content3').' </p>
							<h3>'.$new_pass.'</h3>
						</td>
					</tr>
				</table>
				</div><!-- /content -->
				';
        $texto .= $this->footer;
        $this->email->message($texto);
        $this->email->send();
	}

	public function emailRegisterBusiness($data)
	{
		$this->email->from($this->remit, NAME_SITE);
        $this->email->to(data['_mail']);
        $this->email->subject(lang('app_businnesuser_email1').data['_business']);
        $texto = $this->header;
        $texto .= '
			<!-- content -->
			<div class="content">
				<table>
					<tr>
						<td>
							
							<h1>'.lang('app_businnesuser_email2').'</h1>
							<p>'.lang('app_businnesuser_email3').' </p>
						</td>
					</tr>
				</table>
				</div><!-- /content -->
				';
        $texto .= $this->footer;
        $this->email->message($texto);
        $this->email->send();
	}

	public function mailActivateBusiness($mail, $code)
	{
		$this->email->from($this->remit, NAME_SITE);
        $this->email->to($mail);
        $this->email->subject("Cliente Activado - Codigo: ".$code);
        $texto = $this->header;
        $texto .= '
			<!-- content -->
			<div class="content">
				<table>
					<tr>
						<td>
							
							<h3>Cliente Activado '.$code.'</h3>
							<p>Usted ha sido activado en nuestro sistema para realizar compras, pagos y otras actividades dentro de nuestra plataforma.</p>
						</td>
					</tr>
				</table>
				</div><!-- /content -->
				';
        $texto .= $this->footer;
        $this->email->message($texto);
        $this->email->send();
	}

	public function mailBlockBusiness($mail, $msg)
	{
		$this->email->from($this->remit, NAME_SITE);
        $this->email->to($mail);
        $this->email->subject("Bloqueo de Cuenta Cliente");
        $texto = $this->header;
        $texto .= '
			<!-- content -->
			<div class="content">
				<table>
					<tr>
						<td>
							
							<h3>Cuenta Bloqueada</h3>
							<p>Su cuenta ha sido bloqueada para realizar operaciones dentro de nuestra plataforma, esto debido a que ha incurrido en una infracción dentro de los procesos operativos en nuestra plataforma a continuación de describe el motivo:</p>
							<p><i>"'.$msg.'"</i></p>
						</td>
					</tr>
				</table>
				</div><!-- /content -->
				';
        $texto .= $this->footer;
        $this->email->message($texto);
        $this->email->send();
	}

	public function mailunBlockBusiness($mail)
	{
		$this->email->from($this->remit, NAME_SITE);
        $this->email->to($mail);
        $this->email->subject("Desbloqueo de Cuenta Cliente");
        $texto = $this->header;
        $texto .= '
			<!-- content -->
			<div class="content">
				<table>
					<tr>
						<td>
							
							<h3>Cuenta Desloqueada</h3>
							<p>Su cuenta ha sido desbloqueada para realizar operaciones dentro de nuestra plataforma.</p>
						</td>
					</tr>
				</table>
				</div><!-- /content -->
				';
        $texto .= $this->footer;
        $this->email->message($texto);
        $this->email->send();
	}

	public function mailConfigBusiness($mail, $data)
	{
		$this->email->from($this->remit, NAME_SITE);
        $this->email->to($mail);
        $this->email->subject("Cliente Configurado");
        $texto = $this->header;
        $texto .= '
			<!-- content -->
			<div class="content">
				<table>
					<tr>
						<td>
							
							<h3>Cliente Configurado</h3>
							<p>Los parámetros de compra de su cuenta han sido configurados, a continuación se enumeran los parámetros: </p>
							<p>
								<ul>
									<li><b>Cantidad Minima:</b> '.$data["_minbuy"].'</li>
									<li><b>Cantidad Maxima:</b> '.$data["_maxbuy"].'</li>
									<li><b>Dia:</b> '.$data["group1"].'</li>
									<li><b>Frequencia:</b> '.strtoupper($data["group2"]).'</li>
								</ul>
							</p>
						</td>
					</tr>
				</table>
				</div><!-- /content -->
				';
        $texto .= $this->footer;
        $this->email->message($texto);
        $this->email->send();
	}


	public function mailSendFileNewStoreSoftlan($data, $file)
	{
		$this->email->from('apptamy@tamymayorista.cl', NAME_SITE);
        $this->email->to("evelyn.flores@grupofranquicias.com");
        $this->email->subject("Auxiliar a importar en softland: ".ucwords($data['_name']));
        $texto = $this->header;
        $texto .= '
			<!-- content -->
			<div class="content">
				<table>
					<tr>
						<td>
							
							<h5>Auxiliar a importar en softland</h5>
							<p>Tienda: '.ucwords($data['_name']).' - RUT: '.$data['_rut'].'</p>
							<p>Se adjunta archivo para su importación a softland cualquier duda o inconveniente comunicarse al departamento de soporte técnico.</p>
						</td>
					</tr>
				</table>
				</div><!-- /content -->
				';
        $texto .= $this->footer;
        $this->email->message($texto);
        $this->email->attach($file);
        $this->email->send();
	}

	public function mailStoreSoftlanCreate($data)
	{
		$this->email->from('apptamy@tamymayorista.cl', NAME_SITE);
        $this->email->to("evelyn.flores@grupofranquicias.com");
        $this->email->subject("Cliente importado a softland: ".ucwords($data['_name']));
        $texto = $this->header;
        $texto .= '
			<!-- content -->
			<div class="content">
				<table>
					<tr>
						<td>
							
							<h5>Cliente importado a softland</h5>
							<p>Tienda: '.ucwords($data['_name']).' - RUT: '.$data['_rut'].'</p>
							<p>El cliente ha sido automaticamente importado a sofland por favor revisar en la plataforma.</p>
						</td>
					</tr>
				</table>
				</div><!-- /content -->
				';
        $texto .= $this->footer;
        $this->email->message($texto);
        $this->email->send();
	}

	public function mailStoreCreate($data)
	{
		$this->email->from('apptamy@tamymayorista.cl', NAME_SITE);
        $this->email->to(strtolower($data['_email']));
        $this->email->subject("Bienvenido a TAMY SPA");
        $texto = $this->header;
        $texto .= '
			<!-- content -->
			<div class="content">
				<table>
					<tr>
						<td>
							
							<h5>Estimado: </h5>
							<p>'.ucwords($data['_name']).' - RUT: '.$data['_rut'].'</p>
							<p>Tamy SPA le da la bienvenida a nuestra nueva plataforma web con mayor seguridad e información a la hora de hacer sus compras.</p>
							<p>Gracias por preferirnos.</p>
						</td>
					</tr>
				</table>
				</div><!-- /content -->
				';
        $texto .= $this->footer;
        $this->email->message($texto);
        $this->email->send();
	}


	public function mailCreateStoreUser($data)
	{
		$names = explode(" ", trim($data['nombre']));

		$this->email->from('apptamy@tamymayorista.cl', NAME_SITE);
        $this->email->to(trim($data['email']));
        $this->email->subject("Acceso a sistema de pedido creado");
        $texto = $this->header;
        $texto .= '
			<!-- content -->
			<div class="content"> 
				<table>
					<tr>
						<td>
							
							<p>Estimado (a) '.ucwords(trim($names[0])).'</p>
							<p>Informamos que se le ha creado un usuario en el sistema de pedidos TAMY para que canalice mediante esa vía la solicitud de productos.</p>
							<p>Para acceder al sistema debe ingresar en el siguiente enlace: <a href="http://186.64.122.21/~franquiciasfini/pedidos/login.php">Click Aqui!</a></p>
								<ul>
									<li><b>Usuario:</b> '.trim($data['user']).'</li>
									<li><b>La contraseña para ingresar es:</b> '.trim($data['pass']).'</li>
								</ul>

								<p>El manual para realizar pedidos mediante el sistema de pedidos se encuentra en el siguiente enlace: <a href="http://186.64.122.21/~franquiciasfini/Manuales/manual_de_pedidos.pdf">Descargar Aqui!</a>
								</p>

								<p>Saludos...</p>
						</td>
					</tr>
				</table>
				</div><!-- /content -->
				';
        $texto .= $this->footer;
        $this->email->message($texto);
        $this->email->send();
	}

	public function mailRelationsStoreUser($email, $nombre, $tienda, $rut)
	{
		$this->email->from('apptamy@tamymayorista.cl', NAME_SITE);
        $this->email->to(trim($email));
        $this->email->subject(strtoupper($tienda)." fue asignada a su sistema de pedido");
        $texto = $this->header;
        $texto .= '
			<!-- content -->
			<div class="content"> 
				<table>
					<tr>
						<td>
							
							<p>Estimado (a) '.ucwords(trim($nombre)).'</p>
							<p>Informamos que se ha creado el cliente <b>'.strtoupper($tienda).'</b>  RUT <b>('.$rut.')</b>, por lo que desde ya puede realizar pedidos en el sistema a través de su usuario.</p>
							<p>Para acceder al sistema debe ingresar en el siguiente enlace: <a href="http://186.64.122.21/~franquiciasfini/pedidos/login.php">Click Aqui!</a></p>
		
								<p>Saludos...</p>
						</td>
					</tr>
				</table>
				</div><!-- /content -->
				';
        $texto .= $this->footer;
        $this->email->message($texto);
        $this->email->send();
	}


	public function testEmail()
	{
		$this->email->from($this->remit, 'MRDevelopers');
        $this->email->to("manueljrp@gmail.com");
        $this->email->subject('Test Email MRDevelopers');
        $texto = $this->header;
        $texto .= '
			<!-- content -->
			<div class="content">
				<table>
					<tr>
						<td>
							
							<h1>'.lang('app_user_email_title1').'</h1>
							<p>'.lang('app_user_email_content1').' </p>
							<h3>hjdUIYus25sanH</h3>
						</td>
					</tr>
				</table>
				</div><!-- /content -->
				';
        $texto .= $this->footer;
        $this->email->message($texto);
        $this->email->send();
        echo $this->email->print_debugger();
	}

	public function viewTest()
	{
		$texto = $this->header;
        $texto .= '
			<!-- content -->
			<div class="content">
				<table>
					<tr>
						<td>
							
							<h1>'.lang('app_user_email_title1').'</h1>
							<p>'.lang('app_user_email_content1').' </p>
							<h3>hjdUIYus25sanH</h3>
						</td>
					</tr>
				</table>
				</div><!-- /content -->
				';
        $texto .= $this->footer;
        echo $texto;
	}
}