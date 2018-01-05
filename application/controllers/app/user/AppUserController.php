<?php

/**
 *
 */

class appUserController extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->appoAuthModel->oauthChecked();
    $this->load->model([
      "app/user/appUserModel",
      "app/catalogs/appCatalogsModel",
      "app/functions/appFunctionsModel"
    ]);
  }

  public function indexMyAccount()
  {

    $data = [
      "folder"    => "user",
      "file"      => "myaccount",
      "typeid"    => $this->appCatalogsModel->getTypeId(),
      "country"   => $this->appCatalogsModel->getCountry(),
      "info_user" => $this->appUserModel->getInformationUser()
    ];

    $this->load->view("app/template/index_template_app", $data);
  }

  protected function errorValidation()
  {
    $response = ["text" => validation_errors()];
    $this->load->view("app/response/text", $response);
  }

  protected function inputDataUser()
  {
    $this->form_validation->set_rules('_first_name', '_first_name', 'trim|required|xss_clean');
    $this->form_validation->set_rules('_last_name', '_last_name', 'trim|required|xss_clean');
    $this->form_validation->set_rules('_typeid', '_typeid', 'trim|required|xss_clean');
    $this->form_validation->set_rules('_idn', '_idn', 'trim|required|xss_clean');
    $this->form_validation->set_rules('_birthday', '_birthday', 'trim|required|xss_clean');
    $this->form_validation->set_rules('_countryid', '_countryid', 'trim|required|xss_clean');
    $this->form_validation->set_rules('_phone', '_phone', 'trim|required|xss_clean');
    $this->form_validation->set_rules('_website', '_website', 'trim|xss_clean');
    $this->form_validation->set_rules('_instagram', '_instagram', 'trim|xss_clean');
    $this->form_validation->set_rules('_facebook', '_facebook', 'trim|xss_clean');
    $this->form_validation->set_rules('_twitter', '_twitter', 'trim|xss_clean');
    $this->form_validation->set_rules('_linkedin', '_linkedin', 'trim|xss_clean');
    $this->form_validation->set_rules('_youtube', '_youtube', 'trim|xss_clean');
    $this->form_validation->set_rules('_vimeo', '_vimeo', 'trim|xss_clean');

    return $this->form_validation->run();
  }

  public function storeData()
  {
    if($this->input->is_ajax_request()){
      if(self::inputDataUser()){
        $this->appUserModel->storeData($this->input->post());
        $response = ["text" => true];
        $this->load->view("app/response/text", $response);
      }
      else{
        self::errorValidation();
      }
    }
    else{
      $this->session->sess_destroy();
      redirect('/','auto');
    }
  }

  public function changeUser()
  {
    if($this->input->is_ajax_request()){
      $this->form_validation->set_rules('_username', '_username', 'trim|required|xss_clean');
      if($this->form_validation->run()){
        $this->appUserModel->changeUser($this->input->post());
        $response = ["text" => true];
        $this->load->view("app/response/text", $response);
      }
      else{
        self::errorValidation();
      }
    }
    else{
      $this->session->sess_destroy();
      redirect('/','auto');
    }
  }

  public function generateKey(){

    if($this->input->is_ajax_request()){
        $response = ["text" => json_encode(["key" => $this->appFunctionsModel->generatePassword()], JSON_FORCE_OBJECT)];
        $this->load->view("app/response/text", $response);
    }
    else{
      $this->session->sess_destroy();
      redirect('/','auto');
    }
  }

  public function changeKey()
  {
    if ($this->input->is_ajax_request()) {
      $this->form_validation->set_rules('_pwd', '_pwd', 'trim|required|xss_clean');
      $this->form_validation->set_rules('_pwd_new', '_pwd_new', 'trim|required|xss_clean');
      $this->form_validation->set_rules('_pwd_rpt', '_pwd_rpt', 'trim|required|xss_clean');
      if($this->form_validation->run()){
        $response = ["text" => $this->appUserModel->changeKey($this->input->post())];
        $this->load->view("app/response/text", $response);
      }
      else{
        self::errorValidation();
      }
    } else {
      $this->session->sess_destroy();
      redirect('/','auto');
    }
    
  }

  public function changeMail()
  {
    if ($this->input->is_ajax_request()) {
      $this->form_validation->set_rules('email_active', 'email_active', 'trim|required|xss_clean');
      if($this->form_validation->run()){
        $response = ["text" => $this->appUserModel->changeMail($this->input->post())];
        $this->load->view("app/response/text", $response);
      }
      else{
        self::errorValidation();
      }
    } else {
      $this->session->sess_destroy();
      redirect('/','auto');
    }
    
  }

  public function changeMailRecovery()
  {
    if ($this->input->is_ajax_request()) {
      $this->form_validation->set_rules('email_other', 'email_other', 'trim|required|xss_clean');
      if($this->form_validation->run()){
        $response = ["text" => $this->appUserModel->changeMailRecovery($this->input->post())];
        $this->load->view("app/response/text", $response);
      }
      else{
        self::errorValidation();
      }
    } else {
      $this->session->sess_destroy();
      redirect('/','auto');
    }
    
  }
}
