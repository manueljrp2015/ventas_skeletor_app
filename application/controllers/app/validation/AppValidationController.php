<?php

/**
 *
 */
class appValidationController extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model("app/validations/appValidationsModel");
  }

  public function validateUser(){

    if($this->input->is_ajax_request()){
      $user = $this->input->post("username");
      $response = ["text" => ($this->appValidationsModel->validationUser($user) ? $text = "false" : $text = " true")];
      $this->load->view("app/response/text", $response);
    }
    else{
      $this->session->sess_destroy();
      redirect('/','auto');
    }
    
  }

  public function validateEmail(){

    if($this->input->is_ajax_request()){
      $email = $this->input->post("email");
      $response = ["text" => ($this->appValidationsModel->validationEmail($email) ? $text = "false" : $text = " true")];
      $this->load->view("app/response/text", $response);
    }
    else{
      $this->session->sess_destroy();
      redirect('/','auto');
    }
  }

  public function validateEmailRecovery(){

    if($this->input->is_ajax_request()){
      $email = $this->input->post("email_other");
      $response = ["text" => ($this->appValidationsModel->validationEmailRecovery($email) ? $text = "false" : $text = " true")];
      $this->load->view("app/response/text", $response);
    }
    else{
      $this->session->sess_destroy();
      redirect('/','auto');
    }
  }

  public function validateIdb(){

    if($this->input->is_ajax_request()){
      $idb = $this->input->post("idb");
      $response = ["text" => ($this->appValidationsModel->validationIdb($idb) ? $text = "false" : $text = " true")];
      $this->load->view("app/response/text", $response);
    }
    else{
      $this->session->sess_destroy();
      redirect('/','auto');
    }
  }

  public function errorTemplate(){
     $this->load->view("app/error/error_template");
  }
}