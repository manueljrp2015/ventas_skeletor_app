<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AppAdministrationController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->appoAuthModel->oauthChecked();
		$this->load->model([
			"app/administration/appAdministrationModel",
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
			"listStore" => $this->AppCatalogsModel->getStoreNew(),
			"typePayment" => $this->AppCatalogsModel->getTypePayments(),
			"bank"        => $this->AppCatalogsModel->getBankActive()
	    ];

	    $this->load->view("app/template/index_template_app", $data);
	}


	public function getPayMonth(){
		$response = ["text" => json_encode( [
		        	"data" => $this->appAdministrationModel->getPayMonth()])];
		$this->load->view("app/response/text", $response);
	} 


	public function getOrderState(){
		$response = ["text" => json_encode( [
		        	"data" => $this->appAdministrationModel->getOrderState($this->input->post())])];
		$this->load->view("app/response/text", $response);
	} 


		public function changeStateGeneric(){

		$response = array(
            		"text" => json_encode($this->appAdministrationModel->changeStateGeneric($this->input->post()
					)));
		$this->load->view("app/response/text", $response);
	}

	public function getPayClient(){
		$response = ["text" => json_encode( [
		        	"data" => $this->appAdministrationModel->getPayClient($this->input->get())])];
		$this->load->view("app/response/text", $response);
	} 

	public function getPayClientId(){
		$response = ["text" => json_encode( [
		        	"data" => $this->appAdministrationModel->getPayClientId($this->input->get())])];
		$this->load->view("app/response/text", $response);
	} 

	protected function dataFile(){
		$this->form_validation->set_rules('_order_id', '_order_id', 'trim|required|xss_clean');
		$this->form_validation->set_rules('_tipepay', '_tipepay', 'trim|required|xss_clean');
		$this->form_validation->set_rules('_bank_origin', '_bank_origin', 'trim|required|xss_clean');
		$this->form_validation->set_rules('_bank_destiny', '_bank_destiny', 'trim|required|xss_clean');
		$this->form_validation->set_rules('_transaccion', '_transaccion', 'trim|xss_clean');
		$this->form_validation->set_rules('_date_pay', '_date_pay', 'trim|required|xss_clean');
		$this->form_validation->set_rules('_rode', '_rode', 'trim|required|xss_clean');

		return $this->form_validation->run();
	}


	public function uploadFileSupport(){

		if($this->input->is_ajax_request()){

			$directorio = "public/files/support-payment/";
			$file = $_FILES["filename"]["name"];

			if (move_uploaded_file($_FILES["filename"]["tmp_name"], $directorio.$_FILES["filename"]["name"])) {
				if(self::dataFile()){
					$response = ["text" => json_encode( [
			        	"data" => $this->appAdministrationModel->savePay($file, $this->input->post())
			        	])];
			    $this->load->view("app/response/text", $response);
				}
				else{
					self::errorValidation();
				}
					
			} else {
				$response = ["text" => json_encode( ["data" => "fail"])];
			    $this->load->view("app/response/text", $response);
			}
		}
		else{
					$this->session->sess_destroy();
      		        redirect('/','auto');
		}
	}

}

/* End of file AppAdministrationController.php */
/* Location: ./application/controllers/app/administration/AppAdministrationController.php */