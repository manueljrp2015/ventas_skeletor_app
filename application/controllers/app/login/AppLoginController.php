<?php

/**
 *
 */
class appLoginController extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model([
      "app/login/appLoginModel"
    ]);
  }

  public function indexLogin(){
    $this->load->view("app/template/index_template_login");
  }

  protected function errorValidation()
  {
    $response = ["text" => validation_errors()];
    $this->load->view("app/response/text", $response);
  }

  protected function inputRulesLogin()
  {
    $this->form_validation->set_rules('user', 'user', 'required|trim|xss_clean');
    $this->form_validation->set_rules('password', 'password', 'required|trim|xss_clean');
    return $this->form_validation->run();
  }

  public function signUp(){
    
    if($this->input->is_ajax_request()){
      if(self::inputRulesLogin()){
        $process = $this->appLoginModel->sigUpSession($this->input->post());
        $response = ["text" => $process];
        $this->load->view("app/response/text", $response);
      }
      else {
        self::errorValidation();
      }
    }
    else
    {
      $this->session->sess_destroy();
      redirect('/','auto');

    }
    
  }


  protected function inputRulesForgotPass()
  {
    $this->form_validation->set_rules('u', 'u', 'required|trim|xss_clean');
    return $this->form_validation->run();
  }

  public function forgotPass()
  {
    if($this->input->is_ajax_request()){
      if (self::inputRulesForgotPass()) {
        $process = $this->appoAuthModel->recoverPassword($this->input->post());
        $response = ["text" => $process];
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
