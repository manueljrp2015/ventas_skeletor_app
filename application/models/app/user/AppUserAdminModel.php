<?php

/**
* 
*/
class appUserAdminModel extends CI_Model
{
	private $table_user = "tbapp_registeruser_app";
	private $table_user_other = "tbapp_registeruser_app_other_info";
	private $dbf;
	
	function __construct()
	{
		parent::__construct();
		$this->dbf = $this->load->database('franquisia', TRUE);
		$this->load->model([
	      "app/functions/appFunctionsModel"
	    ]);
	}

	public function getListUserAdmin()
	{

	  	return $this->db->query("
	  		SELECT
	  			usr.id,
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
			LEFT JOIN tbapp_typeid AS typeid ON typeid.id = userinfo._IDTypeid;
	  		")->result();
  }

  public function getInfoUserAdmin($data)
	{

	  	return $this->db->query("
	  		SELECT
	  			usr.id,
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
				userinfo._mail_recovery,
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
				usr.id = ".$data['id']."
			;
	  		")->row();
  }

  public function changeKeyAdmin($data)
  {
    $quser = $this->db->where(["id" => $data['id']])->get($this->table_user)->row();
    if ($quser) {
      
      	$new_pass = $this->appFunctionsModel->generatePassword();
        $update_pass = [
          "_key" => $this->appFunctionsModel->hashPassword($new_pass)
        ];
        $this->db->where(["id" => $data['id']])->update($this->table_user, $update_pass);
        $this->appEmailsModel->emailRenewPassword($quser->_mail, $new_pass);
        return "d";
      

    } else {
      return 'no-exist';
    }
  }

  protected function dataInfoOtherUser($data)
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
				"_firts_name"    => $data["_first_name"],
				"_last_name"     => $data["_last_name"],
				"_identity"      => $data["_idn"],
				"_website"       => $data["_website"],
				"_social"        => serialize($social),
				"_birthday"      => $date->format('Y-m-d H:i:s'),
				"_phone"         => $data["_phone"],
				"_mail_recovery" => strtolower($data["email_other"]),
  		];
  }

  protected function dataInfoUser($data)
  {
  	return [
			"_nickname "   => strtolower($data['_username']),
			"_mail"        => strtolower($data['_mail']),
  	];
  }


  public function storeData($data)
  {
  	$this->db->set('_update_at', 'NOW()', FALSE);
  	$this->db->where(["_IDUser" => $data["idu"]])
  	->update($this->table_user_other, self::dataInfoOtherUser($data));

  	$this->db->set('_update_at', 'NOW()', FALSE);
  	$this->db->where(["id" => $data["idu"]])
  	->update($this->table_user, self::dataInfoUser($data));
  }

  public function blockUser($data)
  {
  	$q = $this->db->where(["id" => $data['id']])->get($this->table_user)->row();
  	if ($q) {
  		if ($q->_user_status === 'block') {
  			$this->db->where(["id" => $data['id']])->update($this->table_user,["_user_status" => 'ac']);
  			return "unblock";
  		} else {
  			$this->db->where(["id" => $data['id']])->update($this->table_user,["_user_status" => 'block']);
  			return "block";
  		}
  		
  	} else {
  		return "fail";
  	}
  	
  }

  protected function dataRegisterNewUser($data, $stores, $old_stores)
  {
    return [
		"_nickname"               => strtolower($data["user"]),
		"_mail"                   => strtolower($data["email"]),
		"_key"                    => $this->appFunctionsModel->hashPassword($data["password"]),
		"_account_id"             => 10,
		"_store_id"               => $data["typeAccount"],
		"_country_id"             => 2,
		"_relacionship_store"     => $stores,
		"_relacionship_store_old" => $old_stores,
    ];
  }

  protected function dataRegisterOtherInfo($id)
  {
    return [
      "_IDUser" => $id,
      "_phone"  => "000-0000000"
    ];
  }

