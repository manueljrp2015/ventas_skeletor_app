<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AppIonicModel extends CI_Model {

	private $apptb_user = "tbapp_registeruser_app";
	private $dbf;
	private $apptb_fn_tiendas = 'tiendas';

	public function __construct()
	{
		parent::__construct();
		$this->load->model(["app/oauth/appoAuthModel","app/functions/appFunctionsModel"]);
		$this->dbf = $this->load->database('franquisia', TRUE);
	}

  public function getAuthorized($data){
  	$quser = $this->db->where("_nickname", strtolower($data["user"]))
    ->or_where("_mail", strtolower($data["user"]))
    ->get($this->apptb_user)
    ->row();

    if($quser){
      if($quser->_user_status === "ac"){
        if (password_verify($data["password"], $quser->_key)) {
          if($quser->_relacionship_store == null){
            return ["msg" => "empty-store"];
          }
          else{
          	$unsenew = unserialize($quser->_relacionship_store);
		    $impnew = implode(",", $unsenew);

		    $unsenold = unserialize($quser->_relacionship_store_old);
		    $impold = implode(",", $unsenold);
              return [
              "msg" =>"done", 
              "userID" => $quser->id, 
              "stnew" => $impnew, 
              "stold" => $impold,
              "userName" => $quser->_nickname];
          }
        }
        else {
          return ["msg" => "badpass"];
        }
      }
      elseif ($quser->_user_status === "in") {
        return ["msg" => "i"];
      }
      elseif ($quser->_user_status === "block") {
        return ["msg" => "b"];
      }
      else {
        return ["msg" => "error"];
      }
    }
    else {
      return ["msg" => FALSE];
    }
  }

  public function getApiIonicInfoUserId($id){
  	return $this->db->get_where("tbapp_registeruser_app",["id" => $id])->result_array();
  }

  public function recoveryAuthorized($data)
  {
    $quser = $this->db->where("_nickname", strtolower($data["email"]))
    ->or_where("_mail", strtolower($data["email"]))
    ->get($this->apptb_user)
    ->row();

    if($quser){

      $new_password = $this->appFunctionsModel->generatePassword();
      $update_pass = [
          "_key" => $this->appFunctionsModel->hashPassword($new_password)
      ];

      $this->db->where(["id" => $quser->id])->update($this->apptb_user, $update_pass);
      $this->appEmailsModel->emailRenewPassword($quser->_mail, $new_password);

      return ["msg" => TRUE];
    }
    else {
      return ["msg" => FALSE];
    }
  }








  /*
  |
  |
  | DATA VIEJA
  |
  |
  |*/


  public function geMyStoreForFree($data){

		if($data["storeOld"] == '*'){
		$query = $this->dbf->query("
			SELECT
				p.id_tienda,
				t.nombre_tienda,
			  t4.nombres
			FROM
				pedidos AS p
			LEFT JOIN tiendas AS t ON t.id_tienda = p.id_tienda
			JOIN relacion_tiendas as t3 ON t3.id_tienda = t.id_tienda 
			JOIN usuarios as t4 ON t4.id_usuario = t3.id_usuario and t4.llave = 7
			WHERE
				p.estado_pedido IN (
					1,
					2,
					3,
					4,
					5,
					6,
					7,
					8,
					9,
					10,
					18,
					19,
					17,
					15
				)
			AND p.excepcion = 0
			GROUP BY
				p.id_tienda
			ORDER BY
				t4.nombres ASC;
			")->result_array();

			foreach ($query as $key => $value) {
				$d[] = $value;
			}
			return $d;
		}
		else{
			$query = $this->dbf->query("
			SELECT
				p.id_tienda,
				t.nombre_tienda,
			  t4.nombres
			FROM
				pedidos AS p
			LEFT JOIN tiendas AS t ON t.id_tienda = p.id_tienda
			JOIN relacion_tiendas as t3 ON t3.id_tienda = t.id_tienda 
			JOIN usuarios as t4 ON t4.id_usuario = t3.id_usuario and t4.llave = 7
			WHERE
				p.estado_pedido IN (
					1,
					2,
					3,
					4,
					5,
					6,
					7,
					8,
					9,
					10,
					18,
					19,
					17,
					15
				)
			AND p.excepcion = 0
			AND t.id_tienda IN (".$data["storeOld"].")
			GROUP BY
				p.id_tienda
			ORDER BY
				t4.nombres ASC;
			")->result_array();
			foreach ($query as $key => $value) {
				$d[] = $value;
			}
			return $d;
		}
	}

public function geMyStoreOld($data){

    if($data["storeOld"] == '*'){
      $query = $this->dbf->order_by("nombre_tienda","asc")
      ->select(["id_tienda", "nombre_tienda", "rut", "tipo_cliente"])
      ->where('activo','1')
      ->get($this->apptb_fn_tiendas)
      ->result_array();
      
      foreach ($query as $key => $value) {
				$d[] = $value;
			}
		return $d;
    }
    else{
      $query = $this->dbf->order_by("nombre_tienda","asc")
      ->select(["id_tienda", "nombre_tienda", "rut", "tipo_cliente"])
      ->where('activo','1')
      ->where_in('id_tienda', $data["storeOld"])
      ->get($this->apptb_fn_tiendas)
      ->result_array();
      foreach ($query as $key => $value) {
				$d[] = $value;
			}
		return $d;
    }
  }

  public function unLockedStore($data){
		$query = $this->dbf->query("
					SELECT
						*
					FROM
						pedidos
					WHERE
						id_tienda = '".$data["store"]."'
					AND estado_pedido in (1,2,3,4,5,6,7,8,9,10,18,19,17,15)
					AND excepcion = 0
					ORDER BY
						id_pedido DESC LIMIT 1;
			")->row();

		if($query){

			$this->dbf->where("id_pedido" , $query->id_pedido)->update("pedidos", ["excepcion" => 1]);
			return ["msg" => "done" , "orders" => $query->id_pedido];
		}
		else{
			return ["msg" => "empty"];
		}
	}

	public function getAnalisisStore(){
		return $this->dbf->query("

			SELECT
				SUM(neto) as torder,
				sum(cantidad_items) as item,
				sum(cantidad_total) as coorr
			FROM
				pedidos
			WHERE

			MONTH(fecha_inicio) = ".date("m")." and YEAR(fecha_inicio) = ".date("Y").";

			")->row();
	}

	public function getSaleForWeek(){
		return $this->dbf->query("

			SELECT
			(
				SELECT
					sum(ped.neto) AS total_venta
				FROM
					pedidos ped
				LEFT JOIN tiendas AS tien ON tien.id_tienda = ped.id_tienda
				WHERE
					 YEARWEEK ((fecha_inicio + INTERVAL 2 DAY),0)  = YEARWEEK ((NOW() + INTERVAL 2 DAY),0)-1
			) AS semana_anterior,
			(
				SELECT
					sum(ped.neto) AS total_venta
				FROM
					pedidos ped
				LEFT JOIN tiendas AS tien ON tien.id_tienda = ped.id_tienda
				WHERE
					 YEARWEEK ((fecha_inicio + INTERVAL 2 DAY),0)  = YEARWEEK ((NOW() + INTERVAL 2 DAY),0)
			) AS semana_actual


			")->row();
	}

	public function getListPricesStore($data){
		return $this->dbf->query("
			SELECT
				lp.*, p.ean_caja,
				p.ean_empaque,
				p.ean,
				p.nombre,
				p.grupo,
				grp.grupo as ngrupo,
				p.subgrupo,
				sgrp.sub_grupo
			FROM
				lista_productos AS lp
			LEFT JOIN productos AS p ON p.codigo = lp.codigo
			LEFT JOIN grupo AS grp ON grp.id_grupo = p.grupo
			LEFT JOIN sub_grupo sgrp ON sgrp.numero_sub_grupo = p.subgrupo
			WHERE
				lp.id_tienda = ".$data['storeID'].";
			")->result_array();
	}

	public function activateProduct($data){
		 $this->dbf->where(["id_tienda" => $data["storeID"] , "codigo" => $data["code"]])->update("lista_productos",["activo" => ($data["active"] == 1) ? 0 : 1]);

		 return ["msg" => ($data["active"] == 1) ? "i" : "a"];
	} 

	public function changePrice($data){
		
			$this->dbf->where(["id_tienda" => $data['storeID'], "codigo" => $data['code']])->update("lista_productos",["precio_franquiciado" => $data['neewPrice']]);

			return ["msg" => TRUE];
	}

}

/* End of file AppIonicModel.php */
/* Location: ./application/models/app/ionic/AppIonicModel.php */