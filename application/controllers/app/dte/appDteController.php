<?php


/**
* 
*/
class appDteController extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();

	}

	public function index(){

		$url = 'https://libredte.cl';
		$hash = 'x';
		$dte = [
		    'Encabezado' => [
		        'IdDoc' => [
		            'TipoDTE' => 33,
		        ],
		        'Emisor' => [
		            'RUTEmisor' => '76474314-8',
		        ],
		        'Receptor' => [
		            'RUTRecep' => '76365229-7',
		            'RznSocRecep' => 'Persona sin RUT',
		            'GiroRecep' => 'Particular',
		            'DirRecep' => 'Santiago',
		            'CmnaRecep' => 'Santiago',
		        ],
		    ],
		    'Detalle' => [
		        [
		            'NmbItem' => 'Producto 1',
		            'QtyItem' => 2,
		            'PrcItem' => 1000,
		        ],
		    ],
		];

		$LibreDTE = new \sasco\LibreDTE\SDK\LibreDTE($hash, $url);

		$emitir = $LibreDTE->post('/dte/documentos/emitir', $dte);
		echo $emitir['status']['code'];
		if ($emitir['status']['code']!=200) {
		    die('Error al emitir DTE temporal: '.$emitir['body']."\n");
		}
		// crear DTE real
		$generar = $LibreDTE->post('/dte/documentos/generar', $emitir['body']);
		if ($generar['status']['code']!=200) {
		    die('Error al generar DTE real: '.$generar['body']."\n");
		}
		// obtener el PDF del DTE
		$generar_pdf = $LibreDTE->get('/dte/dte_emitidos/pdf/'.$generar['body']['dte'].'/'.$generar['body']['folio'].'/'.$generar['body']['emisor']);
		if ($generar_pdf['status']['code']!=200) {
		    die('Error al generar PDF del DTE: '.$generar_pdf['body']."\n");
		}
		// guardar PDF en el disco
		file_put_contents(str_replace('.php', '.pdf', basename(__FILE__)), $generar_pdf['body']);
	}

	public function emitido(){

		$url = 'https://libredte.cl';
		$hash = '';
		$rut = 76192083;
		$dte = 33;
		$folio = 42;
		$papelContinuo = 0; // =75 ó =80 para papel contínuo
		$copias_tributarias = 1;
		$copias_cedibles = 1;
		$cedible = (int)(bool)$copias_cedibles; // =1 genera cedible, =0 no genera cedible

		// incluir autocarga de composer
	

		// crear cliente
		$LibreDTE = new \sasco\LibreDTE\SDK\LibreDTE($hash, $url);

		// descargar PDF
		echo $opciones = '?papelContinuo='.$papelContinuo.'&copias_tributarias='.$copias_tributarias.'&copias_cedibles='.$copias_cedibles.'&cedible='.$cedible;

		$pdf = $LibreDTE->get('/dte/dte_emitidos/pdf/'.$dte.'/'.$folio.'/'.$rut.$opciones);
		if ($pdf['status']['code']!=200) {
		    die('Error al descargar el PDF del DTE emitido: '.$pdf['body']."\n");
		}
		file_put_contents('005-dte_emitido_pdf.pdf', $pdf['body']);

	}
}