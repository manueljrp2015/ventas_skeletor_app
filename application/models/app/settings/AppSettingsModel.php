<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AppSettingsModel extends CI_Model {

	private $table_settings = "tbapp_store_payment_conditions";
	private $table_Store = "tbapp_stores";
	private $table_Store_reload = "tbapp_store_reload_credit";

	public function getSettingsParamStore($data){
		return $this->db->where(["_store_id" => $data["_id_store"]])->get($this->table_settings)->row();
	}

	public function getPaymentConditions($all = "*"){
		if ($all == "*") {
			return $this->db->query("
				SELECT
					pay.*, st._store,
					st._idn
				FROM
					tbapp_store_payment_conditions AS pay
				LEFT JOIN tbapp_stores AS st ON st.id = pay._store_id;
				")->result();
		} else {
			return $this->db->query("
				SELECT
					pay.*, st._store,
					st._idn
				FROM
					tbapp_store_payment_conditions AS pay
				LEFT JOIN tbapp_stores AS st ON st.id = pay._store_id
				WHERE
				pay._store_id in (".$all.");
				")->result();
		}
	}

	protected function dataPayment($data){
		return [
			"_credit"    => $data["_credit"],
			"_balance"    => $data["_credit"],
			"_paying_to" => $data["_form_pay"],
			"_type_pay"  => $data["_type_pay"],
			"_store_id"  => $data["store_id_5"],
		];
	}

	public function putPayment($data){
		return $this->db->insert($this->table_settings, self::dataPayment($data));
	}

	public function updatePayment($data){
		return $this->db->where(["id" => $data["id"]])->update($this->table_settings,[
			"_credit"    => $data["_credit"],
			"_paying_to" => $data["_form_pay"],
			"_type_pay"  => $data["_type_pay"],
		]);
	}
	public function getReloadCredict($all = "*", $from ="", $to = ""){
		if($all == "*"){
			return $this->db->query(
			"SELECT
				rle.*, store._store, store._idn,
			us._nickname
			FROM
				tbapp_store_reload_credit AS rle
			LEFT JOIN tbapp_stores AS store ON store.id = rle._store_id
			LEFT JOIN tbapp_registeruser_app as us on us.id = rle._user_id"
			)->result();
		}
		else{

			$date = new DateTime($to);
            $to = $date->format('Y-m-d');
            $to = date('Y-m-d', strtotime($to. ' + 1 days'));

            $date2 = new DateTime($from);
            $from = $date->format('Y-m-d');

			return $this->db->query(
			"SELECT
				rle.*, store._store, store._idn,
			us._nickname
			FROM
				tbapp_store_reload_credit AS rle
			LEFT JOIN tbapp_stores AS store ON store.id = rle._store_id
			LEFT JOIN tbapp_registeruser_app as us on us.id = rle._user_id
			WHERE
			rle._store_id in(".$all.") OR rle._create_at BETWEEN ".$from." AND ".$to ." order by rle.id desc"
			)->result();
		}
		
	}

	public function getReloadCredictId($data){
		return $this->db->query(
			"SELECT
				rle.*, store._store, store._idn
			FROM
				tbapp_store_reload_credit AS rle
			LEFT JOIN tbapp_stores AS store ON store.id = rle._store_id
			WHERE
			rle.id = ".$data["id"].";"
		)->row();
	}

	public function putReload($data){
		$query = $this->db->where(["_store_id" => $data["store_id_7"]])->get($this->table_settings)->row();
		if ($query) {
			$this->db->insert($this->table_Store_reload, [
				"_credict"       => $data["_credit_2"],
				"_balance"       => ($data["_balance"] == 0) ? $query->_credit : $data["_balance"],
				"_reload"        => $data["_reload"],
				"_balance_final" => $data["_balance"] + $data["_reload"],
				"_store_id"      => $data["store_id_7"],
				"_user_id"       => $this->session->userdata("id")
			]);
			$this->db->where(["_store_id" => $data["store_id_7"]])->update($this->table_settings, [
				"_balance" => ($data["_balance"] == 0) ? $query->_credit : $data["_balance"] + $data["_reload"]
			]);
		} else {
			# code...
		}
		
	}
}

/* End of file AppSettingsModel.php */
/* Location: ./application/models/app/settings/AppSettingsModel.php */