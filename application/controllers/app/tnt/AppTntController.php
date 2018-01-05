<?php


/**
* 
*/
class appTntController extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model([
			"app/tnt/appTntModel"
			]);
	}

	public function calculateTnt(){
		if ($this->input->is_ajax_request()) {
			$response = ["text" => json_encode(["data" => $this->appTntModel->calculateTnt($this->input->get())])];
        	$this->load->view("app/response/text", $response);
		} else {
			$this->session->sess_destroy();
        	redirect('/','auto');
		}
		
	}

}