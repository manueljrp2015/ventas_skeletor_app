<?php

/**
* 
*/
class appInventoryModel extends CI_Model
{

	private $tablew = "tbapp_warehouse";
	
	function __construct()
	{
		parent::__construct();
	}


	public function getWarehouse()
	{
		return $this->db->query("
			SELECT
				wr.id,
				wr._managment,
				wr._warehouse,
				wr._status_warehouse,
				wr._IDTypew,
				tp._warehouse_type,
				us._nickname
			FROM
				tbapp_warehouse AS wr
			LEFT JOIN tbapp_warehouse_type AS tp ON tp.id = wr._IDTypew
			LEFT JOIN tbapp_registeruser_app AS us ON us.id = wr._IDUser;
			")->result();
	}
	public function getWarehouseFromId($id)
	{
		return $this->db->query("
			SELECT
				wr.id,
				wr._managment,
				wr._warehouse,
				wr._status_warehouse,
				wr._IDTypew,
				tp._warehouse_type,
				us._nickname
			FROM
				tbapp_warehouse AS wr
			LEFT JOIN tbapp_warehouse_type AS tp ON tp.id = wr._IDTypew
			LEFT JOIN tbapp_registeruser_app AS us ON us.id = wr._IDUser
			where wr.id = ".$id.";
			")->row();
	}

	protected function dataWarehouse($data)
	{
		return [
			"_warehouse " => strtoupper($data['_warehouse']),
			"_managment " => strtoupper($data['_management']),
			"_IDTypew"    => $data['_IDTypew'],
			"_IDUser"     => $data['_IDUser'],

		];
	}

	protected function dataWarehouseUpdate($data)
	{
		return [
			"_warehouse " => strtoupper($data['_warehouse2']),
			"_managment " => strtoupper($data['_management2']),
			"_IDTypew"    => $data['_IDTypew2'],
		];
	}

	public function storeWarehouse($data)
	{
		return $this->db->insert($this->tablew,self::dataWarehouse($data));
	}

	public function editWarehouse($data)
	{
		$this->db->set('_update_at', 'NOW()', FALSE);
		return $this->db->where(["id" => $data["id_hidden"]])->update($this->tablew,self::dataWarehouseUpdate($data));
	}
}