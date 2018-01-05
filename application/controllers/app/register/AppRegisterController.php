<?php

/**
 *
 */
class appRegisterController extends Ci_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model([
      'app/register/appRegisterModel',
      'app/catalogs/appCatalogsModel'
    ]);
  }

  public function indexRegister()
  {
    $data = [
      'listTypeAccount' => $this->appCatalogsModel->getTypeAccountUser(),
      'country' => $this->appCatalogsModel->getCountry()
    ];
    $this->load->view("app/template/index_template_register", $data);
  }

  protected function errorValidation()
  {
    $response = ["text" => validation_errors()];
    $this->load->view("app/response/text", $response);
  }

  protected function inputRulesRegister()
  {

    $this->form_validation->set_rules('user', 'user', 'trim|required|xss_clean');
    $this->form_validation->set_rules('email', 'email', 'trim|required|xss_clean');
    $this->form_validation->set_rules('password', 'password', 'trim|required|xss_clean');
    $this->form_validation->set_rules('rpassword', 'rpassword', 'trim|required|xss_clean');
    $this->form_validation->set_rules('typeAccount', 'typeAccount', 'trim|required|xss_clean');


    return $this->form_validation->run();
  }



  public function store()
  {
    if($this->input->is_ajax_request()){
      if(self::inputRulesRegister()){
        $this->appRegisterModel->store($this->input->post());
        $response = ["text" => true];
        $this->load->view("app/response/text", $response);
      }
      else {
        self::errorValidation();
      }
    }
    else{
      $this->session->sess_destroy();
      redirect('/','auto');
    }
    
  }

}
