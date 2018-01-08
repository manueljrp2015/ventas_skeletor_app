<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TempController extends CI_Controller {

	private $dbf;

	public function __construct()
	{
		parent::__construct();
		$this->dbf = $this->load->database('franquisia', TRUE);
	}

	public function index()
	{
		echo  $this->input->get("producto");
	}


	public function includeProduct(){

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

}

/* End of file tempController.php */
/* Location: ./application/controllers/app/temp/tempController.php */