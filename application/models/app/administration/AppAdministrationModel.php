<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class appAdministrationModel extends CI_Model {

	private $table_settings = "tbapp_store_payment_conditions";
	private $table_Store_reload = "tbapp_store_reload_credit";

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
				namestate._description_state,
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
			LEFT JOIN tbapp_order_state AS namestate ON namestate.id = pay._state_pay
			WHERE
			MONTH(pay._create_at) = ".$month." and YEAR(pay._create_at) = ".$year.";
				")->result();
	}


	public function getPayClient($data){

			return $this->db->query("
			SELECT
				ty._type_payment AS paym,
				namestate._description_state,
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
			LEFT JOIN tbapp_order_state AS namestate ON namestate.id = pay._state_pay
			WHERE
			pay._store_id in(".$data['client'].");")->result();
	}


	public function getPayClientId($data){

			return $this->db->query("
							SELECT
				ty._type_payment AS paym,
				namestate._description_state,
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
			LEFT JOIN tbapp_order_state AS namestate ON namestate.id = pay._state_pay
			WHERE
			pay.id = ".$data['id'].";")->row();
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
						id > (
						SELECT
							_state_pay
						FROM
							tbapp_order_payment
						WHERE
							_order_id = ".$data["order"]."
					) and id <= 12;
			")->result();
	}

	public function changeStateGeneric($data){


		$query = $this->db->where(["_order_id" => $data["order"], "_order_state" => $data["id"]])->get("tbapp_order_timeline")->row();

		if(!$query){

			$this->db->insert("tbapp_order_timeline",[
			"_order_id" => $data["order"],
			"_order_state" => $data["id"]
			]);

			$this->db->where(["_order_id" => $data["order"]])->update("tbapp_orders", [
				"_order_state" => $data["id"]
			]);

			if ($data["id"] == 11) {
				$this->db->set('_date_verify ', 'NOW()', FALSE);
				$this->db->where(["_order_id" => $data["order"]])->update("tbapp_order_payment", [
				"_state_pay  " => $data["id"]
				]);
			} else if($data["id"] == 12){
				$this->db->set('_date_approved ', 'NOW()', FALSE);
				$this->db->where(["_order_id" => $data["order"]])->update("tbapp_order_payment", [
				"_state_pay  " => $data["id"]
				]);

				$this->reloadCredict($data);
			}
			return true;
		}
	}

	public function reloadCredict($data){
		$query = $this->db->where(["_store_id" => $data["store"]])->get($this->table_settings)->row();
		if ($query) {
			$query_order =  $this->db->where(["_order_id" => $data["order"]])->get("tbapp_order_payment")->row();
			if ($query_order) {
				$this->db->where(["_store_id" => $data["store"]])->update($this->table_settings,[
					"_balance" => ($query->_balance + $query_order->_rode)
				]);

				$this->db->insert($this->table_Store_reload, [
				"_credict"       => $query->_credit,
				"_balance"       => $query->_balance,
				"_reload"        => $query_order->_rode,
				"_balance_final" => $query->_balance + $query_order->_rode,
				"_store_id"      => $data["store"],
				"_user_id"       => $this->session->userdata("id")
			]);
			} else {
				return false;
			}
			
		} else {
			return false;
		}
		
	}

	public function queryReportBank($query){

		if($query["to"] != 0 && $query["from"] != 0 && $query["state"] != 0 && $query["store"] != 0){
			$from = $this->from($query);
			$to = $this->to($query);
			$queryMysql = "pay._create_at <= '".$to."' AND pay._create_at >= '".$from."'   AND pay._store_id IN (".$query["store"] .") AND pay._state_pay IN (".$query["state"].")";
		}
		elseif ($query["to"] == 0 && $query["from"] == 0 && $query["state"] != 0 && $query["store"] != 0) {
			$queryMysql = "pay._store_id IN (".$query["store"] .") AND pay._state_pay IN (".$query["state"].")";
		}
		elseif ($query["to"] != 0 && $query["from"] != 0 && $query["state"] == 0 && $query["store"] == 0) {

			$from = $this->from($query);
			$to = $this->to($query);
			$queryMysql = "pay._create_at <= '". $to."' and pay._create_at >= '".$from."'";
		}
		elseif ($query["to"] != 0 && $query["from"] != 0 && $query["state"] == 0 && $query["store"] != 0) {
			$from = $this->from($query);
			$to = $this->to($query);
			$queryMysql = "pay._create_at <= '".$to."' AND pay._create_at >= '".$from."' AND pay._store_id IN (".$query["store"] .")";
		}
		elseif ($query["to"] != 0 && $query["from"] != 0 && $query["state"] != 0 && $query["store"] == 0) {
			$from = $this->from($query);
			$to = $this->to($query);
			$queryMysql = "pay._create_at <= '".$to."' AND pay._create_at >= '".$from."' AND pay._state_pay IN (".$query["state"] .")";
		}


		return $this->db->query("
			SELECT
				ty._type_payment AS paym,
				namestate._description_state,
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
			LEFT JOIN tbapp_order_state AS namestate ON namestate.id = pay._state_pay
			WHERE
					".$queryMysql." ORDER BY paym asc;
			")->result();
	}

	public function to($query){
		$date = new DateTime($query["to"]);
        $to = $date->format('Y-m-d');
        return $to = date('Y-m-d', strtotime($to. ' + 1 days'));
	}

	public function from($query){
		$date2 = new DateTime($query["from"]);
        return $from = $date2->format('Y-m-d');
	}

}

/* End of file AppAdministrationModel.php */
/* Location: ./application/models/app/administration/AppAdministrationModel.php */