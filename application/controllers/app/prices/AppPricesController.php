<?php

/**
* 
*/
class appPricesController extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->appoAuthModel->oauthChecked();
		$this->load->model([
			'app/prices/appPricesModel',
			'app/catalogs/appCatalogsModel'
			]);
	}

	protected function errorValidation()
  	{
	    $response = ["text" => validation_errors()];
	    $this->load->view("app/response/text", $response);
  	}

  	public function indexPrices(){

 	$this->appMonitorModel->putRecord(["user" => $this->session->userdata("id") ,"process" => "ha ingresado al modulo lista de productos"]);	
	$data = [
			"folder"   => "prices",
			"file"     => "process-prices",
			'listStore' => $this->appCatalogsModel->getStore(),
	    ];

	    $this->load->view("app/template/index_template_app", $data);
	}


	public function indexListProductos(){

		$data = [
			"folder"          => "prices",
			"file"            => "list-prices",
			'listProduct' => $this->appPricesModel->getListProductos(),
	    ];

	    $this->load->view("app/template/index_template_app", $data);
	}

	public function getListProductForStoreActive(){

		 if($this->input->is_ajax_request()){
	      $response = ["text" => json_encode( [
		        	"data" => $this->appPricesModel->getListProductForStoreActive($this->input->post())])];
		        $this->load->view("app/response/text", $response);
	    }
	    else{
	      $this->session->sess_destroy();
	      redirect('/','auto');
	    }
	} 

	public function getListProductForStoreInactive(){

		 if($this->input->is_ajax_request()){
	      $response = ["text" => json_encode( [
		        	"data" => $this->appPricesModel->getListProductForStoreInactive($this->input->post())])];
		        $this->load->view("app/response/text", $response);
	    }
	    else{
	      $this->session->sess_destroy();
	      redirect('/','auto');
	    }
	} 
}