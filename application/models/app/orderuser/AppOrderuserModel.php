<?php

/**
* 
*/
class appOrderuserModel extends CI_Model
{

	private $dbf;
	
	function __construct()
	{
		parent::__construct();
		$this->dbf = $this->load->database('franquisia', TRUE);
	}

	public function getAllOrder(){
		if($this->session->userdata("stores_old") == '*'){

			return $this->dbf->query("SELECT
						edo.estado,
						  t.nombre_tienda,
							t4.nombres,
							p.*,
							(select COUNT(*) from facturas WHERE id_pedido = p.id_pedido) as total_f,
							(SELECT COUNT(*) FROM pedidos_regalo where pedido = p.id_pedido AND cod_producto = 'MA0027') AS count_promo
						FROM
							pedidos AS p
						LEFT JOIN tiendas AS t ON t.id_tienda = p.id_tienda
						JOIN relacion_tiendas AS t3 ON t3.id_tienda = t.id_tienda
						JOIN usuarios AS t4 ON t4.id_usuario = t3.id_usuario
						JOIN estados as edo ON edo.id_estado = p.estado_pedido
						AND t4.llave = 7
						ORDER BY
							t4.nombres ASC LIMIT 1000;")->result();

		}
		else{

			return $this->dbf->query("SELECT
						edo.estado,
						  t.nombre_tienda,
							t4.nombres,
							p.*,
							(select COUNT(*) from facturas WHERE id_pedido = p.id_pedido) as total_f,
							(SELECT COUNT(*) FROM pedidos_regalo where pedido = p.id_pedido AND cod_producto = 'MA0027') AS count_promo
						FROM
							pedidos AS p
						LEFT JOIN tiendas AS t ON t.id_tienda = p.id_tienda
						JOIN relacion_tiendas AS t3 ON t3.id_tienda = t.id_tienda
						JOIN usuarios AS t4 ON t4.id_usuario = t3.id_usuario
						JOIN estados as edo ON edo.id_estado = p.estado_pedido
						AND t4.llave = 7
						WHERE 
						t.id_tienda in(".$this->session->userdata("stores_old").")
						ORDER BY
							t4.nombres ASC LIMIT 1000;")->result();
		}
		
	}

	public function getDetOrdersUser($id){
		return $this->dbf->query("
			SELECT
				pr.nombre, lp.*
			FROM
				lineas_pedido AS lp
			JOIN productos as pr on pr.codigo = lp.cod_producto
			WHERE
				lp.id_pedido = ".$id.";
			")->result();
	}

	public function getListFactureForOrders($id){
		return $this->dbf->query("
			SELECT *, DATE_FORMAT(fecha_carga, '%d-%m-%Y') as dp from facturas WHERE id_pedido  = ".$id.";
			")->result();
	}

	public function changeState($data){
		return $this->dbf->where(["id_pedido" => $data["order"]])->update("pedidos",["estado_pedido" => $data["sts"], "verificador" => 49]);
	}

	public function gifPromo($data){

		$this->dbf->insert("lineas_pedido", [
			"id_pedido"           => $data["order"],
			"cod_producto"        => $data["cod"],
			"cantidad"            => 8,
			"cantidad_pickeada"   => 0,
			"cantidad_verificada" => 0,
			"total_linea"         => 0,
			"numero_factura"      => 0, 
			"numero_guia_salida"  => 0
		]);

		$query = $this->dbf->where(["id_pedido" => $data["order"]])->get("pedidos")->row();
		if($query){
			$this->dbf->where(["id_pedido" => $data["order"]])->update("pedidos",[
				"cantidad_items" => $query->cantidad_items + 1,
				"cantidad_total" => $query->cantidad_total + 8
			]);
		}

		$query2 = $this->dbf->where(["codigo" => $data["cod"]])->get("productos")->row();
		if($query2){
			$this->dbf->where(["codigo" => $data["cod"]])->update("productos",[
				"inventario_teorico" => $query2->inventario_teorico - 8
			]);
		}

		$this->dbf->insert("pedidos_regalo",[
			"pedido"       => $data["order"],
			"cod_producto" => $data["cod"],
			"cantidad"     => 8,
			"promo"        => "CAJA FINITRONIC TOPPING"
		]);

		return TRUE;
	}

}