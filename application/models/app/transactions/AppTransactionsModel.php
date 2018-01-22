<?php

/**
* 
*/
class appTransactionsModel extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model([
			"app/functions/appFunctionsModel"
			]);
	}


	public function consolidateOrder(){

		$calendar = $this->algorithmCalendarOrder();

		if($calendar->msg == "calendar"){

			$tax = $this->appFunctionsModel->getTax()->_tax_factor;
			$summary = $this->sumOrder($this->input->post("store"));
			$order_id = $this->getLastEnvoices();
			$this->insertLastInvoice($order_id->_order_id, $order_id->_invoice);


			$this->db->insert("tbapp_orders",[
					"_order_id"       => $order_id->_order_id,
					"_total_order"    => $summary->rode,
					"_total_iva"      => ($summary->rode * $tax),
					"_total_neto"     => ($summary->rode -( $summary->rode * $tax)),
					"_item"           => $summary->item,
					"_total_cant"     => $summary->cant,
					"_store_id"       => $this->input->post("store"),
					"_weight"         => $this->input->post("peso"),
					"_volume"         => $this->input->post("volumen"),
					"_order_state"    => 1,
					"_date_order"     => $calendar->date_create,
					"_rest_day"       => $calendar->resto_dias,
					"_weeks "         => $calendar->weeks,
					"_week_point"     => $calendar->week_point,
					"_week_calendar"  => $calendar->week_calendar,
					"_month_calendar" => $calendar->month_calendar,
					"_year_calendar"  => $calendar->year_calendar,
					"_id_calendar"    => $calendar->id_calendar,
				]);

			

			$qord = $this->db->where(["_store_id" => $this->input->post("store"), "_order_id" => null])->get("tbapp_orders_line");

			$line = 1;

			foreach ($qord->result() as $key => $value) {
				if($line == 30){
					$line = 1;
				}
				$this->db->where(["_store_id" => $this->input->post("store"), "_order_id" => null, "id" => $value->id])->update("tbapp_orders_line",[
				"_line_order" => $line
				]);
				$line = $line + 1;
			}

			$this->db->where(["_store_id" => $this->input->post("store"), "_order_id" => null])->update("tbapp_orders_line",[
				"_order_id" => $order_id->_order_id
				]);

			$updat = $this->db->where(["_order_id" => $order_id->_order_id])->get("tbapp_orders_line")->result();

			foreach ($updat as $key => $value) {
				$this->updateAvailableReal($value->_product_id, $value->_cant);
			}

			$this->db->insert("tbapp_order_timeline",["_order_id" => $order_id->_order_id, "_order_state" => 1]);

			$this->updateBalanceStore($order_id->_order_id, $summary->rode, "O");
			return ["msg" => "done", "order" => $order_id->_order_id];
		}
		else if($calendar->msg == "no-calendar"){
			return ["msg" => $calendar->msg];
		}

		
	}

	public function updateAvailableReal($idproducto, $cant){
		$query = $this->db->where(["id" => $idproducto])->get("tbapp_products")->row();
		if ($query) {
			$this->db->where(["id" => $idproducto])->update("tbapp_products",[
				"_available_real" => ($query->_available_real - $cant),
				"_available" => ($query->_available - $cant),
				]);
		} else {
			return false;
		}
		
	}

	public function sumOrder($store){
		return $this->db->query("SELECT
				count(*) as item,
				SUM(line._cant) as cant,
				SUM(line._rode) as rode
			FROM
				tbapp_orders_line as line
			inner JOIN tbapp_products as prod on prod.id = line._product_id
			WHERE
				line._store_id = ".$store."
				AND ISNULL(line._order_id)")->row();
	}

	public function getLastEnvoices(){
		return $this->db->query("SELECT
				(_order_id + 1) as _order_id,
				_invoice  FROM
				tbapp_invoices
				ORDER BY id DESC
				LIMIT 1")->row();
	}

	public function insertLastInvoice($order_id, $envoice){
		return $this->db->insert("tbapp_invoices",[
			"_invoice"  => $envoice  + 1,
			"_order_id" => $order_id
			]);
	}

	
	public function saveCourierOrder($data){

		

		if ($data["courier_id"] == 1) {

			$this->db->insert("tbapp_order_courier",[
				"_courier_id"   => $data["courier_id"],
				"_cost"         => $data["cost"],
				"_total_weight" => $data["total_weight"],
				"_factor"       => $data["factor"],
				"_param"        => $data["param"],
				"_order_id"     => $data["order_id"],
				"_store_id"     => $data["store_id"],
				]);

				$this->db->insert("tbapp_orders_line",[
					'_product_id'   => "295",
					'_producto_sku' => "TR001",
					'_cant'         => 1,
					'_rode'         => $data["cost"],
					'_store_id'     => $data['store_id'],
					'_order_id'		=> $data["order_id"],
					'_user_id'      => $this->session->userdata('id')
					]);

				$this->updateBalanceStore($data['store_id'], $data["cost"], "C");

				$this->db->insert("tbapp_order_timeline",["_order_id" => $data["order_id"], "_order_state" => 2]);

				return $this->updateOrder($data['order_id'], $data["cost"]);

		} else if ($data["courier_id"] == 2) {

			$date = new DateTime($data["_date_courier"]." ".$data["_horario"]);


			$this->db->insert("tbapp_order_courier",[
				"_courier_id"      => $data["courier_id"],
				"_cost"            => 0,
				"_total_weight"    => 0,
				"_factor"          => 0,
				"_param"           => 0,
				"_order_id"        => $data["_order_id"],
				"_date_retirement" => $date->format('Y-m-d H:i:s'),
				"_contact"         => strtoupper($data["_contact"]),
				'_store_id'        => $data['_store_id'],
				"_cel"             => $data["_cel_contact"]
				]);

				$this->db->insert("tbapp_orders_line",[
					'_product_id'   => "295",
					'_producto_sku' => "TR001",
					'_cant'         => 1,
					'_rode'         => 0,
					'_store_id'     => $data['_store_id'],
					'_order_id'		=> $data["_order_id"],
					'_user_id'      => $this->session->userdata('id')
					]);

				$this->db->insert("tbapp_order_timeline",["_order_id" => $data["_order_id"], "_order_state" => 2]);

				return true;

		} else if ($data["courier_id"] == 3) {

			

			$this->db->insert("tbapp_order_courier",[
				"_courier_id"   => $data["courier_id"],
				"_cost"         => 0,
				"_total_weight" => 0,
				"_factor"       => 0,
				"_param"        => 0,
				"_order_id"     => $data["_order_id"],
				"_contact"      => strtoupper($data["_contact"]),
				'_store_id'     => $data['_store_id'],
				"_cel"          => $data["_cel_contact"],
				"_addressee"    => strtoupper($data["_dir"]),
				"_direcction"   => strtoupper($data["_emp"]),
				]);

				$this->db->insert("tbapp_orders_line",[
					'_product_id'   => "295",
					'_producto_sku' => "TR001",
					'_cant'         => 1,
					'_rode'         => 0,
					'_store_id'     => $data['_store_id'],
					'_order_id'		=> $data["_order_id"],
					'_user_id'      => $this->session->userdata('id')
					]);

				$this->db->insert("tbapp_order_timeline",["_order_id" => $data["order_id"], "_order_state" => 2]);

				return true;
		}
		
	}

	public function updateOrder($order, $costc){

		$tax = $this->appFunctionsModel->getTax()->_tax_factor;

		$summary = $this->db->query("
			SELECT
				count(*) AS item,
				SUM(line._cant) AS cant,
				SUM(line._rode) AS rode
			FROM
				tbapp_orders_line AS line
			INNER JOIN tbapp_products AS prod ON prod.id = line._product_id
			WHERE
				line._order_id = ".$order."")->row();



		$this->db->where(["_order_id" => $order])->update("tbapp_orders",[
			"_total_order"  => $summary->rode,
			"_total_iva"    => ($summary->rode * $tax),
			"_total_neto"   => ($summary->rode -( $summary->rode * $tax)),
			"_item"         => $summary->item,
			"_total_cant"   => $summary->cant,
			"_courier_cost" => $costc
			]);


	}


	public function accordingOrder($order){

		$this->db->insert("tbapp_order_timeline",["_order_id" => $order["order"], "_order_state" => 3]);

		$this->db->set('_according_date', 'NOW()', FALSE);
		return $this->db->where(["_order_id" => $order["order"]])->update("tbapp_orders", ["_according" => "Y", "_according_user" => $this->session->userdata("id"), "_comment" => strtoupper($order["comment"])]);
	}

	public function updateBalanceStore($data, $rode = 0, $type = "C"){
		
		if($type == "C"){
			$q = $this->db->where(["_store_id" => $data])->get("tbapp_store_payment_conditions")->row();
			if($q){
				$this->db->where(["_store_id" => $data])->update("tbapp_store_payment_conditions",[
					"_balance"     =>  ($q->_balance - $rode),
					"_consumption" => $q->_credit - ($q->_balance - $rode)
					]);
			}
		}
		else if($type == "O"){

			$ord =  $this->db->where(["_order_id" => $data])->get("tbapp_orders")->row();
			$q = $this->db->where(["_store_id" => $ord->_store_id])->get("tbapp_store_payment_conditions")->row();
			if($q){
				$this->db->where(["_store_id" => $data])->update("tbapp_store_payment_conditions",[
					"_balance"     =>  ($q->_balance - $rode),
					"_consumption" => $q->_credit - ($q->_balance - $rode)
					]);
			}
		}
	}

	public function algorithmCalendarOrder(){
		$query = $this->db->where(["_active" => "a"])->get("tbapp_order_calendar")->row();
		if ($query) {

			$dates = date("Y-m-d");

			$start_order = new DateTime($dates);
			$start  = new DateTime($query->_start);
			$end  = new DateTime($query->_end);
			$interval = $start_order->diff($end);
			$interval2 = $start->diff($end);

			$num_week = ceil($interval2->format('%a') / 7);


			if($interval->format('%R%a') >= 0){
				$date = new DateTime($dates);
				$week = (floor($interval->format('%a')/7));
				$week_position = $num_week - $week;
				$week_calendar = (string)($date->format('W') - 1);
			}
			else{

				$this->db->where(["id" => $query->id])->update("tbapp_order_calendar",[
					"_active" => 'i'
				]);
				$this->db->where(["id" => ($query->id + 1)])->update("tbapp_order_calendar",[
					"_active" => 'a'
				]);

				$this->algorithmCalendarOrder();
				exit;
			}

			return(object)[
				"msg"            => "calendar",
				"date_create"    => $dates, 
				"resto_dias"     => (int)$interval->format('%R%a'), 
				"weeks"          => (string)$num_week, 
				"week_point"     => (string)$week_position,
				"week_calendar"  => $week_calendar,
				"start_calendar" => $query->_start,
				"end_calendar"   => $query->_end,
				"month_calendar" => $query->_month,
				"year_calendar"  => $query->_year,
				"id_calendar"    => $query->id
				];
		} else {
			return (object)["msg" => "no-calendar"];
		}
		
	}
}