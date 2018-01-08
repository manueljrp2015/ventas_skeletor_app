<?php


/**
* 
*/
class appTransactionsController extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();

		$this->load->model([
			"app/transactions/appTransactionsModel"
			]);
	}


	public function consolidateOrder(){
		if ($this->input->is_ajax_request()) {
			$response = ["text" => json_encode(["data" => $this->appTransactionsModel->consolidateOrder($this->input->get())])];
        	$this->load->view("app/response/text", $response);
		} else {
			$this->session->sess_destroy();
        	redirect('/','auto');
		}
	}

	public function saveCourierOrder(){
		if ($this->input->is_ajax_request()) {
			$response = ["text" => json_encode(["data" => $this->appTransactionsModel->saveCourierOrder($this->input->get())])];
        	$this->load->view("app/response/text", $response);
		} else {
			$this->session->sess_destroy();
        	redirect('/','auto');
		}
		
	}

	public function accordingOrder(){
		if ($this->input->is_ajax_request()) {
			$response = ["text" => json_encode(["data" => $this->appTransactionsModel->accordingOrder($this->input->get())])];
        	$this->load->view("app/response/text", $response);
		} else {
			$this->session->sess_destroy();
        	redirect('/','auto');
		}
	}

	public function updateBalanceStore(){
		
	}
}