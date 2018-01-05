<?php

/**
* 
*/
class appFinanceAdminController extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->appoAuthModel->oauthChecked();
		$this->load->model([
	      "app/finance/appFinanceAdminModel",
	      "app/functions/appFunctionsModel"
	    ]);
	}

	protected function errorValidation()
  	{
	    $response = ["text" => validation_errors()];
	    $this->load->view("app/response/text", $response);
  	}

  
	public function indexPayments()
	{
		$data = [
			"folder"   => "finance",
			"file"     => "index-payments"
	    ];

	    $this->load->view("app/template/index_template_app", $data);
	}

	public function indexSales()
	{
		$data = [
			"folder"   => "finance",
			"file"     => "index-sales"
	    ];

	    $this->load->view("app/template/index_template_app", $data);
	}

	public function indexOrders()
	{
		$data = [
			"folder"   => "finance",
			"file"     => "index-orders"
	    ];

	    $this->load->view("app/template/index_template_app", $data);
	}

	public function indexAnalysis()
	{
		$data = [
			"folder"   => "finance",
			"file"     => "index-analysis"
	    ];

	    $this->load->view("app/template/index_template_app", $data);
	}

}