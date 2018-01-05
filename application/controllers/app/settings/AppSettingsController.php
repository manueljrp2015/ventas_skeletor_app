<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AppSettingsController extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->appoAuthModel->oauthChecked();
		$this->load->model([
			"app/settings/AppSettingsModel",
			'app/catalogs/AppCatalogsModel',
			]);
	}

	public function index()
	{
		$dashboard = "index";
   
	    $data = [
	      "folder"    => "settings",
	      "file"      => "settings-store",
	      "listStoreActive" => $this->AppCatalogsModel->getStoreNew(),
	    ];

	    $this->load->view("app/template/index_template_app", $data);
	}

	protected function errorValidation()
  	{
	    $response = ["text" => validation_errors()];
	    $this->load->view("app/response/text", $response);
  	}

	public function getSettingsParamStore(){
		if ($this->input->is_ajax_request()) {
			 $response = ["text" => json_encode( [
		        	"data" => $this->AppSettingsModel->getSettingsParamStore($this->input->get())])];
		        $this->load->view("app/response/text", $response);
		} else {
			$this->session->sess_destroy();
	      	redirect('/','auto');
		}
		
	}

	public function getPaymentConditions(){
		if ($this->input->is_ajax_request()) {
			 $response = ["text" => json_encode( [
		        	"data" => $this->AppSettingsModel->getPaymentConditions()])];
		        $this->load->view("app/response/text", $response);
		} else {
			$this->session->sess_destroy();
	      	redirect('/','auto');
		}
		
	}

	protected function dataPayment(){
		$this->form_validation->set_rules('store_id_5', 'store_id_5', 'trim|required|xss_clean');
		$this->form_validation->set_rules('_credit', '_credit', 'trim|required|xss_clean');
		$this->form_validation->set_rules('_type_pay', '_type_pay', 'trim|required|xss_clean');
		$this->form_validation->set_rules('_form_pay', '_form_pay', 'trim|required|xss_clean');

		return $this->form_validation->run();
	}


	protected function dataReload(){
		$this->form_validation->set_rules('store_id_7', 'store_id_7', 'trim|required|xss_clean');
		$this->form_validation->set_rules('_credit_2', '_credit_2', 'trim|required|xss_clean');
		$this->form_validation->set_rules('_balance', '_balance', 'trim|required|xss_clean');
		$this->form_validation->set_rules('_reload', '_reload', 'trim|required|xss_clean');

		return $this->form_validation->run();
	}


	public function putPayment(){
		if ($this->input->is_ajax_request()) {
			if (self::dataPayment()) {
				$response = ["text" => json_encode( [
		        	"data" => $this->AppSettingsModel->putPayment($this->input->post())])];
		        $this->load->view("app/response/text", $response);
			} else {
				self::errorValidation();
			}
		} else {
			$this->session->sess_destroy();
	      	redirect('/','auto');
		}
	}

		public function updatePayment(){
		if ($this->input->is_ajax_request()) {
			if (self::dataPayment()) {
				$response = ["text" => json_encode( [
		        	"data" => $this->AppSettingsModel->updatePayment($this->input->post())])];
		        $this->load->view("app/response/text", $response);
			} else {
				self::errorValidation();
			}
		} else {
			$this->session->sess_destroy();
	      	redirect('/','auto');
		}
	}


	public function getReloadCredict(){
		if ($this->input->is_ajax_request()) {
			 $response = ["text" => json_encode( [
		        	"data" => $this->AppSettingsModel->getReloadCredict()])];
		        $this->load->view("app/response/text", $response);
		} else {
			$this->session->sess_destroy();
	      	redirect('/','auto');
		}
		
	}


	public function getReloadCredictId(){
		if ($this->input->is_ajax_request()) {
			 $response = ["text" => json_encode( [
		        	"data" => $this->AppSettingsModel->getReloadCredictId($this->input->post())])];
		        $this->load->view("app/response/text", $response);
		} else {
			$this->session->sess_destroy();
	      	redirect('/','auto');
		}
		
	}

	
	public function putReload(){
		if ($this->input->is_ajax_request()) {
			if (self::dataReload()) {
				$response = ["text" => json_encode( [
		        	"data" => $this->AppSettingsModel->putReload($this->input->post())])];
		        $this->load->view("app/response/text", $response);
			} else {
				self::errorValidation();
			}
		} else {
			$this->session->sess_destroy();
	      	redirect('/','auto');
		}
	}
	

}

/* End of file AppSettingsController.php */
/* Location: ./application/controllers/app/AppSettingsController.php */