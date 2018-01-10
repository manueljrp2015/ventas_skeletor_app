<?php


/**
* 
*/
class appPurchasesController extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->appoAuthModel->oauthChecked();
		$this->load->model([
			"app/purchases/appPurchasesModel",
			"app/catalogs/appCatalogsModel",
			]);
	}

	protected function errorValidation()
  	{
	    $response = ["text" => validation_errors()];
	    $this->load->view("app/response/text", $response);
  	}

  	public function indexPurchases(){

		$this->appMonitorModel->putRecord(["user" => $this->session->userdata("id") ,"process" => "ha ingresado al modulo mis compras."]);	
		$data = [
			"folder"      => "purchases",
			"file"        => "list-purchases",
			"typePayment" => $this->appCatalogsModel->getTypePayments(),
			"bank"        => $this->appCatalogsModel->getBankActive()
	
	    ];
	    $this->load->view("app/template/index_template_app", $data);
	}

	public function getPurchasesForStore(){
		$response = array(
            "text" => json_encode([
				"list"    => $this->appPurchasesModel->getPurchasesForStore(), 
				"summary" => $this->appPurchasesModel->getPurchasesSummaryForStore()
            	]));
		$this->load->view("app/response/text", $response);
	}

	public function getPurchasesForId(){
		$response = array(
            "text" => json_encode([
				"data"    => $this->appPurchasesModel->getPurchasesForId($this->input->get())
            	]));
		$this->load->view("app/response/text", $response);
	}

	public function getCourierOrder(){
		$response = array(
            "text" => json_encode([
				"data"    => $this->appPurchasesModel->getCourierOrder($this->input->get())
            	]));
		$this->load->view("app/response/text", $response);
	}

	public function getItemOrder(){
		$response = array(
            "text" => json_encode([
				"data"    => $this->appPurchasesModel->getItemOrder($this->input->get())
            	]));
		$this->load->view("app/response/text", $response);
	}

	public function getTimeLine(){
		$response = array(
            "text" => json_encode([
				"data"    => $this->appPurchasesModel->getTimeLine($this->input->get())
            	]));
		$this->load->view("app/response/text", $response);
	}

	public function getComment(){
		$response = array(
            "text" => json_encode([
				"data"    => $this->appPurchasesModel->getComment($this->input->get())
            	]));
		$this->load->view("app/response/text", $response);
	}

	public function putComment(){
		$response = array(
            "text" => json_encode([
				"data"    => $this->appPurchasesModel->putComment($this->input->post())
            	]));
		$this->load->view("app/response/text", $response);
	}
}