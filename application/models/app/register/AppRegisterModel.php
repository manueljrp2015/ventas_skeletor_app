<?php

/**
 *
 */
class appRegisterModel extends CI_Model
{

  private $apptb_user = "tbapp_registeruser_app";
  private $table_user_other = "tbapp_registeruser_app_other_info";

  function __construct()
  {
    parent::__construct();
    $this->load->model([
      "app/functions/appFunctionsModel"
    ]);
  }

  protected function dataRegisterNewUser($data)
  {
    return [
      "_nickname"   => strtolower($data["user"]),
      "_mail"       => strtolower($data["email"]),
      "_key"        => $this->appFunctionsModel->hashPassword($data["password"]),
      "_account_id" => 7,
      "_store_id"   => $data["typeAccount"],
      "_country_id" => 2,
    ];
  }

  protected function dataRegisterOtherInfo($id)
  {
    return [
      "_IDUser" => $id,
      "_phone"  => "000-0000000"
    ];
  }

  public function store($data)
  {
    $this->db->insert($this->apptb_user, self::dataRegisterNewUser($data));
    $id = $this->db->insert_id();
    $this->db->insert($this->table_user_other, self::dataRegisterOtherInfo($id));
    $this->appEmailsModel->emailWelcome($data);

    return TRUE;
  }


}
