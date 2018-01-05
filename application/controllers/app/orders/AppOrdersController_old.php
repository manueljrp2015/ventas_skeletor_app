<?php

/**
* 
*/
class appOrdersController extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->appoAuthModel->oauthChecked();
		$this->load->model([
			"app/orders/appOrdersModel",
			'app/catalogs/appCatalogsModel'
			]);
	}

	protected function errorValidation()
  	{
	    $response = ["text" => validation_errors()];
	    $this->load->view("app/response/text", $response);
  	}

  	protected function dataStore(){
  		$this->form_validation->set_rules('store', 'store', 'trim|required|xss_clean');
  		return $this->form_validation->run();
  	}



	public function index(){

 	$this->appMonitorModel->putRecord(["user" => $this->session->userdata("id") ,"process" => "ha ingresado al modulo de aprobacion de tiendas para pedido"]);	
	$data = [
			"folder"   => "orders",
			"file"     => "orders-approve",
			'listStore' => $this->appOrdersModel->getStoreForFree(),
	    ];

	    $this->load->view("app/template/index_template_app", $data);
	}

	public function findStore(){
		if ($this->input->is_ajax_request()) {
			if (self::dataStore()) {

		        $response = ["text" => json_encode( [
					"listRazon"    => $this->appOrdersModel->getRazonForStore($this->input->post()),
					"listRazonNum" => $this->appOrdersModel->getRazonForNumStore($this->input->post()),
					"verify"       => $this->appOrdersModel->verifyPendingOrder($this->input->post()),
					"analisis"     => $this->appOrdersModel->getAnalisysStoreOrders($this->input->post()),
					"list"         => $this->appOrdersModel->getStoreOrders($this->input->post())])];
		        $this->load->view("app/response/text", $response);

 				$this->appMonitorModel->putRecord(["user" => $this->session->userdata("id") ,"process" => "consulto informacion de la tienda ".$this->input->post("store").", en el modulo cambio de estado"]);	

			} else {
				self::errorValidation();
			}
			
		} else {
			$this->session->sess_destroy();
      		redirect('/','auto');
		}
		
	}

	public function freeOrder(){
		if ($this->input->is_ajax_request()) {
			if (self::dataStore()) {
		        $response = ["text" => json_encode( [
		        	"data" => $this->appOrdersModel->freeStoreOrder($this->input->post())])];
		        $this->load->view("app/response/text", $response);
			} else {
				self::errorValidation();
			}
			
		} else {
			$this->session->sess_destroy();
      		redirect('/','auto');
		}
	}

	protected function dataStoreNew(){
		$this->form_validation->set_rules('store', 'store', 'trim|required|xss_clean');
		$this->form_validation->set_rules('nstore', 'nstore', 'trim|required|xss_clean');
		$this->form_validation->set_rules('rut', 'rut', 'trim|required|xss_clean');
		$this->form_validation->set_rules('send', 'send', 'trim|required|xss_clean');
		$this->form_validation->set_rules('ramal', 'ramal', 'trim|xss_clean');
		$this->form_validation->set_rules('ccost', 'ccost', 'trim|required|xss_clean');

		$this->form_validation->set_rules('dirfact', 'dirfact', 'trim|xss_clean');
		$this->form_validation->set_rules('dirdesp', 'dirdesp', 'trim|xss_clean');
		$this->form_validation->set_rules('emailcontacto', 'emailcontacto', 'trim|xss_clean');
		$this->form_validation->set_rules('emaildte', 'emaildte', 'trim|xss_clean');
		$this->form_validation->set_rules('giro', 'giro', 'trim|xss_clean');
		$this->form_validation->set_rules('pais', 'pais', 'trim|xss_clean');
		$this->form_validation->set_rules('region', 'region', 'trim|xss_clean');
		$this->form_validation->set_rules('ciudad', 'ciudad', 'trim|xss_clean');
		$this->form_validation->set_rules('comuna', 'comuna', 'trim|xss_clean');

  		return $this->form_validation->run();
	}


	public function storeTempIndex(){
		$this->appMonitorModel->putRecord(["user" => $this->session->userdata("id") ,"process" => "ingreso a el modulo Creacion de tiendas"]);
		$data = [
			"folder"          => "orders",
			"file"            => "store-temp",
			'centerc'         => $this->appOrdersModel->getCenterCost(),
			'listStore'       => $this->appOrdersModel->getStorewidthProducts(),
			'listStoreFree'   => $this->appOrdersModel->getStoreFreeProducts(),
			'listStoreActive' => $this->appOrdersModel->getStoreActive(),
			'listGiros'       => $this->appCatalogsModel->getGiros(),
			'listPais'        => $this->appCatalogsModel->getPais(),
			'listRegion'      => $this->appCatalogsModel->getRegion(),
	    ];

	    $this->load->view("app/template/index_template_app", $data);
	}

	public function putStore(){
		if ($this->input->is_ajax_request()) {
			if (self::dataStoreNew()) {
		        $response = ["text" => json_encode( [
		        	"data" => $this->appOrdersModel->putStore($this->input->post())])];
		        $this->load->view("app/response/text", $response);
			} else {
				self::errorValidation();
			}
		} else {
			$this->session->sess_destroy();
      		redirect('/','auto');
		}
		
	}

	public function verifyUserKey(){
		$response = ["text" => json_encode( [
		        	"data" => $this->appOrdersModel->verifyUserKey($this->input->get())])];
		$this->load->view("app/response/text", $response);

	} 

	public function verifyRut(){
		$response = ["text" => json_encode( [
		        	"data" => $this->appOrdersModel->verifyRut($this->input->post())])];
		$this->load->view("app/response/text", $response);
	} 

	public function getGiroRelationship(){
		$response = ["text" => json_encode( [
		        	"data" => $this->appOrdersModel->getGiroRelationship($this->input->get())])];
		$this->load->view("app/response/text", $response);
	} 


	public function verifyUser(){

		 if($this->input->is_ajax_request()){
	      $username = $this->input->post("user");
	      $response = ["text" => ($this->appOrdersModel->verifyUser($username) ? $text = "false" : $text = " true")];
	      $this->load->view("app/response/text", $response);
	    }
	    else{
	      $this->session->sess_destroy();
	      redirect('/','auto');
	    }
	} 

	public function getCatalogsCountry(){
					$response = ["text" => json_encode([
					"comuna" => $this->appCatalogsModel->getComuna($this->input->get("id")),
					"ciudad" => $this->appCatalogsModel->getCiudad($this->input->get("id"))
		        	], JSON_FORCE_OBJECT)];
		$this->load->view("app/response/text", $response);
	}

	public function verifyEmail(){

		 if($this->input->is_ajax_request()){
	      $email = $this->input->post("email");
	      $response = ["text" => ($this->appOrdersModel->verifyEmail($email) ? $text = "false" : $text = " true")];
	      $this->load->view("app/response/text", $response);
	    }
	    else{
	      $this->session->sess_destroy();
	      redirect('/','auto');
	    }

	} 


	protected function dataStoreUser(){

		$this->form_validation->set_rules('store_id', 'store_id', 'trim|required|xss_clean');
		$this->form_validation->set_rules('user', 'user', 'trim|required|xss_clean');
		$this->form_validation->set_rules('pass', 'pass', 'trim|required|xss_clean');
		$this->form_validation->set_rules('email', 'email', 'trim|required|xss_clean');
		$this->form_validation->set_rules('nombre', 'nombre', 'trim|required|xss_clean');
		$this->form_validation->set_rules('key', 'key', 'trim|required|xss_clean');
		$this->form_validation->set_rules('ubicacion', 'ubicacion', 'trim|required|xss_clean');
		$this->form_validation->set_rules('storetp', 'storetp', 'trim|required|xss_clean');
  		return $this->form_validation->run();
	}

	public function putUserStore(){
		if ($this->input->is_ajax_request()) {
			if (self::dataStoreUser()) {
		        $response = ["text" => json_encode( [
		        	"data" => $this->appOrdersModel->putUserStore($this->input->post())])];
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
	| Lista de Productos
	|
	|
	*/

	public function getAnalisisListProduct(){

		$response = ["text" => json_encode( [
			"analisis" => $this->appOrdersModel->getAnalisisListProducts($this->input->get()),
			"list"     => $this->appOrdersModel->getListProductsStore($this->input->get())])];
		$this->load->view("app/response/text", $response);
	}

	protected function dataStoreList(){
		$this->form_validation->set_rules('store_id_3', 'store_id_3', 'trim|required|xss_clean');
		$this->form_validation->set_rules('store_id_4', 'store_id_4', 'trim|required|xss_clean');
  		return $this->form_validation->run();
	}


	public function processChargeList(){
		if ($this->input->is_ajax_request()) {
			if (self::dataStoreList()) {
				$response = ["text" => json_encode( [
		        	"data" => $this->appOrdersModel->processChargeList($this->input->post())])];
		        $this->load->view("app/response/text", $response);
			} else {
				self::errorValidation();
			}
			
		} else {
			$this->session->sess_destroy();
      		redirect('/','auto');
		}
		
	}


	public function uploadFileExcelList(){

		$file = "public/files/excel/".date("Ymdhms")."-".$_FILES["fileexcel"]["name"];

		if (move_uploaded_file($_FILES["fileexcel"]["tmp_name"], $file)) {

			$response = ["text" => json_encode( [
		        	"data" => $this->appOrdersModel->readExcelListProduct($file, $this->input->post("id_store"))])];
		    $this->load->view("app/response/text", $response);

		} else {
			# code...
		}
		
	}

	protected function dataStorePrice(){
		$this->form_validation->set_rules('tienda', 'tienda', 'trim|required|xss_clean');
  		return $this->form_validation->run();
	}

	public function inPriceStore(){
		if ($this->input->is_ajax_request()) {
			if (self::dataStorePrice()) {
				$response = ["text" => json_encode( [
		        	"data" => $this->appOrdersModel->inPriceStore($this->input->post())])];
		        $this->load->view("app/response/text", $response);
			} else {
				self::errorValidation();
			}
			
		} else {
			$this->session->sess_destroy();
      		redirect('/','auto');
		}
	}

	public function deleteProd(){
		if ($this->input->is_ajax_request()) {
				$response = ["text" => json_encode( [
		        	"data" => $this->appOrdersModel->deleteProd($this->input->post())])];
		        $this->load->view("app/response/text", $response);	
		} else {
			$this->session->sess_destroy();
      		redirect('/','auto');
		}
	}

	public function getCountryTnt(){
		$response = ["text" => json_encode( [
		        	"data" => $this->appCatalogsModel->getCountryTnt()])];
		        $this->load->view("app/response/text", $response);	
	}

	public function getPuebloTnt(){
		$response = ["text" => json_encode( [
		        	"data" => $this->appCatalogsModel->getPuebloTnt($this->input->get())])];
		        $this->load->view("app/response/text", $response);	
	}

	public function getCostTnt(){
		$response = ["text" => json_encode( [
		        	"data" => $this->appCatalogsModel->getCostTnt($this->input->get())])];
		        $this->load->view("app/response/text", $response);	
	}

	protected function dataUpStorePrice(){
		$this->form_validation->set_rules('tienda', 'tienda', 'trim|required|xss_clean');
  		return $this->form_validation->run();
	}

	public function upPriceStore(){
		if ($this->input->is_ajax_request()) {
			if (self::dataUpStorePrice()) {
				$response = ["text" => json_encode( [
		        	"data" => $this->appOrdersModel->upPriceStore($this->input->post())])];
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
	|
	| relaciones de usuarios
	|
	|
	*/


	public function relationshipsUserIndex(){

		

		$data = [
			"folder"          => "orders",
			"file"            => "relationships-user",
			'listStoreActive' => $this->appOrdersModel->getStoreActive(),
			'listUserActive'  => $this->appOrdersModel->getUserActive(),
	    ];

	    $this->load->view("app/template/index_template_app", $data);
	}


	public function processChangeUser(){

		if ($this->input->is_ajax_request()) {
			$response = ["text" => json_encode( [
		        	"data" => $this->appOrdersModel->processChangeUser($this->input->post())])];
		        $this->load->view("app/response/text", $response);
		} else {
			$this->session->sess_destroy();
      		redirect('/','auto');
		}
		
	}

	/*
	|
	|
	| cambios de estados en pedidos
	|
	|
	*/


	public function stateOrdersIndex(){

		$data = [
			"folder"          => "orders",
			"file"            => "orders-states",
			'listStore' => $this->appOrdersModel->getStoreForFree(),
			'listState' => $this->appOrdersModel->getListStateAcept(),
	    ];

	    $this->load->view("app/template/index_template_app", $data);
	}


	public function indexChangeTime(){

 
	$data = [
			"folder"   => "orders",
			"file"     => "orders-approve-time",
			'listStoreTimes' => $this->appOrdersModel->getListStoreTimes(),
	    ];

	    $this->load->view("app/template/index_template_app", $data);
	}


	public function changeStateTime(){

		if ($this->input->is_ajax_request()) {
			$response = ["text" => json_encode( [
		        	"data" => $this->appOrdersModel->changeStateTime($this->input->post())])];
		        $this->load->view("app/response/text", $response);
		} else {
			$this->session->sess_destroy();
      		redirect('/','auto');
		}
		
	}

	public function changeStateLote(){

		if ($this->input->is_ajax_request()) {
			$response = ["text" => json_encode( [
		        	"data" => $this->appOrdersModel->changeStateLote($this->input->post("idstore"))])];
		        $this->load->view("app/response/text", $response);
		} else {
			$this->session->sess_destroy();
      		redirect('/','auto');
		}
	}

	
}