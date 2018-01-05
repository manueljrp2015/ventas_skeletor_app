<?php

/**
* 
*/
class appInventoryController extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->appoAuthModel->oauthChecked();
		$this->load->model([
	      "app/inventory/appInventoryModel",
	      "app/functions/appFunctionsModel",
	      "app/catalogs/appCatalogsModel"
	    ]);
	}

	protected function errorValidation()
  	{
	    $response = ["text" => validation_errors()];
	    $this->load->view("app/response/text", $response);
  	}

  	/*---------- warehouse -------*/
	public function indexWarehouse()
	{
		$data = [
			"folder"         => "inventory",
			"file"           => "index-warehouse",
			"warehouse_type" => $this->appCatalogsModel->getTypeWarehouse(),
			"warehouse"      => $this->appInventoryModel->getWarehouse()
	    ];

	    $this->load->view("app/template/index_template_app", $data);
	}

	protected function inputWarehouse()
	{
		$this->form_validation->set_rules('_warehouse', '_warehouse', 'trim|xss_clean');
		$this->form_validation->set_rules('_management', '_management', 'trim|xss_clean');
		$this->form_validation->set_rules('_IDTypew', '_IDTypew', 'trim|xss_clean');
	    return $this->form_validation->run();
	}

	public function storeWarehouse()
	{
		if ($this->input->is_ajax_request()) {
			if (self::inputWarehouse()) {
				$this->appInventoryModel->storeWarehouse($this->input->post());
        		$response = ["text" => true];
        		$this->load->view("app/response/text", $response);
			} else {
				self::errorValidation();
			}
			
		} else {
			$this->session->sess_destroy();
      		redirect('/','auto');
		}
	}

	public function editWarehouse()
	{
		if ($this->input->is_ajax_request()) {
			if (self::inputWarehouse()) {
				$this->appInventoryModel->editWarehouse($this->input->post());
        		$response = ["text" => true];
        		$this->load->view("app/response/text", $response);
			} else {
				self::errorValidation();
			}
			
		} else {
			$this->session->sess_destroy();
      		redirect('/','auto');
		}
	}

	public function getWarehouseId()
	{
		if ($this->input->is_ajax_request()) {
			
        	$response = ["text" => json_encode($this->appInventoryModel->getWarehouseFromId($this->input->get("id")))];
        	$this->load->view("app/response/text", $response);
		} else {
			$this->session->sess_destroy();
      		redirect('/','auto');
		}
	}


	public function indexMaterials()
	{
		$data = [
			"folder"   => "inventory",
			"file"     => "index-materials"
	    ];

	    $this->load->view("app/template/index_template_app", $data);
	}


	public function indexTransfers()
	{
		$data = [
			"folder"   => "inventory",
			"file"     => "index-transfers"
	    ];

	    $this->load->view("app/template/index_template_app", $data);
	}

	public function indexInventary()
	{
		$data = [
			"folder"   => "inventory",
			"file"     => "index-inventary"
	    ];

	    $this->load->view("app/template/index_template_app", $data);
	}

	public function indexAnalysis()
	{
		$data = [
			"folder"   => "inventory",
			"file"     => "index-analysis"
	    ];

	    $this->load->view("app/template/index_template_app", $data);
	}
}