<?php


/**
* 
*/
class appDashboardModel extends CI_Model
{
	private $dbf;
	function __construct()
	{
		parent::__construct();
		$this->dbf = $this->load->database('franquisia', TRUE);
	}

	public function getAnalisisStore(){

		if($this->session->userdata("stores_new") == '*'){

		return $this->db->query("
			SELECT
			IF (
				ISNULL(sum(_total_order)),
				0,
				sum(_total_order)
			) AS torder,

			IF (
				ISNULL(sum(_courier_cost)),
				0,
				sum(_courier_cost)
			) AS tcost,
			 count(_order_id) AS coorr,

			IF (
				ISNULL(sum(_item)),
				0,
				sum(_item)
			) AS item,

			IF (
				ISNULL(sum(_total_cant)),
				0,
				sum(_total_cant)
			) AS tcant
			FROM
				tbapp_orders
			WHERE
				MONTH(_date_create) = ".date("m")." AND YEAR(_date_create) = ".date("Y").";
				")->row();
		}

		else{
			return $this->db->query("
				SELECT
				IF (
					ISNULL(sum(_total_order)),
					0,
					sum(_total_order)
				) AS torder,

				IF (
					ISNULL(sum(_courier_cost)),
					0,
					sum(_courier_cost)
				) AS tcost,
				 count(_order_id) AS coorr,

				IF (
					ISNULL(sum(_item)),
					0,
					sum(_item)
				) AS item,

				IF (
					ISNULL(sum(_total_cant)),
					0,
					sum(_total_cant)
				) AS tcant
				FROM
					tbapp_orders
				WHERE
					_store_id IN (".$this->session->userdata("stores_new").")
				AND 
					MONTH(_date_create) = ".date("m")." AND YEAR(_date_create) = ".date("Y").";
			")->row();
		}

	}


	public function getLastWeekOrder($week = 0){

		if ($this->session->userdata("stores_new") == '*') {
			return $this->db->query("
				SELECT
					o.*,st._store,
					(SELECT COUNT(*) as c from tbapp_orders_line WHERE _order_id = o._order_id) as total_items,
					s._description_state
				FROM
					tbapp_orders AS o
				JOIN tbapp_stores AS st ON st.id = o._store_id
				JOIN tbapp_order_state as s on s.id = o._order_state
				WHERE
					YEARWEEK(o._date_create) = YEARWEEK(NOW() - INTERVAL ".$week." WEEK) ORDER BY o.id desc;
				")->result();
		} else {
			return $this->db->query("
				SELECT
					o.*,st._store,
					(SELECT COUNT(*) as c from tbapp_orders_line WHERE _order_id = o._order_id) as total_items,
					s._description_state
				FROM
					tbapp_orders AS o
				JOIN tbapp_stores AS st ON st.id = o._store_id
				JOIN tbapp_order_state as s on s.id = o._order_state
				WHERE
					YEARWEEK(o._date_create) = YEARWEEK(NOW() - INTERVAL ".$week." WEEK)
					AND o._store_id in (".$this->session->userdata("stores_new").") ORDER BY o.id desc
				")->result();
		}
		
	}

	public function getSaleForWeek(){
		if ($this->session->userdata("stores_new") == '*') {
			return $this->db->query("
				SELECT
					(
						SELECT
							SUM(_total_order)
						FROM
							tbapp_orders
						WHERE
							YEARWEEK(_date_create) = YEARWEEK(NOW() - INTERVAL 0 WEEK)
					) AS semana_actual,
					(
						SELECT
							SUM(_total_order)
						FROM
							tbapp_orders
						WHERE
							YEARWEEK(_date_create) = YEARWEEK(NOW() - INTERVAL 1 WEEK)
					) AS semana_anterior
				")->row();
		} else {
			return $this->db->query("
				SELECT
				(
					SELECT
						SUM(_total_order)
					FROM
						tbapp_orders
					WHERE
				_store_id in (".$this->session->userdata("stores_new").")
				AND
						YEARWEEK(_date_create) = YEARWEEK(NOW() - INTERVAL 0 WEEK)
				) AS semana_actual,
				(
					SELECT
						SUM(_total_order)
					FROM
						tbapp_orders
					WHERE
				_store_id in (".$this->session->userdata("stores_new").")
				AND
						YEARWEEK(_date_create) = YEARWEEK(NOW() - INTERVAL 1 WEEK)
				) AS semana_anterior


				")->row();
		}
		
	}

	public function rankSellerMonth(){
		if ($this->session->userdata("stores_new") == '*') {
			return $this->db->query("
				SELECT
					o._store_id,
					t._store,
					sum(o._total_order) AS t
				FROM
					tbapp_orders AS o
				JOIN tbapp_stores AS t ON t.id = o._store_id
				WHERE
				MONTH(_date_create) = ".date("m")." AND YEAR(_date_create) = ".date("Y")."
				GROUP BY
					o._store_id
				ORDER BY
					sum(o._total_order) DESC;
				")->result();
		} else {
			return $this->db->query("
				SELECT
					o._store_id,
					t._store,
					sum(o._total_order) AS t
				FROM
					tbapp_orders AS o
				JOIN tbapp_stores AS t ON t.id = o._store_id
				WHERE
				_store_id in (".$this->session->userdata("stores_new").")
				AND
				MONTH(_date_create) = ".date("m")." AND YEAR(_date_create) = ".date("Y")."
				GROUP BY
					o._store_id
				ORDER BY
					sum(o._total_order) DESC;
				")->result();
		}
	}

	public function getSaleForMonth(){
		if ($this->session->userdata("stores_new") == '*') {
			return $this->db->query('
				SELECT
					MONTH(_date_create) as mes_nro,
					CASE MONTH(_date_create) when "1" then "Ene"
					when "2" then "Feb"
					when "3" then "Mar"
					when "4" then "Abr"
					when "5" then "May"
					when "6" then "Jun"
					when "7" then "Jul"
					when "8" then "Ago"
					when "9" then "Sep"
					when "10" then "Oct"
					when "11" then "Nov"
					when "12" then "Dec" END as mes_corto,
					CASE MONTH(_date_create) when "1" then "Enero"
					when "2" then "Febrero"
					when "3" then "Marzo"
					when "4" then "Abril"
					when "5" then "Mayo"
					when "6" then "Junio"
					when "7" then "Julio"
					when "8" then "Agosto"
					when "9" then "Septiembre"
					when "10" then "Octubre"
					when "11" then "Noviembre"
					when "12" then "Deciembre" END as mes_full,
						sum(o._total_order) AS t
					FROM
						tbapp_orders AS o
					JOIN tbapp_stores AS t ON t.id = o._store_id
					WHERE
					 YEAR(_date_create) = "'.date("Y").'"
					GROUP BY
						MONTH(_date_create);
				')->result();
		} else {
			return $this->db->query('
				SELECT
					MONTH(_date_create) as mes_nro,
					CASE MONTH(_date_create) when "1" then "Ene"
					when "2" then "Feb"
					when "3" then "Mar"
					when "4" then "Abr"
					when "5" then "May"
					when "6" then "Jun"
					when "7" then "Jul"
					when "8" then "Ago"
					when "9" then "Sep"
					when "10" then "Oct"
					when "11" then "Nov"
					when "12" then "Dec" END as mes_corto,
					CASE MONTH(_date_create) when "1" then "Enero"
					when "2" then "Febrero"
					when "3" then "Marzo"
					when "4" then "Abril"
					when "5" then "Mayo"
					when "6" then "Junio"
					when "7" then "Julio"
					when "8" then "Agosto"
					when "9" then "Septiembre"
					when "10" then "Octubre"
					when "11" then "Noviembre"
					when "12" then "Deciembre" END as mes_full,
						sum(o._total_order) AS t
					FROM
						tbapp_orders AS o
					JOIN tbapp_stores AS t ON t.id = o._store_id
					WHERE
					_store_id in ('.$this->session->userdata("stores_new").')
					AND
					 YEAR(_date_create) = "'.date("Y").'"
					GROUP BY
						MONTH(_date_create);
				')->result();
		}
	}

	public function getSaleForYear(){
		if ($this->session->userdata("stores_new") == '*') {
			return $this->db->query("
				SELECT
				IF (
					ISNULL(sum(_total_order)),
					0,
					sum(_total_order)
				) AS torder,

				IF (
					ISNULL(sum(_courier_cost)),
					0,
					sum(_courier_cost)
				) AS tcost,
				 count(_order_id) AS coorr,

				IF (
					ISNULL(sum(_item)),
					0,
					sum(_item)
				) AS item,

				IF (
					ISNULL(sum(_total_cant)),
					0,
					sum(_total_cant)
				) AS tcant
				FROM
					tbapp_orders
				WHERE
				YEAR(_date_create) = ".date("Y").";

				")->row();
		} else {
			return $this->db->query("
				SELECT
				IF (
					ISNULL(sum(_total_order)),
					0,
					sum(_total_order)
				) AS torder,

				IF (
					ISNULL(sum(_courier_cost)),
					0,
					sum(_courier_cost)
				) AS tcost,
				 count(_order_id) AS coorr,

				IF (
					ISNULL(sum(_item)),
					0,
					sum(_item)
				) AS item,

				IF (
					ISNULL(sum(_total_cant)),
					0,
					sum(_total_cant)
				) AS tcant
				FROM
					tbapp_orders
				WHERE
					_store_id IN (".$this->session->userdata("stores_new").")
				AND 
				YEAR(_date_create) = ".date("Y").";

				")->row();
		}
		
	}

	public function getSalesGraphYear(){
		if ($this->session->userdata("stores_new") == '*') {
			return $this->db->query('
				SELECT
				CASE MONTH(_date_create) when "1" then "Ene"
				when "2" then "Feb"
				when "3" then "Mar"
				when "4" then "Abr"
				when "5" then "May"
				when "6" then "Jun"
				when "7" then "Jul"
				when "8" then "Ago"
				when "9" then "Sep"
				when "10" then "Oct"
				when "11" then "Nov"
				when "12" then "Dec" END as label,
					sum(o._total_order) AS value
				FROM
					tbapp_orders AS o
				JOIN tbapp_stores AS t ON t.id = o._store_id
				WHERE
				 YEAR(_date_create) = "'.date("Y").'"
				GROUP BY
					MONTH(_date_create);

				')->result_array();
		} else {
			return $this->db->query('
				SELECT
				CASE MONTH(_date_create) when "1" then "Ene"
				when "2" then "Feb"
				when "3" then "Mar"
				when "4" then "Abr"
				when "5" then "May"
				when "6" then "Jun"
				when "7" then "Jul"
				when "8" then "Ago"
				when "9" then "Sep"
				when "10" then "Oct"
				when "11" then "Nov"
				when "12" then "Dec" END as label,
					sum(o._total_order) AS value
				FROM
					tbapp_orders AS o
				JOIN tbapp_stores AS t ON t.id = o._store_id
				WHERE
				_store_id in ("'.$this->session->userdata("stores_new").'")
				AND
				 YEAR(_date_create) = "'.date("Y").'"
				GROUP BY
					MONTH(_date_create);


				')->result_array();
		}
		
	}

	public function getSalesGraphDay(){
		if ($this->session->userdata("stores_new") == '*') {
			return $query =  $this->db->query("
									SELECT
										DAY (_date_create) AS label,
										sum(_total_order) AS value
									FROM
										tbapp_orders
									WHERE
										MONTH (_date_create) = ".date("m")."
									GROUP BY
										DAY (_date_create)")->result();

			/* para obtener array de graficas*/
			foreach ($query as $key => $value) {
				$d[] = [$value->label, $value->v];
			}
			

		} else {
			return $query = $this->db->query("
									SELECT
										DAY (_date_create) AS label,
										sum(_total_order) AS value
									FROM
										tbapp_orders
									WHERE
									_store_id in ('".$this->session->userdata("stores_new")."')
									AND
										MONTH (_date_create) = '".date("Y")."'
									GROUP BY
										DAY (_date_create)")->result_array();
			foreach ($query as $key => $value) {
				$d[] = [$value->label, $value->v];
			}
		}
	}

	public function getSaleProductGraphYear(){
		if ($this->session->userdata("stores_new") == '*') {
			return $this->db->query("
				SELECT
				p._product as label,
					sum(l._cant) as value
				FROM
					tbapp_orders_line as l
				JOIN tbapp_products as p on p._sku = l._producto_sku
				WHERE
				YEAR(l._create_at) = ".date("Y")."
				GROUP BY
					l._producto_sku
				ORDER BY
					sum(l._cant) DESC
				limit 10;
				")->result();
		} else {
			return $this->db->query("

				SELECT
				p._product as label,
					sum(l._cant) as value
				FROM
					tbapp_orders_line as l
				JOIN tbapp_products as p on p._sku = l._producto_sku
				WHERE
				l._store_id in('".$this->session->userdata("stores_new")."') AND
				YEAR(l._create_at) = ".date("Y")."
				GROUP BY
					l._producto_sku
				ORDER BY
					sum(l._cant) DESC
				limit 10;

				")->result();
		}
		
	}

	public function getSaleGraphWeek(){
		if ($this->session->userdata("stores_new") == '*') {
			return $this->db->query("
				SELECT
					CONCAT(
						'Semana ',
						WEEK (_date_create)
					) AS label,
					SUM(_total_order) AS value
				FROM
					tbapp_orders
				WHERE
					MONTH (_date_create) = ".date("m")."
				AND YEAR (_date_create) = ".date("Y")."
				GROUP BY
					YEARWEEK(_date_create)

				")->result();
		} else {
			return $this->db->query("
				SELECT
					CONCAT(
						'Semana ',
						WEEK (_date_create)
					) AS label,
					SUM(_total_order) AS value
				FROM
					tbapp_orders
				WHERE
				_store_id in ('".$this->session->userdata("stores_new")."')
				AND
					MONTH (_date_create) = ".date("m")."
				AND YEAR (_date_create) = ".date("Y")."
				GROUP BY
					YEARWEEK(_date_create)

				")->result();
		}
		
	}
}