<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TempController extends CI_Controller {

	private $dbf;

	public function __construct()
	{
		parent::__construct();
		$this->dbf = $this->load->database('franquisia', TRUE);
		$this->load->model([
			'app/transactions/AppTransactionsModel'
		]);
	}

	public function index()
	{
		echo  $this->input->get("producto");
	}


	/*public function includeProduct(){

		$query = $this->dbf->get("tiendas")->result();
		foreach ($query as $key => $value) {
			$query2 = $this->dbf->where(["id_tienda" => $value->id_tienda, "codigo" => $this->input->get("producto")])->get("lista_productos")->row();
			if ($query2) {
				echo "existe en la base de datos <br>";
			} else {
				$this->dbf->insert("lista_productos", [
					"codigo"              => strtoupper($this->input->get("producto")),
					"precio_franquiciado" => 0,
					"id_tienda"           => $value->id_tienda,
					"activo"              => 0
				]);

				echo "insertado en la base de datos <br>";
			}
		}
	}


	public function getProducts(){
		header('Content-Type: application/json');
		$q_two = $this->db->get("tbapp_products_line")->result();
		foreach ($q_two as $key1 => $value_1) {
			$q_one =  $this->db->query("
															SELECT
																ln._line,
																product.*, pr._sku,
																pr._product,
																pr._available,
																pr._category,
																gr._group,
																sgr._sub_group,
																pr._subcategory,
																pr._und,
																pr._min_measure,
																pr._max_measure,
																img._img,
																img._img_thumbs
															FROM
																tbapp_products_store AS product
															JOIN tbapp_products AS pr ON pr.id = product._producto_id
															JOIN tbapp_products_img AS img ON img._product_id = pr.id
															JOIN tbapp_products_line AS ln ON ln.id = pr._line
															JOIN tbapp_products_group AS gr ON gr.id = pr._category
															JOIN tbapp_products_groupsub AS sgr ON sgr.id = pr._subcategory
															WHERE
																product._store_id = 43
																AND pr._line = ".$value_1->id."
															AND product._status_product = 'a'
															order by pr._product asc
															")->result();

								if($q_one){
									foreach ($q_one as $key2 => $value_2) {
					    				$ss[$key1][$key2] = $value_2;
					    		}

								}
								else{
									$ss[$key1][0] = null;
								}

    		
    		$a[] = ["id_linea" => $value_1->id, "linea" => $value_1->_line,  "images" => $value_1->_imagen,"productos" => $ss[$key1]];
    		

		}
		$response = ["text" => json_encode($a)];
            $this->load->view("app/response/text", $response);
	}*/

	/*public function algorithmCalendarOrder(){
		$query = $this->db->where(["_active" => "a"])->get("tbapp_order_calendar")->row();
		if ($query) {

			//$dates = date("Y-m-d");
			$dates = "2018-02-22";

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

			var_dump((object)[
				"date_create"     => $dates, 
				"resto_dias"      => (int)$interval->format('%R%a'), 
				"weeks"           => (string)$num_week, 
				"week_point"      => (string)$week_position,
				"week_calendar"   => $week_calendar,
				"_start_calendar" => $query->_start,
				"_end_calendar"   => $query->_end,
				"_month_calendar" => $query->_month,
				"_year_calendar"  => $query->_year,
				"id_calendar"  => $query->id,
				]);
		} else {
			var_dump( ["msg" => "no-calendar"] );
		}
	}*/


	public function insertPosition(){

		$query = $this->dbf->get('positions')->result();
		if($query){
			foreach ($query as $key => $value) {
				$product = $this->dbf->where(["codigo" => $value->code])->update("productos",["position" => $value->position]);
				echo ''
			}
			return true;
		}
		else{
			return false;
		}
	}

}

/* End of file tempController.php */
/* Location: ./application/controllers/app/temp/tempController.php */