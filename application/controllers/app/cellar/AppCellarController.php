<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AppCellarController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->appoAuthModel->oauthChecked();
		$this->load->model([
			"app/cellar/AppCellarModel",
			'app/catalogs/AppCatalogsModel',
			"app/product/AppProductModel",
			"app/tnt/appTntModel"
			]);
	}

	protected function errorValidation()
  	{
	    $response = ["text" => validation_errors()];
	    $this->load->view("app/response/text", $response);
  	}

	public function index()
	{
	    $data = [
	      "folder"    => "cellar",
	      "file"      => "cellar-order"
	    ];

	    $this->load->view("app/template/index_template_app", $data);
	}

	public function indexCellarPicking()
	{
	    $data = [
	      "folder"    => "cellar",
	      "file"      => "cellar-picking",
	      "listStore" => $this->AppCatalogsModel->getStoreNew(),
	    ];

	    $this->load->view("app/template/index_template_app", $data);
	}

	public function indexCellarVerify()
	{
	    $data = [
	      "folder"    => "cellar",
	      "file"      => "cellar-verify",
	      "listStore" => $this->AppCatalogsModel->getStoreNew(),
	    ];

	    $this->load->view("app/template/index_template_app", $data);
	}

	public function indexCellarTransport()
	{
	    $data = [
	      "folder"    => "cellar",
	      "file"      => "cellar-transport"
	    ];

	    $this->load->view("app/template/index_template_app", $data);
	}

	public function deleteItemOrder(){

		 $response = array(
            "text" => json_encode( ["list" => $this->AppCellarModel->deleteItemOrder($this->input->post("id"), $this->input->post("order"))]));
		$this->load->view("app/response/text", $response);
	}

	public function getPurchasesForStore(){
		$response = array(
            "text" => json_encode([
				"list"    => $this->AppCellarModel->getPurchasesForStore(), 
				"summary" => $this->AppCellarModel->getPurchasesSummaryForStore()
            	]));
		$this->load->view("app/response/text", $response);
	}

	public function getCourierOrder(){
		$response = array(
            "text" => json_encode([
				"data"    => $this->AppCellarModel->getCourierOrder($this->input->get())
            	]));
		$this->load->view("app/response/text", $response);
	}

	public function getItemOrder(){
		$response = array(
            "text" => json_encode([
				"data"    => $this->AppCellarModel->getItemOrder($this->input->get())
            	]));
		$this->load->view("app/response/text", $response);
	}

	public function getTimeLine(){
		$response = array(
            "text" => json_encode([
				"data"    => $this->AppCellarModel->getTimeLine($this->input->get())
            	]));
		$this->load->view("app/response/text", $response);
	}

	public function getComment(){
		$response = array(
            "text" => json_encode([
				"data"    => $this->AppCellarModel->getComment($this->input->get())
            	]));
		$this->load->view("app/response/text", $response);
	}

	public function getOrderState(){
		$response = array(
            "text" => json_encode([
				"data"    => $this->AppCellarModel->getOrderState($this->input->post())
            	]));
		$this->load->view("app/response/text", $response);
	}

	public function changeState(){
		$response = array(
            "text" => json_encode([
				"data"    => $this->AppCellarModel->changeState($this->input->post())
            	]));
		$this->load->view("app/response/text", $response);
	}


	protected function dataUpdate(){

		$this->form_validation->set_rules('n', 'n', 'trim|required|xss_clean');
		$this->form_validation->set_rules('v', 'v', 'trim|required|xss_clean');
		$this->form_validation->set_rules('orden', 'orden', 'trim|required|xss_clean');
		$this->form_validation->set_rules('id', 'id', 'trim|required|xss_clean');
		$this->form_validation->set_rules('store', 'store', 'trim|required|xss_clean');
		$this->form_validation->set_rules('pid', 'pid', 'trim|required|xss_clean');
		return $this->form_validation->run();
	}

	public function updateOrder(){
		if ($this->input->is_ajax_request()) {
			if (self::dataUpdate()) {
				 $response = array(
            		"text" => json_encode( $this->AppCellarModel->updateOrder($this->input->post())));
				$this->load->view("app/response/text", $response);
			} else {
				self::errorValidation();
			}
			
		} else {
			$this->session->sess_destroy();
      		redirect('/','auto');
		}
	}

	public function getListProduct(){
		 $response = array(
            "text" => json_encode( ["list" => $this->AppProductModel->getProductList()]));
		$this->load->view("app/response/text", $response);
	}

	protected function dataInclude(){
		$this->form_validation->set_rules('sku', 'sku', 'trim|required|xss_clean');
		$this->form_validation->set_rules('_product_id', '_product_id', 'trim|required|xss_clean');
		$this->form_validation->set_rules('cantidad', 'cantidad', 'trim|required|xss_clean');
		$this->form_validation->set_rules('tienda', 'tienda', 'trim|required|xss_clean');
		$this->form_validation->set_rules('order', 'order', 'trim|required|xss_clean');

		return $this->form_validation->run();
	}



	public function includeProduct(){
		if ($this->input->is_ajax_request()) {
			if (self::dataInclude()) {
				 $response = array(
            		"text" => json_encode( $this->AppCellarModel->includeProduct($this->input->post())));
				$this->load->view("app/response/text", $response);
			} else {
				self::errorValidation();
			}
			
		} else {
			$this->session->sess_destroy();
      		redirect('/','auto');
		}
	}


	protected function dataCalculate(){
		$this->form_validation->set_rules('_ancho', '_ancho', 'trim|xss_clean');
		$this->form_validation->set_rules('_largo', '_largo', 'trim|xss_clean');
		$this->form_validation->set_rules('_alto', '_alto', 'trim|xss_clean');
		$this->form_validation->set_rules('_peso_m', '_peso_m', 'trim|xss_clean');
		$this->form_validation->set_rules('_total', '_total', 'trim|xss_clean');
		$this->form_validation->set_rules('_store_id', '_store_id', 'trim|required|xss_clean');
		$this->form_validation->set_rules('_order_id', '_order_id', 'trim|required|xss_clean');

		return $this->form_validation->run();
	}

	public function calculateTntManual(){
		if ($this->input->is_ajax_request()) {
			if (self::dataCalculate()) {
				$response = array(
            		"text" => json_encode( $this->appTntModel->calculateTntManual(
            			$this->input->post("_ancho"),
            			$this->input->post("_largo"),
            			$this->input->post("_alto"),
            			$this->input->post("_peso"),
            			$this->input->post("_store_id")
            		)));
				$this->load->view("app/response/text", $response);
			} else {
				self::errorValidation();
			}
			
		} else {
			$this->session->sess_destroy();
      		redirect('/','auto');
		}
		
	}

	public function asignedTransportManual(){
		if ($this->input->is_ajax_request()) {
			if (self::dataCalculate()) {
				$response = array(
            		"text" => json_encode( $this->AppCellarModel->asignedTransportManual(
            			$this->input->post()
            		)));
				$this->load->view("app/response/text", $response);
			} else {
				self::errorValidation();
			}
			
		} else {
			$this->session->sess_destroy();
      		redirect('/','auto');
		}
		
	}

	/*
	|
	|	CELLAR PICKING AREA
	|
	|*/


	public function indexPicking()
	{
		$this->appFunctionsModel->changeStateGeneric([
			"order_id" => $this->input->get("order"),
			"state"    => 5
		]);

		

		$this->AppCellarModel->saveInfoPicking($this->input->get());

	    $data = [
	      "folder"    => "picking",
	      "file"      => "index"
	    ];

	    $this->load->view("app/template/index_template_only_body", $data);
	}


	public function getOrderForPicking(){
		$response = array(
            "text" => json_encode([
				"data"    => $this->AppCellarModel->getOrderForPicking($this->input->post())
            	]));
		$this->load->view("app/response/text", $response);
	}

	public function getItemOrderForPicking(){
		$response = array(
            "text" => json_encode([
				"data"    => $this->AppCellarModel->getItemOrderForPicking($this->input->get()),
				"sumary"  => $this->AppCellarModel->getSumaryPicking($this->input->get())
            	]));
		$this->load->view("app/response/text", $response);
	}

	protected function dataPicking(){
		$this->form_validation->set_rules('_code', '_code', 'trim|required|xss_clean');
		return $this->form_validation->run();
	}

	public function pickingOrder(){
		if ($this->input->is_ajax_request()) {
			if (self::dataPicking()) {
				$response = array(
            		"text" => json_encode( $this->AppCellarModel->pickingOrder(
            			$this->input->post()
            		)));
				$this->load->view("app/response/text", $response);
			} else {
				self::errorValidation();
			}
			
		} else {
			$this->session->sess_destroy();
      		redirect('/','auto');
		}
		
	}

	public function changeStateGeneric(){

		$action = $this->input->get_post("action");

		if($action == "verify"){
			$this->db->set('_end', 'NOW()', FALSE);
			$this->db->where(["_order_id" => $this->input->get_post("order")])->update("tbapp_order_verify", []);
		}
		else if($action == "picking"){
			$this->db->set('_end', 'NOW()', FALSE);
			$this->db->where(["_order_id" => $this->input->get_post("order")])->update("tbapp_order_picking", []);
		}
		
		$response = array(
            		"text" => json_encode($this->appFunctionsModel->changeStateGeneric([
						"order_id" => $this->input->get_post("order"),
						"state"    => $this->input->get_post("state")
					])));
		$this->load->view("app/response/text", $response);
	}

	/*
	|
	|	CELLAR VERIFY AREA
	|
	|*/


	public function indexVerify()
	{
		$this->appFunctionsModel->changeStateGeneric([
			"order_id" => $this->input->get("order"),
			"state"    => 7
		]);

		

		$this->AppCellarModel->saveInfoVerify($this->input->get());

	    $data = [
	      "folder"    => "verify",
	      "file"      => "index"
	    ];

	    $this->load->view("app/template/index_template_only_body", $data);
	}


	public function getOrderForVerify(){
		$response = array(
            "text" => json_encode([
				"data"    => $this->AppCellarModel->getOrderForVerify($this->input->post())
            	]));
		$this->load->view("app/response/text", $response);
	}

	public function getItemOrderForVerify(){
		$response = array(
            "text" => json_encode([
				"data"    => $this->AppCellarModel->getItemOrderForVerify($this->input->get()),
				"sumary"  => $this->AppCellarModel->getSumaryVerify($this->input->get())
            	]));
		$this->load->view("app/response/text", $response);
	}

	protected function dataVerify(){
		$this->form_validation->set_rules('_code', '_code', 'trim|required|xss_clean');
		return $this->form_validation->run();
	}

	public function verifyOrder(){
		if ($this->input->is_ajax_request()) {
			if (self::dataVerify()) {
				$response = array(
            		"text" => json_encode( $this->AppCellarModel->verifyOrder(
            			$this->input->post()
            		)));
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

/* End of file AppCellarController.php */
/* Location: ./application/controllers/app/cellar/AppCellarController.php */