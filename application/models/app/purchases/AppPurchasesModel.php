<?php

/**
* 
*/
class appPurchasesModel extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function getPurchasesForStore(){
		if($this->session->userdata("stores_new") == '*'){
			return $this->db->query("
				SELECT
					ords.*, stores._store,
					stores._idn,
					st._description_state,
					(SELECT COUNT(*) FROM tbapp_order_timeline WHERE _order_id = ords._order_id) as count_state,
					(SELECT COUNT(_status) from tbapp_payments where _order_id = ords._order_id) as cstspay,
  					(SELECT _status from tbapp_payments where _order_id = ords._order_id) as stspay
				FROM
					tbapp_orders AS ords
				JOIN tbapp_stores AS stores ON stores.id = ords._store_id
				JOIN tbapp_order_state as st on st.id = ords._order_state;")->result();
		}
		else{
			return $this->db->query("
				SELECT
					ords.*, stores._store,
					stores._idn,
					st._description_state,
					(SELECT COUNT(*) FROM tbapp_order_timeline WHERE _order_id = ords._order_id) as count_state,
					(SELECT COUNT(_status) from tbapp_payments where _order_id = ords._order_id) as cstspay,
  					(SELECT _status from tbapp_payments where _order_id = ords._order_id) as stspay
				FROM
					tbapp_orders AS ords
				JOIN tbapp_stores AS stores ON stores.id = ords._store_id
				JOIN tbapp_order_state as st on st.id = ords._order_state
				WHERE
					ords._store_id IN (".$this->session->userdata("stores_new").");")->result();
		}
	}

	public function getPurchasesSummaryForStore(){

		if ($this->session->userdata("stores_new") == '*') {
			return $this->db->query("
				SELECT
					sum(ords._total_order) AS totalo,
					sum(ords._item) AS totali,
					sum(ords._total_cant) AS totalc,
					count(ords.id) AS totalid,
					sum(ords._volume) AS totalv,
					sum(ords._weight) AS totalw 
				FROM
					tbapp_orders AS ords
				JOIN tbapp_stores AS stores ON stores.id = ords._store_id;")->row();
		} else {
			return $this->db->query("
				SELECT
					sum(ords._total_order) AS totalo,
					sum(ords._item) AS totali,
					sum(ords._total_cant) AS totalc,
					count(ords.id) AS totalid,
					sum(ords._volume) AS totalv,
					sum(ords._weight) AS totalw 
				FROM
					tbapp_orders AS ords
				JOIN tbapp_stores AS stores ON stores.id = ords._store_id
				WHERE
					ords._store_id IN (".$this->session->userdata("stores_new").");")->row();
		}
		
	}

	public function getCourierOrder($data){
		return $this->db->query("
			SELECT
			c.*,
			ctp._type_courier FROM
			tbapp_order_courier as c
			LEFT JOIN tbapp_order_courier_type as ctp ON ctp.id = c._courier_id
			WHERE
			c._order_id = ".$data['order'].";")->row();
	}

	public function getItemOrder($data){
		return $this->db->query("SELECT
					oline.id,
					oline._order_id,
					oline._product_id,
					oline._producto_sku,
					oline._cant,
					oline._rode,
					oline._line_order,
					oline._bill,
					oline._office_guide,
					oline._user_id,
					p._product
					 from 
					tbapp_orders_line as oline
					RIGHT JOIN tbapp_products as p on p.id = oline._product_id
					WHERE
					oline._order_id = ".$data['order']."
					and
					oline._status_order_line = 'a';")->result();
	}

	public function getTimeLine($data){
		return $this->db->query("
			SELECT
				t.id,
				t._order_id,
				t._order_state,
				t._cretae_at,
				st._description_state,
				DATE_FORMAT(t._cretae_at, '%d-%m-%Y') as _date,
				DATE_FORMAT(t._cretae_at, '%l:%i:%S %p') as _time
			FROM
				tbapp_order_timeline AS t
			LEFT JOIN tbapp_order_state AS st ON st.id = t._order_state
			WHERE
				t._order_id = ".$data['order'].";
			")->result();
	}

	public function getComment($data){
		return $this->db->select("_comment")
		->where(["_order_id" => $data["order"]])
		->get("tbapp_orders")
		->row();
	}

	public function putComment($data){
		return $this->db->where(["_order_id" => $data["order"]])->update("tbapp_orders", [
			"_comment" => $data["comment"]
			]);
	}


}