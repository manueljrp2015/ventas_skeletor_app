<?php

/**
* 
*/
class appCartController extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->appoAuthModel->oauthChecked();
		$this->load->model([
			"app/cart/appCartModel",
			"app/catalogs/appCatalogsModel",
			"app/store/appStoreModel",
			"app/transactions/appTransactionsModel"
			]);
	}


	protected function errorValidation()
  	{
	    $response = ["text" => validation_errors()];
	    $this->load->view("app/response/text", $response);
  	}

  	public function indexCart(){

		$this->appMonitorModel->putRecord(["user" => $this->session->userdata("id") ,"process" => "ha ingresado al modulo carrtio de compra"]);	

		

		$data = [
			"folder"           => "cart",
			"file"             => "cart",
			"listStore"        => $this->appCatalogsModel->getStoreNew(),
	
	    ];

	    $this->load->view("app/template/index_template_app", $data);
	
	}


	public function getListCart(){

		 $response = array(
            "text" => json_encode([
            	"list" => $this->appCartModel->getListOrderPendig($this->input->get("store")), 
            	"paycond" => $this->appStoreModel->getPaymentConditionsForStore($this->input->get("store"))
            	]));
		$this->load->view("app/response/text", $response);
	}

	public function updateCart(){

		 $response = array(
            "text" => json_encode( $this->appCartModel->updateCart($this->input->get())));
		$this->load->view("app/response/text", $response);
	}

	public function deleteItemsCart(){

		 $response = array(
            "text" => json_encode( $this->appCartModel->deleteItemsCart($this->input->get())));
		$this->load->view("app/response/text", $response);
	}

	public function orderCourier(){

		$this->appMonitorModel->putRecord(["user" => $this->session->userdata("id") ,"process" => "ingreso a configurar datos de envio del pedido ".$this->input->get("order")]);	

		$order = $this->appCartModel->getOrder($this->input->get("order"));

		if($order->_according == "Y" || $order->_according == NULL){
			redirect(URL_WEB.'mi-carrito/','auto');
		}
		else{
			$data = [
			"folder"       => "cart",
			"file"         => "cart-courier",
			"resumenOrder" => $order
	    	];
		}
		
	    $this->load->view("app/template/index_template_app", $data);
	
	}
}