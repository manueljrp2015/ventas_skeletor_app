<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AppAdministrationController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->appoAuthModel->oauthChecked();
		$this->load->model([
			"app/administration/AppAdministrationModel",
			'app/catalogs/AppCatalogsModel'
			]);
	}

	protected function errorValidation()
  	{
	    $response = ["text" => validation_errors()];
	    $this->load->view("app/response/text", $response);
  	}


	public function indexPay()
	{
		$data = [
			"folder"    => "administration",
			"file"      => "administration-pay",
			"listStore" => $this->AppCatalogsModel->getStoreNew()
	    ];

	    $this->load->view("app/template/index_template_app", $data);
	}


	public function getPayMonth(){
		$response = ["text" => json_encode( [
		        	"data" => $this->AppAdministrationModel->getPayMonth()])];
		$this->load->view("app/response/text", $response);
	} 

}

/* End of file AppAdministrationController.php */
/* Location: ./application/controllers/app/administration/AppAdministrationController.php */