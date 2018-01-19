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
			"_Athachment "  => $file,
			"_state_pay"    => 10
		];
	}

	public function savePay($file, $data){
		$this->db->insert("tbapp_order_payment", self::dataPay($file, $data));
		return $this->db->insert("tbapp_order_timeline", [
			"_order_id"    => $data["_order_id"],
			"_order_state" => 10
			]);
	}

	public function getPay(){

		if ($this->session->userdata("stores_new") == '*') {
			return $this->db->query("
				SELECT
					ord._order_id,
					ord._total_order,
					ord._store_id,
					ord._date_create,
					st._store,
					pay._paying_to,
					opay._rode,
					opay._date_approved,
					opay._create_at,
					opay._state_pay
				FROM
					tbapp_orders AS ord
				LEFT JOIN tbapp_stores AS st ON st.id = ord._store_id
				LEFT JOIN tbapp_store_payment_conditions as pay ON pay._store_id = ord._store_id
				LEFT JOIN tbapp_order_payment as opay on opay._order_id = ord._order_id
				")->result();
		} else {
			return $this->db->query("
				SELECT
					ord._order_id,
					ord._total_order,
					ord._store_id,
					ord._date_create,
					st._store,
					pay._paying_to,
					opay._rode,
					opay._date_approved,
					opay._create_at,
					opay._state_pay
				FROM
					tbapp_orders AS ord
				LEFT JOIN tbapp_stores AS st ON st.id = ord._store_id
				LEFT JOIN tbapp_store_payment_conditions as pay ON pay._store_id = ord._store_id
				LEFT JOIN tbapp_order_payment as opay on opay._order_id = ord._order_id
				WHERE
					ord._store_id IN  (".$this->session->userdata("stores_new").");
				")->result();
		}
		
	}
}