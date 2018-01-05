<?php

/**
* 
*/
class appPaymentModel extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	protected function dataPay($file, $data){

		$date = new DateTime($data["_date_pay"]);

		return [
			"_order_id "    => $data["_order_id"],
			"_type_payment" => $data["_tipepay"],
			"_store_id"     => $data["_store_id"],
			"_bank_origyn"  => $data["_bank_origin"],
			"_bank_destiny" => $data["_bank_destiny"],
			"_transaccion"  => $data["_transaccion"],
			"_date_pay"     => $date->format("Y-m-d"),
			"_rode"         => $data["_rode"],
			"_Athachment "  => $file
		];
	}

	public function savePay($file, $data){
		$this->db->insert("tbapp_payments", self::dataPay($file, $data));
		return $this->db->insert("tbapp_order_timeline", [
			"_order_id"    => $data["_order_id"],
			"_order_state" => 10
			]);
	}

	public function getPay(){

		if ($this->session->userdata("stores_new") == '*') {
			return $this->db->query("
				SELECT
				ty._type_payment as paym, bk1._bank as bank_ori, bk2._bank as bank_dest, st._store, pay.* FROM
				tbapp_payments as pay
				LEFT JOIN tbapp_type_payments as ty ON ty.id = pay._type_payment
				LEFT JOIN tbapp_bank as bk1 on bk1.id = pay._bank_origyn
				LEFT JOIN tbapp_bank as bk2 on bk2.id = pay._bank_destiny
				LEFT JOIN tbapp_stores as st on st.id = pay._store_id
				")->result();
		} else {
			return $this->db->query("
				SELECT
				ty._type_payment as paym, bk1._bank as bank_ori, bk2._bank as bank_dest, st._store, pay.* FROM
				tbapp_payments as pay
				LEFT JOIN tbapp_type_payments as ty ON ty.id = pay._type_payment
				LEFT JOIN tbapp_bank as bk1 on bk1.id = pay._bank_origyn
				LEFT JOIN tbapp_bank as bk2 on bk2.id = pay._bank_destiny
				LEFT JOIN tbapp_stores as st on st.id = pay._store_id
				WHERE
					pay._store_id in  (".$this->session->userdata("stores_new").");
				")->result();
		}
		
	}
}