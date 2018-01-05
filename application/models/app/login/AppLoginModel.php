<?php

/**
 *
 */
class appLoginModel extends CI_Model
{

  private $apptb_user = "tbapp_registeruser_app";

  function __construct()
  {
    parent::__construct();
    $this->load->model([
      "app/oauth/appoAuthModel"
    ]);
  }

  public function sigUpSession($data)
  {
    $quser = $this->db->where("_nickname", strtolower($data["user"]))
    ->or_where("_mail", strtolower($data["user"]))
    ->get($this->apptb_user)
    ->row();

    if($quser){
      if($quser->_user_status === "ac"){
        if (password_verify($data["password"], $quser->_key)) {
          if($quser->_relacionship_store == null){
            return "empty-store";
          }
          else{
              $this->appoAuthModel->oauthAutorizedSesion($quser);
              return "d";
          }
        }
        else {
          return "badpass";
        }
      }
      elseif ($quser->_user_status === "in") {
        return "i";
      }
      elseif ($quser->_user_status === "block") {
        return "b";
      }
      else {
        return "error";
      }
    }
    else {
      return FALSE;
    }
  }
}
