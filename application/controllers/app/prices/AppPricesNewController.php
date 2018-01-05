<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AppPricesNewController extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->appoAuthModel->oauthChecked();
		$this->load->model([
			'app/prices/appPricesNewModel',
			'app/catalogs/AppCatalogsModel',
			"app/product/AppProductModel"
			]);
	}

	protected function errorValidation()
  	{
	    $response = ["text" => validation_errors()];
	    $this->load->view("app/response/text", $response);
  	}

  	public function index(){

	$data = [
			"folder"          => "prices",
			"file"            => "prices",
			"listStoreActive" => $this->AppCatalogsModel->getStoreNew(),
			"listProduct"     => $this->AppProductModel->getProductList()
	    ];

	    $this->load->view("app/template/index_template_app", $data);
	}

	public function updatePrices(){
		if ($this->input->is_ajax_request()) {
			$response = ["text" => json_encode( [
		        	"data" => $this->appPricesNewModel->updatePrices($this->input->get())])];
		        $this->load->view("app/response/text", $response);
		} else {
			$this->session->sess_destroy();
	        redirect('/','auto');
		}
		
	}

	public function uploadFileExcelList(){

		$file = "public/files/excel/".date("Ymdhms")."-".$_FILES["fileexcel"]["name"];

		if (move_uploaded_file($_FILES["fileexcel"]["tmp_name"], $file)) {

			$response = ["text" => json_encode( [
		        	"data" => $this->appPricesNewModel->readExcelListProduct($file, $this->input->post("id_store"))])];
		    $this->load->view("app/response/text", $response);

		} else {
			# code...
		}
	}

	public function getPricesForClient(){
		if ($this->input->is_ajax_request()) {
			$response = ["text" => json_encode( [
		        	"data" => $this->appPricesNewModel->getPricesForClient($this->input->post())])];
		        $this->load->view("app/response/text", $response);
		} else {
			$this->session->sess_destroy();
	        redirect('/','auto');
		}
	}

	public function updatePriceClient(){
		if ($this->input->is_ajax_request()) {
			$response = ["text" => json_encode( [
		        	"data" => $this->appPricesNewModel->updatePriceClient($this->input->get())])];
		        $this->load->view("app/response/text", $response);
		} else {
			$this->session->sess_destroy();
	        redirect('/','auto');
		}
	}


	public function transferPrices(){
		if ($this->input->is_ajax_request()) {
			$response = ["text" => json_encode( [
		        	"data" => $this->appPricesNewModel->transferPrices($this->input->post())])];
		        $this->load->view("app/response/text", $response);
		} else {
			$this->session->sess_destroy();
	        redirect('/','auto');
		}
	}

	public function transferPricesMultiple(){
		if ($this->input->is_ajax_request()) {
			$response = ["text" => json_encode( [
		        	"data" => $this->appPricesNewModel->transferPricesMultiple($this->input->post())])];
		        $this->load->view("app/response/text", $response);
		} else {
			$this->session->sess_destroy();
	        redirect('/','auto');
		}
	}


	public function getListPrice(){
		if ($this->input->is_ajax_request()) {
			$response = ["text" => json_encode( [
		        	"data" => $this->AppProductModel->getProductList()])];
		        $this->load->view("app/response/text", $response);
		} else {
			$this->session->sess_destroy();
	        redirect('/','auto');
		}
	}

}

/* End of file AppPricesNewController.php */
/* Location: ./application/controllers/app/prices/AppPricesNewController.php */