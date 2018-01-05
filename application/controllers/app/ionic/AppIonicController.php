<?php
defined('BASEPATH') OR exit('No direct script access allowed');
  if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
 
        exit(0);
    }

class AppIonicController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model([
            "app/ionic/AppIonicModel",
            "app/analysis/appAnalysisModel"
			]);
	}

	public function getAuthorized()
    {
      header('Content-Type: application/json');
      $response = ["text" => json_encode($this->AppIonicModel->getAuthorized($this->input->get()))];
          $this->load->view("app/response/text", $response);
    }

    protected function dataRecovery(){
    	$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email|xss_clean');
    	return $this->form_validation->run();
    }

    public function recoveryAuthorized(){
    	header('Content-Type: application/json');
    		$response = ["text" => json_encode($this->AppIonicModel->recoveryAuthorized($this->input->get()), JSON_FORCE_OBJECT)];
            $this->load->view("app/response/text", $response);
    }

    public function getApiIonicUserInfoId()
    {
      header('Content-Type: application/json');
      $response = ["text" => json_encode($this->AppIonicModel->getApiIonicInfoUserId($this->uri->segment(2)))];
          $this->load->view("app/response/text", $response);
    }

    /*
    |
    |
    | DATA VIEJA
    |
    |*/

    public function geMyStoreOld(){
    	header('Content-Type: application/json');
    	$response = ["text" => json_encode($this->AppIonicModel->geMyStoreOld($this->input->get()))];
            $this->load->view("app/response/text", $response);
    }

    public function geMyStoreForFree(){
    	header('Content-Type: application/json');
    	$response = ["text" => json_encode($this->AppIonicModel->geMyStoreForFree($this->input->get()))];
            $this->load->view("app/response/text", $response);
    }

    public function unLockedStore(){
        header('Content-Type: application/json');
        $response = ["text" => json_encode($this->AppIonicModel->unLockedStore($this->input->get()))];
            $this->load->view("app/response/text", $response);
    }

    public function getAnalisisStore(){
          $response = ["text" => json_encode(
            [
            "data"      => $this->AppIonicModel->getAnalisisStore(),
            "analysis"  => $this->AppIonicModel->getSaleForWeek(),
            "weekname"  => ["week" => date("W")]
            ])];

    $this->load->view("app/response/text", $response);
  }

  public function getListPricesStore(){
        header('Content-Type: application/json');
        $response = ["text" => json_encode($this->AppIonicModel->getListPricesStore($this->input->get()))];
            $this->load->view("app/response/text", $response);
    }

     public function changePrice(){
        header('Content-Type: application/json');
        $response = ["text" => json_encode($this->AppIonicModel->changePrice($this->input->get()))];
            $this->load->view("app/response/text", $response);
    }

     public function activateProduct(){
        header('Content-Type: application/json');
        $response = ["text" => json_encode($this->AppIonicModel->activateProduct($this->input->get()))];
            $this->load->view("app/response/text", $response);
    }
 

}

/* End of file AppIonicController.php */
/* Location: ./application/controllers/app/ionic/AppIonicController.php */