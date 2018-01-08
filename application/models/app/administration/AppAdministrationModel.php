<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class appAdministrationModel extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}


	public function getPayMonth($month = null, $year = null){

		$month = date("m");
		$year = date("Y");

			return $this->db->query("
							SELECT
				ty._type_payment AS paym,
				bk1._bank AS bank_ori,
				bk2._bank AS bank_dest,
				st._store,
				pay.*
			FROM
				tbapp_order_payment AS pay
			LEFT JOIN tbapp_type_payments AS ty ON ty.id = pay._type_payment
			LEFT JOIN tbapp_bank AS bk1 ON bk1.id = pay._bank_origyn
			LEFT JOIN tbapp_bank AS bk2 ON bk2.id = pay._bank_destiny
			LEFT JOIN tbapp_stores AS st ON st.id = pay._store_id
			WHERE
			MONTH(pay._create_at) = ".$month." and YEAR(pay._create_at) = ".$year.";
				")->result();
	}

		public function getOrderState($data){
		return $this->db->query("
			SELECT
					id,
					_description_state,
					".$data["order"]." as o
				FROM
					tbapp_order_state
				WHERE
					id >= 11 and id <= 12;
			")->result();
	}

	public function changeState($data){

		$this->db->insert("tbapp_order_timeline",[
			"_order_id" => $data["order"],
			"_order_state" => $data["id"]
		]);

		$this->db->where(["_order_id" => $data["order"]])->update("tbapp_orders", [
			"_order_state" => $data["id"]
		]);

		return true;
	}

}

/* End of file AppAdministrationModel.php */
/* Location: ./application/models/app/administration/AppAdministrationModel.php */