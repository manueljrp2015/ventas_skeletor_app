<?php

/**
 *
 */
class appUserModel extends CI_Model
{

	private $table_user = "tbapp_registeruser_app";
	private $table_user_other = "tbapp_registeruser_app_other_info";

  public function __construct()
  {
    parent::__construct();
    $this->load->model([
      "app/functions/appFunctionsModel"
      ]);
  }

  public function getInformationUser(){

  	return $this->db->query("
  		SELECT
			usr._mail,
			usr._account_id,
			usr._country_id,
			usr._nickname,
			usr._user_status,
			userinfo._firts_name,
			userinfo._identity,
			userinfo._IDTypeid,
			userinfo._IDUser,
			userinfo._last_name,
			userinfo._social,
      userinfo._mail_recovery,
			DATE_FORMAT(userinfo._birthday,'%d-%m-%Y') as _birthday,
			userinfo._website,
			userinfo._phone,
      userinfo._avatar,
      userinfo._avatar_thumb,
			country._codephone,
			country._country,
			country._prefix,
			typeaccount._account,
			typeid._typeid,
			typeid._prefix_typeid
		FROM
			tbapp_registeruser_app AS usr
		LEFT JOIN tbapp_registeruser_app_other_info AS userinfo ON userinfo._IDUser = usr.id
		LEFT JOIN tbapp_country AS country ON country.id = usr._country_id
		LEFT JOIN tbapp_type_account AS typeaccount ON typeaccount.id = usr._account_id
		LEFT JOIN tbapp_typeid AS typeid ON typeid.id = userinfo._IDTypeid
		WHERE
			usr.id = ".$this->session->userdata('id').";
  		")->row();
  }

  public function getAvatar()
  {
    return $this->getInformationUser()->_avatar;
  }

  public function getAvatarThumb()
  {
    return $this->getInformationUser()->_avatar_thumb;
  }

  public function getFirtsName()
  {
    return $this->getInformationUser()->_firts_name;
  }

  public function getLastName()
  {
    return $this->getInformationUser()->_last_name;
  }

  public function getFullName()
  {
    return $this->getInformationUser()->_firts_name." ".$this->getInformationUser()->_last_name;
  }

  public function getEmail()
  {
    return $this->getInformationUser()->_mail;
  }

  /*------------------------------------------------------------------------------*/

  protected function dataInfoUser($data)
  {
  	$social = [
        "_instagram" => ($data["_instagram"] != null) ? $data["_instagram"] : "",
        "_facebook"  => ($data["_facebook"] != null) ? $data["_facebook"] : "",
        "_twitter"   => ($data["_twitter"] != null) ? $data["_twitter"] : "",
        "_linkedin"  => ($data["_linkedin"] != null) ? $data["_linkedin"] : "",
        "_youtube"   => ($data["_youtube"] != null) ? $data["_youtube"] : "",
        "_vimeo"     => ($data["_vimeo"] != null) ? $data["_vimeo"] : "",
  		];

  		$date = new DateTime($data["_birthday"]);
		$date->format('Y-m-d H:i:s');

  		return [
        "_firts_name" => $data["_first_name"],
        "_last_name"  => $data["_last_name"],
        "_IDTypeid"   => $data["_typeid"],
        "_identity"   => $data["_idn"],
        "_website"    => $data["_website"],
        "_social"     => serialize($social),
        "_birthday"   => $date->format('Y-m-d H:i:s'),
        "_phone"      => $data["_phone"],
  		];
  }


  public function storeData($data)
  {
  	$que = $this->db->get_where($this->table_user_other, ["_IDUser" => $this->session->userdata("id")]);
  	if (!$que) {

  		$this->db->insert($this->table_user_other, self::dataInfoUser($data));

  	} else {

  		$this->db->set('_update_at', 'NOW()', FALSE);
  		$this->db->where(["_IDUser" => $this->session->userdata("id")])->update($this->table_user_other, self::dataInfoUser($data));

  		$this->db->set('_update_at', 'NOW()', FALSE);
  		$this->db->where(["id" => $this->session->userdata("id")])->update($this->table_user,["_country_id" => $data["_countryid"]]);

  		$this->session->unset_userdata('country_id');
  		$this->session->set_userdata('country_id', $data["_countryid"]);
  	}
  	
  }

  public function changeUser($data)
  {

  	$this->session->unset_userdata('nickname');
  	$this->session->set_userdata('nickname', strtolower($data["_username"]));

  	$this->db->where(["id" => $this->session->userdata("id")])->update($this->table_user,["_nickname" => strtolower($data["_username"])]);

    $this->appEmailsModel->emailChangeUser($this->getEmail(), strtolower($data["_username"]));

    return true;
  }

  public function changeKey($data)
  {
    $quser = $this->db->where(["id" => $this->session->userdata("id")])->get($this->table_user)->row();
    if ($quser) {
      if (password_verify($data["_pwd"], $quser->_key)) {

        $update_pass = [
          "_key" => $this->appFunctionsModel->hashPassword($data["_pwd_rpt"])
        ];
        $this->db->where(["id" => $this->session->userdata("id")])->update($this->table_user, $update_pass);
        $this->appEmailsModel->emailChangePassword($quser->_mail, $data["_pwd_rpt"]);
        return "d";
      } else {
        return "badpass";
      }
      
    } else {
      return 'no-exist';
    }
    
  }

  public function changeMail($data)
  {
    $this->session->unset_userdata('mail');
    $this->session->set_userdata('mail', strtolower($data["email_active"]));

    $this->db->where(["id" => $this->session->userdata("id")])
    ->update($this->table_user, ["_mail" => strtolower($data['email_active'])]);
    $this->appEmailsModel->emailChangeMail($data['email_active']);
    return true;
  }

  public function changeMailRecovery($data)
  {
    $this->db->where(["_IDUser" => $this->session->userdata("id")])
    ->update($this->table_user_other, ["_mail_recovery" => strtolower($data['email_other'])]);
    $this->appEmailsModel->emailChangeMailRecovery($data['email_active']);
    return true;
  }


}