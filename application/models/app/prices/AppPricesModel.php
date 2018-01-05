<?php

/**
* 
*/
class appPricesModel extends CI_Model
{
	private $dbf;

	function __construct()
	{
		$this->dbf = $this->load->database('franquisia', TRUE);
		$this->load->model([
			"app/functions/appFunctionsModel",
			"app/files/appFileProcessModel",
			"app/odbc/appOdbcModel"
			]);
	}

	public function getListProductos(){
		if($this->session->userdata("stores_old") == '*'){
			return $this->dbf->query("
			SELECT
				p.*,
				(SELECT COUNT(*) FROM lista_productos WHERE codigo = p.codigo AND activo = 1) as t_tiendas_ac,
				(SELECT COUNT(*) FROM lista_productos WHERE codigo = p.codigo AND activo = 0) as t_tiendas_in,
				(SELECT min(precio_franquiciado) FROM lista_productos WHERE codigo = p.codigo AND activo = 1) as t_min_price,
				(SELECT max(precio_franquiciado) FROM lista_productos WHERE codigo = p.codigo AND activo = 1) as t_max_price,
				(SELECT avg(precio_franquiciado) FROM lista_productos WHERE codigo = p.codigo AND activo = 1) as t_promedio FROM
				productos as p;
			")->result();
		}
		else{
			return $this->dbf->query("
			SELECT
				p.*,
				(SELECT COUNT(*) FROM lista_productos WHERE codigo = p.codigo AND activo = 1 AND id_tienda IN (".$this->session->userdata("stores_old").")) as t_tiendas_ac,
				(SELECT COUNT(*) FROM lista_productos WHERE codigo = p.codigo AND activo = 0 AND id_tienda IN (".$this->session->userdata("stores_old").")) as t_tiendas_in,
				(SELECT min(precio_franquiciado) FROM lista_productos WHERE codigo = p.codigo AND activo = 1 AND id_tienda IN (".$this->session->userdata("stores_old").")) as t_min_price,
				(SELECT max(precio_franquiciado) FROM lista_productos WHERE codigo = p.codigo AND activo = 1 AND id_tienda IN (".$this->session->userdata("stores_old").")) as t_max_price,
				(SELECT avg(precio_franquiciado) FROM lista_productos WHERE codigo = p.codigo AND activo = 1 AND id_tienda IN (".$this->session->userdata("stores_old").")) as t_promedio FROM
				productos as p;
			")->result();
		}
	}

	public function getListProductForStoreActive($data){
		if($this->session->userdata("stores_old") == '*'){
		return $this->dbf->query("
					SELECT
					p.*,
					pr.nombre,
					tien.nombre_tienda FROM
					lista_productos as p
					JOIN productos as pr on pr.codigo = p.codigo
					JOIN tiendas as tien on tien.id_tienda = p.id_tienda
					WHERE
					p.codigo = '".$data["codproducto"]."'
					and p.activo = 1;
			")->result();
		}
		else{
			return $this->dbf->query("
					SELECT
					p.*,
					pr.nombre,
					tien.nombre_tienda FROM
					lista_productos as p
					JOIN productos as pr on pr.codigo = p.codigo
					JOIN tiendas as tien on tien.id_tienda = p.id_tienda
					WHERE
					p.id_tienda IN (".$this->session->userdata("stores_old").")
					and p.codigo = '".$data["codproducto"]."'
					and p.activo = 1;
			")->result();
		}
	}

	public function getListProductForStoreInactive($data){
		if($this->session->userdata("stores_old") == '*'){
		return $this->dbf->query("
					SELECT
					p.*,
					pr.nombre,
					tien.nombre_tienda FROM
					lista_productos as p
					JOIN productos as pr on pr.codigo = p.codigo
					JOIN tiendas as tien on tien.id_tienda = p.id_tienda
					WHERE
					p.codigo = '".$data["codproducto"]."'
					and p.activo = 0;
			")->result();
		}
		else{
			return $this->dbf->query("
					SELECT
					p.*,
					pr.nombre,
					tien.nombre_tienda FROM
					lista_productos as p
					JOIN productos as pr on pr.codigo = p.codigo
					JOIN tiendas as tien on tien.id_tienda = p.id_tienda
					WHERE
					p.id_tienda IN (".$this->session->userdata("stores_old").")
					and p.codigo = '".$data["codproducto"]."'
					and p.activo = 0;
			")->result();
		}
	}

	
}