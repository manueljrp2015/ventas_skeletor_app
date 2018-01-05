<?php


/**
* 
*/

use Spipu\Html2Pdf\myPdf;

class appPdfController extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->appoAuthModel->oauthChecked();
		$this->load->model([
			"app/purchases/appPurchasesModel",
			"app/catalogs/appCatalogsModel",
			"app/client/AppClientModel",
			"app/product/AppProductModel",
			"app/prices/AppPricesNewModel"
			]);
	}

	public function invoice()
	{
		$html2pdf = new Html2Pdf('P', 'LETTER', 'es', TRUE, 'UTF-8', array(5, 2, 5, 5));
        $html2pdf->pdf->SetDisplayMode('real');
        $dat = ["data" => $this->input->get()];
        $html2pdf->WriteHTML($this->load->view('app/pdf/invoice', $dat, TRUE));
        $html2pdf->Output('invoice.pdf');
	}


	public function comprobanteRegistro()
	{
		$html2pdf = new Html2Pdf('P', 'LETTER', 'es', TRUE, 'UTF-8', array(5, 2, 5, 5));
        $html2pdf->pdf->SetDisplayMode('real');
        $dat = [
        	"client" => $this->AppClientModel->getClientUpdate($this->input->get("client"))
        ];
        $html2pdf->WriteHTML($this->load->view('app/pdf/comprobante-registro', $dat, TRUE));
        $html2pdf->Output('COMPROBANTE_REGISTRO.pdf');
	}


	public function listaClientes()
	{
		$html2pdf = new Html2Pdf('L', 'LETTER', 'es', TRUE, 'UTF-8', array(5, 2, 5, 5));
        $html2pdf->pdf->SetDisplayMode('real');
        $dat = [
        	"client" => $this->AppClientModel->getStores()
        ];
        $html2pdf->WriteHTML($this->load->view('app/pdf/lista-clientes', $dat, TRUE));
        $html2pdf->Output('LISTADO_CLIENTES.pdf');
	}


	public function listaProduct()
	{
		$html2pdf = new Html2Pdf('L', 'LEGAL', 'es', TRUE, 'UTF-8', array(5, 2, 5, 5));
        $html2pdf->pdf->SetDisplayMode('real');
        $dat = [
        	"product" => $this->AppProductModel->getProductList()
        ];
        $html2pdf->WriteHTML($this->load->view('app/pdf/lista-productos', $dat, TRUE));
        $html2pdf->Output('LISTADO_PRODUCTO.pdf');
	}

	public function listPrice(){
		$html2pdf = new Html2Pdf('L', 'LEGAL', 'es', TRUE, 'UTF-8', array(5, 2, 5, 5));
        $html2pdf->pdf->SetDisplayMode('real');
        $dat = [
        	"product" => $this->AppProductModel->getProductList()
        ];
        $html2pdf->WriteHTML($this->load->view('app/pdf/lista-productos', $dat, TRUE));
        $html2pdf->Output('LISTADO_PRODUCTO.pdf');
	}

	public function listaPriceClient(){

		$html2pdf = new Html2Pdf('P', 'LETTER', 'es', TRUE, 'UTF-8', array(5, 2, 5, 5));
        $html2pdf->pdf->SetDisplayMode('real');
        $dat = [
        	"data" => $this->input->get()
        ];
        $html2pdf->WriteHTML($this->load->view('app/pdf/lista-precios-clientes', $dat, TRUE));
        $html2pdf->Output('LISTADO_PRECIOS_clientes.pdf');
	}


	public function listaPrice(){

	      $html2pdf = new Html2Pdf('P', 'LETTER', 'es', TRUE, 'UTF-8', array(5, 2, 5, 5));
        $html2pdf->pdf->SetDisplayMode('real');
        $dat = [
        	"data" => $this->input->get()
        ];
        $html2pdf->WriteHTML($this->load->view('app/pdf/lista-precios', $dat, TRUE));
        $html2pdf->Output('LISTADO_PRECIOS.pdf');
	}


  public function listaReporteCredito(){

        $html2pdf = new Html2Pdf('L', 'LETTER', 'es', TRUE, 'UTF-8', array(5, 2, 5, 5));
        $html2pdf->pdf->SetDisplayMode('real');
        $dat = [
          "data" => $this->input->get()
        ];
        $html2pdf->WriteHTML($this->load->view('app/pdf/lista-reporte-credito', $dat, TRUE));
        $html2pdf->Output('LISTADO_PRECIOS.pdf');
  }

  public function listaReporteRecargasBalance(){

        $html2pdf = new Html2Pdf('P', 'LETTER', 'es', TRUE, 'UTF-8', array(5, 2, 5, 5));
        $html2pdf->pdf->SetDisplayMode('real');
        $dat = [
          "data" => $this->input->get()
        ];
        $html2pdf->WriteHTML($this->load->view('app/pdf/lista-reporte-recargas-balance', $dat, TRUE));
        $html2pdf->Output('LISTADO_PRECIOS.pdf');
  }


  public function checklistPickig(){

        $html2pdf = new Html2Pdf('P', 'LETTER', 'es', TRUE, 'UTF-8', array(5, 2, 5, 5));
        $html2pdf->pdf->SetDisplayMode('real');
        $dat = [
          "data" => $this->input->get()
        ];
        $html2pdf->WriteHTML($this->load->view('app/pdf/checklist-picking', $dat, TRUE));
        $html2pdf->Output('CHECKLIST-PICKING.pdf');
  }
}