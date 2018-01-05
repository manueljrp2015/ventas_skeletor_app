<?php
header('Access-Control-Allow-Origin: *');
/**
* 
*/
class appUserAdminController extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->appoAuthModel->oauthChecked();
		$this->load->model([
	      "app/user/appUserModel",
	      "app/user/appUserAdminModel",
	      "app/catalogs/appCatalogsModel",
	      "app/functions/appFunctionsModel"
	    ]);
	}

	protected function errorValidation()
  	{
	    $response = ["text" => validation_errors()];
	    $this->load->view("app/response/text", $response);
  	}

	public function indexUserAdmin()
  	{

      $this->appMonitorModel->putRecord(["user" => $this->session->userdata("id") ,"process" => "consulto informacion de la tienda ".$this->input->post("store").", en el modulo gestión de usuarios"]); 

	    $data = [
        "folder"          => "userAdmin",
        "file"            => "user-admin",
        "typeid"          => $this->appCatalogsModel->getTypeId(),
        "country"         => $this->appCatalogsModel->getCountry(),
        'typeAccount'     => $this->appCatalogsModel->getTypeAccount(),
        'listStore'       => $this->appCatalogsModel->getStoreNew(),
        "list_user_admin" => $this->appUserAdminModel->getListUserAdmin()
	    ];

	    $this->load->view("app/template/index_template_app", $data);
  	}


  	public function getInfoUserAdmin()
  	{
  		if ($this->input->is_ajax_request()) {
	        $response = ["text" => json_encode($this->appUserAdminModel->getInfoUserAdmin($this->input->get()),JSON_FORCE_OBJECT)];
	        $this->load->view("app/response/text", $response);
  		} else {
  			$this->session->sess_destroy();
      		redirect('/','auto');
  		}
  		
  	}

  	protected function inputDataUser()
  {
    $this->form_validation->set_rules('_first_name', '_first_name', 'trim|required|xss_clean');
    $this->form_validation->set_rules('_last_name', '_last_name', 'trim|required|xss_clean');
    $this->form_validation->set_rules('_idn', '_idn', 'trim|required|xss_clean');
    $this->form_validation->set_rules('_birthday', '_birthday', 'trim|required|xss_clean');
    $this->form_validation->set_rules('_phone', '_phone', 'trim|required|xss_clean');
    $this->form_validation->set_rules('_website', '_website', 'trim|xss_clean');
    $this->form_validation->set_rules('_instagram', '_instagram', 'trim|xss_clean');
    $this->form_validation->set_rules('_facebook', '_facebook', 'trim|xss_clean');
    $this->form_validation->set_rules('_twitter', '_twitter', 'trim|xss_clean');
    $this->form_validation->set_rules('_linkedin', '_linkedin', 'trim|xss_clean');
    $this->form_validation->set_rules('_youtube', '_youtube', 'trim|xss_clean');
    $this->form_validation->set_rules('_vimeo', '_vimeo', 'trim|xss_clean');
    $this->form_validation->set_rules('_mail', '_mail', 'trim|required|xss_clean');
    $this->form_validation->set_rules('email_other', 'email_other', 'trim|required|xss_clean');
    $this->form_validation->set_rules('_username', '_username', 'trim|required|xss_clean');
    $this->form_validation->set_rules('idu', 'idu', 'trim|required|xss_clean');
    return $this->form_validation->run();
  }

  public function storeData()
  {
  	if ($this->input->is_ajax_request()) {
  		if (self::inputDataUser()) {
  			$this->appUserAdminModel->storeData($this->input->post());
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

  protected function inputRulesRegister()
  {

    $this->form_validation->set_rules('user', 'user', 'trim|required|xss_clean');
    $this->form_validation->set_rules('email', 'email', 'trim|required|xss_clean');
    $this->form_validation->set_rules('password', 'password', 'trim|required|xss_clean');
    $this->form_validation->set_rules('rpassword', 'rpassword', 'trim|required|xss_clean');
    $this->form_validation->set_rules('typeAccount', 'typeAccount', 'trim|required|xss_clean');
    $this->form_validation->set_rules('_store[]', '_store[]', 'trim|required|xss_clean');

    return $this->form_validation->run();
  }


  public function store()
  {
    if ($this->input->is_ajax_request()) {
      if (self::inputRulesRegister()) {
        $this->appUserAdminModel->store($this->input->post(), $this->input->post("_store"));
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


  public function asignedStoreForUser()
  {
    if ($this->input->is_ajax_request()) {
        $response = ["text" => $this->appUserAdminModel->asignedStoreForUser($this->input->post(), $this->input->post("_stores"))];
        $this->load->view("app/response/text", $response);   
    } else {
      $this->session->sess_destroy();
        redirect('/','auto');
    }
    
  }


  public function getStoreForUser()
    {
      if ($this->input->is_ajax_request()) {
            $response = ["text" => $this->appUserAdminModel->getStoreForUser($this->input->get())];
            $this->load->view("app/response/text", $response);
        
      } else {
        $this->session->sess_destroy();
          redirect('/','auto');
      }
    }

  	

  	public function changeKeyAdmin()
  	{
  		if ($this->input->is_ajax_request()) {
  			
  				$this->appUserAdminModel->changeKeyAdmin($this->input->get());
		        $response = ["text" => true];
		        $this->load->view("app/response/text", $response);
  			
  		} else {
  			$this->session->sess_destroy();
      		redirect('/','auto');
  		}
  	}

  	public function blockUser()
  	{
  		if ($this->input->is_ajax_request()) {
		    $response = ["text" => json_encode(["response" => $this->appUserAdminModel->blockUser($this->input->get())],JSON_FORCE_OBJECT)];
		       $this->load->view("app/response/text", $response);
  		} else {
  			$this->session->sess_destroy();
      		redirect('/','auto');
  		}
  		
  	}
}