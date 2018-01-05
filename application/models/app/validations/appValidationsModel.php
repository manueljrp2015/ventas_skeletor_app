<?php

/**
 *
 */
class appValidationsModel extends CI_Model
{

  private $apptb_user       = "tbapp_registeruser_app";
  private $table_user_other = "tbapp_registeruser_app_other_info";
  private $table_business   = " tbapp_business";

  public function validationUser($user){
    return $this->db->where('_nickname', $user)->get($this->apptb_user)->row();
  }

  public function validationEmail($email){
    return $this->db->where('_mail', $email)->get($this->apptb_user)->row();
  }

  public function validationEmailRecovery($email){
    return $this->db->where('_mail_recovery', $email)->get($this->table_user_other)->row();
  }

  public function validationIdb($idb){
    return $this->db->where('_idb', $idb)->get($this->table_business)->row();
  }

}

 ?>
