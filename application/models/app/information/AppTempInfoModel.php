<?php

/**
* 
*/
class appTempInfoModel extends CI_Model
{
	private $dbf;
	function __construct()
	{
		parent::__construct();
		$this->dbf = $this->load->database('franquisia', TRUE);
	}


	/*
		|
		|
		| buscar informacion de tiendas
		|
		|
		*/


		public function getListStoreInfo(){
			return $this->dbf->query("
				SELECT
				t1.id_tienda,
				t1.nombre_tienda,
				t1.rut,
				t1.centro_costo,
				rt.id_usuario,
				u.nombres,
				u.llave,
				u.pw
				FROM
					tiendas as t1
				JOIN relacion_tiendas as rt ON rt.id_tienda = t1.id_tienda
				JOIN usuarios as u on u.id_usuario = rt.id_usuario AND u.llave = 7
				GROUP BY
					t1.nombre_tienda
                 
				")->result();
		}

		public function getInfoAdd($id){
			return $this->db->where(["_id_store_old" => $id])->get("tbapp_softland_file_and")->row();
		}
}