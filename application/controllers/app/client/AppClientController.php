<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AppClientController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->appoAuthModel->oauthChecked();
		$this->load->model([
			"app/client/appClientModel",
			'app/catalogs/appCatalogsModel',
			'app/functions/appFunctionsModel',
			]);
	}

	protected function errorValidation()
  	{
	    $response = ["text" => validation_errors()];
	    $this->load->view("app/response/text", $response);
  	}

	public function indexStoreCreate()
	{
		$dashboard = "index";
   
	    $data = [
			"folder"     => "client",
			"file"       => "store-create",
			"stores"     => $this->appClientModel->getStores(),
			'listGiros'  => $this->appCatalogsModel->getGiros(),
			'listPais'   => $this->appCatalogsModel->getPais(),
			'listRegion' => $this->appCatalogsModel->getRegion(),
			'listPriceStore' => $this->appCatalogsModel->getRegion(),
			'listRegion' => $this->appCatalogsModel->getRegion(),
	    ];

	    $this->load->view("app/template/index_template_app", $data);
	}

	public function getStoreId(){
		if ($this->input->is_ajax_request()) {
			 $response = ["text" => json_encode( [
		        	"data" => $this->appClientModel->getStoreId($this->input->get('id'))])];
		        $this->load->view("app/response/text", $response);
		} else {
			$this->session->sess_destroy();
	      	redirect('/','auto');
		}
	}


	protected function dataStore(){
		$this->form_validation->set_rules('_store_2', '_store', 'trim|required|xss_clean');
		$this->form_validation->set_rules('_rut_2', '_rut', 'trim|required|xss_clean');
		$this->form_validation->set_rules('_email_2', '_email', 'trim|required|xss_clean');
		$this->form_validation->set_rules('_phone_2', '_phone', 'trim|required|xss_clean');
		$this->form_validation->set_rules('id_2', 'id', 'trim|required|xss_clean');

		return $this->form_validation->run();
	}


	public function updateStore(){
		if ($this->input->is_ajax_request()) {
			if (self::dataStore()) {
				$response = ["text" => json_encode( [
		        	"data" => $this->appClientModel->updateStore($this->input->post())])];
		        $this->load->view("app/response/text", $response);
			} else {
				self::errorValidation();
			}
		} else {
			$this->session->sess_destroy();
	      	redirect('/','auto');
		}
	}

	protected function dataPutStore(){

		$this->form_validation->set_rules('_rut', '_rut', 'trim|required|xss_clean');
		$this->form_validation->set_rules('_name', '_name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('_phone', '_phone', 'trim|required|xss_clean');
		$this->form_validation->set_rules('_email', '_email', 'trim|required|xss_clean');
		$this->form_validation->set_rules('_dir', '_dir', 'trim|required|xss_clean');
		$this->form_validation->set_rules('_credit', '_credit', 'trim|xss_clean');
		$this->form_validation->set_rules('_type_pay', '_type_pay', 'trim|xss_clean');
		$this->form_validation->set_rules('_form_pay', '_form_pay', 'trim|xss_clean');
		$this->form_validation->set_rules('_factor', '_factor', 'trim|required|xss_clean');
		$this->form_validation->set_rules('_razon_real', '_razon_real', 'trim|xss_clean');
		$this->form_validation->set_rules('dirfact', 'dirfact', 'trim|xss_clean');
		$this->form_validation->set_rules('dirdesp', 'dirdesp', 'trim|xss_clean');
		$this->form_validation->set_rules('giro', 'giro', 'trim|xss_clean');
		$this->form_validation->set_rules('pais', 'pais', 'trim|xss_clean');
		$this->form_validation->set_rules('region', 'region', 'trim|xss_clean');
		$this->form_validation->set_rules('ciudad', 'ciudad', 'trim|xss_clean');
		$this->form_validation->set_rules('comuna', 'comuna', 'trim|xss_clean');
		$this->form_validation->set_rules('_band', '_band', 'trim|xss_clean');
		$this->form_validation->set_rules('_region_c', '_region_c', 'trim|required|xss_clean');

		return $this->form_validation->run();

	}

	public function putStore(){
		if ($this->input->is_ajax_request()) {
			if (self::dataPutStore()) {
				$response = ["text" => json_encode( [
		        	"data" => $this->appClientModel->putStore($this->input->post())])];
		        $this->load->view("app/response/text", $response);
			} else {
				self::errorValidation();
			}
		} else {
			$this->session->sess_destroy();
	      	redirect('/','auto');
		}
		
	}

	public function verifyRut(){
		$response = ["text" => json_encode( [
		        	"data" => $this->appFunctionsModel->verifyExistRut($this->input->post())])];
		$this->load->view("app/response/text", $response);
	} 

	public function getCatalogsCountry(){
					$response = ["text" => json_encode([
					"comuna" => $this->appCatalogsModel->getComuna($this->input->get("id")),
					"ciudad" => $this->appCatalogsModel->getCiudad($this->input->get("id"))
		        	], JSON_FORCE_OBJECT)];
		$this->load->view("app/response/text", $response);
	}

	public function getGiroRelationship(){
		$response = ["text" => json_encode( [
		        	"data" => $this->appClientModel->getGiroRelationship($this->input->get())])];
		$this->load->view("app/response/text", $response);
	}


	public function getClientUpdate(){
		$response = ["text" => json_encode( [
		        	"data" => $this->appClientModel->getClientUpdate($this->input->get('id'))])];
		$this->load->view("app/response/text", $response);
	} 


	public function updateStoreComplete(){
		if ($this->input->is_ajax_request()) {
			if (self::dataPutStore()) {
				$response = ["text" => json_encode( [
		        	"data" => $this->appClientModel->updateStoreComplete($this->input->post())])];
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

/* End of file AppClientController.php */
/* Location: ./application/controllers/app/client/AppClientController.php */