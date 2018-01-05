<?php

/**
* 
*/
class appFileProcessModel extends CI_Model
{
	private $tb_user_info;
	private $dbf;
	
	function __construct()
	{
		parent::__construct();
		$this->dbf = $this->load->database('franquisia', TRUE);
		$this->tb_user_info = "tbapp_registeruser_app_other_info";
	}

	public function setAvatarUser($avatar)
	{
		$q = $this->db->where(["_IDUser" => $this->session->userdata("id")])->get($this->tb_user_info)->row();
		if ($q) {
			$update_avatar = [
				"_avatar"       => $avatar,
				"_avatar_thumb" => $avatar,
			];
			$this->db->where(["_IDUser" => $this->session->userdata("id")])->update($this->tb_user_info, $update_avatar);
		} else {
			return FALSE;
		}
		
	}

	public function setFileBdStore($file){
		return $this->db->insert("tbbapp_files_store",[
			"_file"     =>  $file["name"],
			"_type"     =>  $file["type"],
			"_origin"   =>  $file["origin"],
			"_store_id" =>  $file["store"],
			"_send "    =>  serialize([])
			]);
	}
}