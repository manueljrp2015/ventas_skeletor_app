<?php

/**
* 
*/
class appBusinessAdminModel extends CI_Model
{
	private $table        = 'tbapp_business';
	private $table_config = 'tbapp_business_config';
	private $table_block  = 'tbapp_business_block';

	function __construct()
	{
		parent::__construct();
		$this->appoAuthModel->oauthChecked();
	}

	public function getListBusiness()
	{
		return $this->db->query("
			SELECT
				bus.id,
				bus._business,
				bus._codepin,
				bus._create_at,
				bus._direcction,
				bus._idb,
				bus._IDUser,
				bus._mail,
				bus._member,
				bus._phone1,
				bus._phone2,
				bus._status_business,
				bus._update_at,
				u._nickname,
				CONCAT(
					o._firts_name,
					' ',
					o._last_name
				) AS name_user
			FROM
				tbapp_business AS bus
			LEFT JOIN tbapp_registeruser_app AS u ON u.id = bus._IDUser
			LEFT JOIN tbapp_registeruser_app_other_info AS o ON o._IDUser = bus._IDUser;
			")->result();
	}

	public function getConfigBusiness($data)
	{
		return $this->db->query("
			SELECT
				bus.id,
				bus._business,
				bus._idb,
				bus._mail,
				cfg._minbuy,
				cfg._maxbuy,
				cfg._daybuy,
				cfg._frequency
			FROM
				tbapp_business AS bus
			LEFT JOIN tbapp_registeruser_app AS u ON u.id = bus._IDUser
			LEFT JOIN tbapp_registeruser_app_other_info AS o ON o._IDUser = bus._IDUser
			LEFT JOIN tbapp_business_config AS cfg ON cfg._IDBusiness = bus.id
			WHERE
				bus.id = ".$data["id"]." ;
			")->row();
	}

	public function getInformationBusiness($data)
	{
		return $this->db->query("
			SELECT
				bus.id,
				bus._business,
				bus._codepin,
				bus._create_at,
				bus._direcction,
				bus._idb,
				bus._IDUser,
				bus._mail,
				bus._member,
				bus._phone1,
				bus._phone2,
				bus._status_business,
				bus._update_at,
				u._nickname,
				CONCAT(
					o._firts_name,
					' ',
					o._last_name
				) AS name_user,
				cfg._minbuy,
				cfg._maxbuy,
				cfg._daybuy,
				cfg._frequency
			FROM
				tbapp_business AS bus
			LEFT JOIN tbapp_registeruser_app AS u ON u.id = bus._IDUser
			LEFT JOIN tbapp_registeruser_app_other_info AS o ON o._IDUser = bus._IDUser
			LEFT JOIN tbapp_business_config AS cfg ON cfg._IDBusiness = bus.id
			WHERE
				bus.id = ".$data["id"]." ;
			")->row();
	}

	public function activateBusiness($data)
	{
		$idb = $this->db->where(["id" => $data['id']])->get($this->table)->row();
		if ($idb) {
			if ($idb->_codepin == null) {
			 $codepin = $this->appFunctionsModel->generateCodePinBusiness($data, $idb->_idb);
			 $this->db->where(["id" => $data['id']])->update($this->table,["_codepin" => $codepin, "_status_business" => 'ac']);
			 $this->appEmailsModel->mailActivateBusiness($idb->_mail,$idb->_codepin);
			 return ["response" => "done", "code" => $codepin];
			} else {
				$this->appEmailsModel->mailActivateBusiness($idb->_mail,$idb->_codepin);
				return ["response" => "exist", "code" => $idb->_codepin];
			}
			
		} else {
			return "no-exist";
		}
		
	}

	protected function dataCfg($data){

		$serialize = [
			"_minbuy"    => $data['_minbuy'],
			"_maxbuy"    => $data['_maxbuy'],
			"_daybuy"    => $data['group1'],
			"_frequency" => $data['group2']
		];

		return [
			"_values"     => serialize($serialize),
			"_minbuy"     => $data['_minbuy'],
			"_maxbuy"     => $data['_maxbuy'],
			"_daybuy"     => $data['group1'],
			"_frequency"  => $data['group2'],
			"_IDBusiness" => $data['_IDBusiness']
		];
	}

	public function storeBusinessCfg($data)
	{
		$query = $this->db->where(["_IDBusiness" => $data["_IDBusiness"]])->get($this->table_config)->row();
		if ($query) {
			$this->db->where(["_IDBusiness" => $data["_IDBusiness"]])->update($this->table_config,self::dataCfg($data));
			$this->appEmailsModel->mailConfigBusiness($data['_mails'],$data);
		} else {
			$this->appEmailsModel->mailConfigBusiness($data['_mails'],$data);
			$this->db->insert($this->table_config,self::dataCfg($data));
		}
		
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

	public function updateBusiness($data)
	{
			$this->db->set('_update_at', 'NOW()', FALSE);
			$this->db->where(["id" => $data['_IDBusiness2']])->update($this->table, self::dataBusiness($data));
	}

	public function blockBusiness($data)
	{
		$query = $this->db->where(["id" => $data['_IDBusiness3']])->get($this->table)->row();
		if($query->_status_business == 'block')
		{
			$this->db->where(["id" => $data['_IDBusiness3']])->update($this->table,["_status_business" => "pend"]);
			$this->appEmailsModel->mailunBlockBusiness($data['_mails2']);
			return ["response" => "unblock"];
		}
		else
		{
			$this->db->insert($this->table_block, [
				"_IDBusiness"    => $data['_IDBusiness3'],
				"_block_content" => $data["msg"]
				]);
				$id = $this->db->insert_id();
				$this->db->where(["id" => $data['_IDBusiness3']])->update($this->table,["_status_business" => "block", "_IDBlock" => $id]);
				$this->appEmailsModel->mailBlockBusiness($data['_mails2'],$data["msg"]);
				return ["response" => "block"];
		}
	}
}