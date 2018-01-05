<?php


class appPaymentController extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->appoAuthModel->oauthChecked();
		$this->load->model([
			"app/payment/appPaymentModel"
			]);
	}

	protected function errorValidation()
  	{
	    $response = ["text" => validation_errors()];
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
			        	"data" => $this->appPaymentModel->savePay($file, $this->input->post())
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

	public function indexPay(){

		$this->appMonitorModel->putRecord(["user" => $this->session->userdata("id") ,"process" => "ha ingresado al modulo pagos"]);	

		$data = [
			"folder"           => "pay",
			"file"             => "pay",
			"pays"        => $this->appPaymentModel->getPay(),
	
	    ];

	    $this->load->view("app/template/index_template_app", $data);
	

	}
}