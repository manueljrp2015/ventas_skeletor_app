<?php

/**
* 
*/
class appBusinessController extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->appoAuthModel->oauthChecked();
		$this->load->model([
	      "app/business/appBusinessModel",
	      "app/functions/appFunctionsModel"
	    ]);
	}

	protected function errorValidation()
  	{
	    $response = ["text" => validation_errors()];
	    $this->load->view("app/response/text", $response);
  	}

  
	public function indexBusinnes()
	{
		$data = [
			"folder"   => "business",
			"file"     => "index",
			"business" => $this->appBusinessModel->getBusiness()
	    ];

	    $this->load->view("app/template/index_template_app", $data);
  
	}

	protected function inputDataUser()
  	{
	    $this->form_validation->set_rules('_razon', '_razon', 'trim|required|xss_clean');
	    $this->form_validation->set_rules('_rif', '_rif', 'trim|required|xss_clean');
	    $this->form_validation->set_rules('_encargado', '_encargado', 'trim|required|xss_clean');
	    $this->form_validation->set_rules('_dir', '_dir', 'trim|required|xss_clean');
	    $this->form_validation->set_rules('_mail', '_mail', 'trim|required|xss_clean');
	    $this->form_validation->set_rules('_phone1', '_phone1', 'trim|required|xss_clean');
	    $this->form_validation->set_rules('_phone2', '_phone2', 'trim|xss_clean');

	    return $this->form_validation->run();
  	}

  	public function storeBusiness()
  	{
  		if ($this->input->is_ajax_request()) {
  			if (self::inputDataUser()) {
  				$this->appBusinessModel->storeBusiness($this->input->post());
        		$response = ["text" => true];
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