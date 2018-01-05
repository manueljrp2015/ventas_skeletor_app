<?php


/**
* 
*/
class appTempInfoController extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->appoAuthModel->oauthChecked();
		$this->load->model([
	      "app/information/appTempInfoModel",
	    ]);
	}


	protected function errorValidation()
  	{
	    $response = ["text" => validation_errors()];
	    $this->load->view("app/response/text", $response);
  	}


  	public function index(){

 	$this->appMonitorModel->putRecord(["user" => $this->session->userdata("id") ,"process" => "ha ingresado al modulo de información de tiendas"]);	
	$data = [
			"folder"   => "information",
			"file"     => "information-temp",
			'listInfo' => $this->appTempInfoModel->getListStoreInfo(),
	    ];

	    $this->load->view("app/template/index_template_app", $data);
	}

	public function getInfoAdd(){
					$response = ["text" => json_encode([
					"infoadd" => $this->appTempInfoModel->getInfoAdd($this->input->get("id")),
		        	], JSON_FORCE_OBJECT)];
		$this->load->view("app/response/text", $response);
	}



}