<?php


/**
* 
*/
class appMonitorModel extends CI_Model
{
	private $tb = "tbapp_monitoring";

	function __construct()
	{
		parent::__construct();
	}


	public function putRecord($data){
		$this->db->insert($this->tb,[
			"_ip"          => $this->input->ip_address() ,
			" _plataform " => $this->agent->browser()." / ".$this->agent->version()." / ".$this->agent->platform(),
			"_user_id"     =>  $this->session->userdata("id"),
			"_process"     => $data["process"]
			]);
	}
	
}