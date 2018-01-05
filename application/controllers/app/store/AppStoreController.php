<?php


/**
* 
*/
class appStoreController extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->appoAuthModel->oauthChecked();
		$this->load->model([
			"app/store/appStoreModel",
			"app/catalogs/appCatalogsModel"
			]);
	}

	protected function errorValidation()
  	{
	    $response = ["text" => validation_errors()];
	    $this->load->view("app/response/text", $response);
  	}

	public function indexStore(){

		$this->appMonitorModel->putRecord(["user" => $this->session->userdata("id") ,"process" => "ha ingresado al modulo tienda de productos"]);	
		$data = [
			"folder"    => "store",
			"file"      => "index",
			"listStore" => $this->appCatalogsModel->getStoreNew(),
			"listProd" => $this->appStoreModel->findProductAll(),
	    ];

	    $this->load->view("app/template/index_template_app", $data);
	
	}


	public function findProductStoreAllLimit(){

		
		 $response = array(
            "text" => json_encode( $this->appStoreModel->findProductStoreAllLimit(
            	$this->input->get("start"), $this->input->get("end"), $this->input->get("store"))));
		$this->load->view("app/response/text", $response);

	}


	public function findProductForName(){

		 $response = array(
            "text" => json_encode( $this->appStoreModel->findProductForName($this->input->get("query"), $this->input->get("store"))));
		$this->load->view("app/response/text", $response);

	}

	public function findOrderPending(){

		 $response = array(
            "text" => json_encode( ["list" => $this->appStoreModel->findOrderPending(),
            	"count" => $this->appStoreModel->getCountOrderPending()]));
		$this->load->view("app/response/text", $response);
	}


	public function findProductStore(){

		
		 $response = array(
            "text" => json_encode([
                "status" => TRUE,
                "error"  => NULL,
                "data"   => [
                    'user' => $this->appStoreModel->findProductStore($this->input->get("query"))
                ]
            ])
        );
		$this->load->view("app/response/text", $response);

	}

	protected function dataProductOrder(){

		$this->form_validation->set_rules('sku', 'sku', 'trim|required|xss_clean');
		$this->form_validation->set_rules('cant', 'cant', 'trim|required|xss_clean');
		$this->form_validation->set_rules('precio', 'precio', 'trim|required|xss_clean');
		$this->form_validation->set_rules('store', 'store', 'trim|required|xss_clean');
		$this->form_validation->set_rules('producto_id', 'producto_id', 'trim|required|xss_clean');
		return $this->form_validation->run();
	}

	public function putProductOrder(){

		if ($this->input->is_ajax_request()) {
			if (self::dataProductOrder()) {
				 $response = array(
            		"text" => json_encode( $this->appStoreModel->putProductOrder($this->input->post())));
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