<?php

/**
* 
*/
class appBusinessAdminController extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->appoAuthModel->oauthChecked();
		$this->load->model([
	      "app/business/appBusinessAdminModel",
	      "app/functions/appFunctionsModel"
	    ]);
	}

	protected function errorValidation()
  	{
	    $response = ["text" => validation_errors()];
	    $this->load->view("app/response/text", $response);
  	}

  	public function indexBusinnesAdm()
	{
		$data = [
	      "folder"    => "business",
	      "file"      => "index-adm",
	      "list_business_admin" => $this->appBusinessAdminModel->getListBusiness()
	    ];

	    $this->load->view("app/template/index_template_app", $data);
  
	}

	public function informationBusiness()
	{
		if ($this->input->is_ajax_request()) {
			$response = ["text" => json_encode($this->appBusinessAdminModel->getInformationBusiness($this->input->get()),JSON_FORCE_OBJECT)];
	        $this->load->view("app/response/text", $response);
		} else {
			$this->session->sess_destroy();
      		redirect('/','auto');
		}
	}

	public function getActivateBusiness()
	{
		if ($this->input->is_ajax_request()) {
			$response = ["text" => json_encode($this->appBusinessAdminModel->activateBusiness($this->input->get()),JSON_FORCE_OBJECT)];
	        $this->load->view("app/response/text", $response);
		} else {
			$this->session->sess_destroy();
      		redirect('/','auto');
		}
		
	}

	public function getConfigBusiness()
	{
		if ($this->input->is_ajax_request()) {
			$response = ["text" => json_encode($this->appBusinessAdminModel->getConfigBusiness($this->input->get()),JSON_FORCE_OBJECT)];
	        $this->load->view("app/response/text", $response);
		} else {
			$this->session->sess_destroy();
      		redirect('/','auto');
		}
		
	}

	protected function inputBusinessCfg()
	{
		$this->form_validation->set_rules('_minbuy', '_minbuy', 'trim|required|xss_clean');
	    $this->form_validation->set_rules('_maxbuy', '_maxbuy', 'trim|required|xss_clean');
	    $this->form_validation->set_rules('group1', 'group1', 'trim|required|xss_clean');
	    $this->form_validation->set_rules('group2', 'group2', 'trim|xss_clean');

	    return $this->form_validation->run();
	}

	public function storeBusinessCfg()
	{
		if ($this->input->is_ajax_request()) {
			if (self::inputBusinessCfg()) {
				$this->appBusinessAdminModel->storeBusinessCfg($this->input->post());
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

  	public function updateBusinessExec()
  	{
  		if ($this->input->is_ajax_request()) {
  			if (self::inputDataUser()) {
  				$this->appBusinessAdminModel->updateBusiness($this->input->post());
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

  	public function blockBusiness()
  	{
  		if ($this->input->is_ajax_request()) {

	  		$this->form_validation->set_rules('_phone2', '_phone2', 'trim|xss_clean');
		    if ($this->form_validation->run()) {
        		$response = ["text" => json_encode($this->appBusinessAdminModel->blockBusiness($this->input->post(),JSON_FORCE_OBJECT))];
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