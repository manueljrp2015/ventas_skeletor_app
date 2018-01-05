<?php

/**
* 
*/
class appBusinessModel extends CI_Model
{
	private $table = 'tbapp_business';
	function __construct()
	{
		parent::__construct();
		$this->appoAuthModel->oauthChecked();
	}

	protected function dataBusiness($data)
	{
		return [
			"_IDUser"     => $this->session->userdata('id'),
			"_business"   => strtolower($data['_razon']),
			"_idb"        => strtoupper($data['_rif']),
			"_direcction" => ucwords($data['_dir']),
			"_member"     => strtolower($data['_encargado']),
			"_mail"       => strtolower($data['_mail']),
			"_phone1"     => $data['_phone1'],
			"_phone2"     => $data['_phone2'],
		];
	}

	public function storeBusiness($data)
	{
		$q = $this->db->where(["_IDUser" => $this->session->userdata('id')])->get($this->table)->row();
		if ($q) {
			$this->db->set('_update_at', 'NOW()', FALSE);
			$this->db->where(["_IDUser" => $this->session->userdata('id')])->update($this->table, self::dataBusiness($data));
		} else {
			$this->db->insert($this->table, self::dataBusiness($data));
			$this->appEmailsModel->emailRegisterBusiness($data);
		}
		
	}

	public function getBusiness()
	{
		$query = $this->db->where(["_IDUser" => $this->session->userdata('id')])->get($this->table)->row();
		return ($query) ? $query : NULL;
	}

	public function getName()
	{
		return (isset($this->getBusiness()->_business)) ? $this->getBusiness()->_business : null;
	}

	public function getPinCode()
	{
		return (isset($this->getBusiness()->_codepin)) ? $this->getBusiness()->_codepin : null;
	}

	public function getIdb()
	{
		return (isset($this->getBusiness()->_idb)) ? $this->getBusiness()->_idb : null;
	}

	public function getStatus()
	{
		return (isset($this->getBusiness()->_status_business)) ? $this->getBusiness()->_status_business : null;
	}

	public function getFullName()
	{
		return $this->getBusiness()->_codepin." - ".$this->getBusiness()->_business." ".$this->getBusiness()->_idb;
	}


}