  public function store($data, $stores)
  {

  	if(in_array("9999999", $stores))
  	{
  		if(count($stores) > 1 ){

  		$old_store = serialize(["*"]);
	  	$new_store = serialize(["*"]);

	    $this->db->insert($this->table_user, self::dataRegisterNewUser($data, $new_store, $old_store));
	    $id = $this->db->insert_id();
	    $this->db->insert($this->table_user_other, self::dataRegisterOtherInfo($id));

	    $this->appEmailsModel->emailWelcome($data);

  		}
  		else{

  			$old_store = serialize(["*"]);
		  	$new_store = serialize(["*"]);

		    $this->db->insert($this->table_user, self::dataRegisterNewUser($data, $new_store, $old_store));
		    $id = $this->db->insert_id();
		    $this->db->insert($this->table_user_other, self::dataRegisterOtherInfo($id));

		    $this->appEmailsModel->emailWelcome($data);

  		}
  	}
  	else{

  		for ($i=0; $i < count($stores); $i++) {
	  		$ar[] = $stores[$i];
	  	};

	  	$implode =  implode(",", $stores);
	  	$old_store = $this->getIdStoreOld($implode);
	  	$new_store = serialize($ar);

	    $this->db->insert($this->table_user, self::dataRegisterNewUser($data, $new_store, $old_store));
	    $id = $this->db->insert_id();
	    $this->db->insert($this->table_user_other, self::dataRegisterOtherInfo($id));
	    $this->appEmailsModel->emailWelcome($data);

	    return TRUE;
  	}
  }

  protected function dataUpdateStoreUser($stores, $old_stores)
  {
    return [
		"_relacionship_store"     => $stores,
		"_relacionship_store_old" => $old_stores,
    ];
  }

  public function asignedStoreForUser($data, $stores)
  {

  	if(in_array("9999999", $stores))
  	{
  		if(count($stores) > 1 ){

  		$old_store = serialize(["*"]);
	  	$new_store = serialize(["*"]);

	    $this->db->where(["id" => $data["_hidden_user"]])->update($this->table_user, self::dataUpdateStoreUser( $new_store, $old_store));

	    return TRUE;

  		}
  		else{

  			$old_store = serialize(["*"]);
	  		$new_store = serialize(["*"]);

  			$this->db->where(["id" => $data["_hidden_user"]])->update($this->table_user, self::dataUpdateStoreUser($new_store, $old_store));
  			return TRUE;
  		}
  	}
  	else{

  		for ($i=0; $i < count($stores); $i++) {
	  		$ar[] = $stores[$i];
	  	};

	  	$implode =  implode(",", $stores);
	  	$old_store = $this->getIdStoreOld($implode);
	  	$new_store = serialize($ar);

	    $this->db->where(["id" => $data["_hidden_user"]])->update($this->table_user, self::dataUpdateStoreUser($new_store, $old_store));

	    return TRUE;
  	}
  }

  public function getStoreForUser($data){

  	$q = $this->db->query("
  		SELECT
			*
		FROM
			tbapp_registeruser_app
		WHERE
			id = ".$data['id'].";
  		")->row();



  	if($q){

  		$use = unserialize($q->_relacionship_store);

  		if($q->_relacionship_store == null){
  			return  json_encode(["msg" => "empty"]);
  		}
  		else if($use[0] == "*"){
  			return  json_encode(["msg" => "all"]);
  		}
  		else{
  			$uns = unserialize($q->_relacionship_store);
  			$imp = implode(",", $uns);

  			$query = $this->db->query("SELECT
							id
							FROM
							tbapp_stores
							WHERE
							id in (".$imp.")")->result();

  			$querys = $this->db->query("SELECT
							*
							FROM
							tbapp_stores
							WHERE
							id in (".$imp.")")->result();

  			foreach ($query as $key => $value) {
  				$ar[] = $value->id;
  			}

  			$impl = implode(",", $ar);

  			return json_encode(["msg" => "done", "data" => $impl, "result" => $querys]);
  		}
  	}
  	else{
  		return  json_encode(["msg" => "empty"]);
  	}
  }

  public function getIdStoreOld($stores){

  	$query = $this->db->query("SELECT
				_refer_old
				FROM
				tbapp_stores
				WHERE
				id in(".$stores.")")->result();

  	foreach ($query as $key => $value) {
  		$qu = $this->dbf->query("SELECT id_tienda from tiendas where id_franquicia = '".$value->_refer_old."'")->row();
  		$aerr[] = $qu->id_tienda;
  	}

  	return serialize($aerr);
  }

}