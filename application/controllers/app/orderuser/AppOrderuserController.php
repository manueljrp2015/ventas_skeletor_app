<?php

/**
* 
*/
class appOrderuserController extends CI_Controller
{
	private $dbf;
	
	function __construct()
	{
		parent::__construct();
		$this->appoAuthModel->oauthChecked();
		$this->dbf = $this->load->database('franquisia', TRUE);
		$this->load->model([
			"app/functions/appFunctionsModel",
			"app/files/appFileProcessModel",
			"app/orderuser/appOrderuserModel",
			"app/odbc/appOdbcModel"
			]);
	}

	protected function errorValidation()
  	{
	    $response = ["text" => validation_errors()];
	    $this->load->view("app/response/text", $response);
  	}

	public function index(){

		$this->appMonitorModel->putRecord(["user" => $this->session->userdata("id") ,"process" => "ha ingresado al modulo de pedidos"]);	
		$data = [
			"folder"   => "orderuser",
			"file"     => "orderuser-list",
			'listAllOrder' => $this->appOrderuserModel->getAllOrder(),
	    ];

	    $this->load->view("app/template/index_template_app", $data);

	}

	public function getDetOrdersUser(){
					$response = ["text" => json_encode( $this->appOrderuserModel->getDetOrdersUser($this->input->get("id")), JSON_FORCE_OBJECT)];
		$this->load->view("app/response/text", $response);
	}

	public function getListFactureForOrders(){
					$response = ["text" => json_encode( $this->appOrderuserModel->getListFactureForOrders($this->input->get("id")), JSON_FORCE_OBJECT)];
		$this->load->view("app/response/text", $response);
	}

	public function changeState(){
					$response = ["text" => json_encode( $this->appOrderuserModel->changeState($this->input->post()), JSON_FORCE_OBJECT)];
		$this->load->view("app/response/text", $response);
	}


	public function gifPromo(){
					$response = ["text" => json_encode( $this->appOrderuserModel->gifPromo($this->input->post()), JSON_FORCE_OBJECT)];
		$this->load->view("app/response/text", $response);
	}

}