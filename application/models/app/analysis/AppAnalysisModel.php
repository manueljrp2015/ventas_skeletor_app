<?php

/**
* 
*/
class appAnalysisModel extends CI_Model
{
	private $dbf;

	function __construct()
	{
		parent::__construct();
		$this->dbf = $this->load->database('franquisia', TRUE);
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
					 YEARWEEK ((fecha_inicio + INTERVAL 2 DAY),0)  = YEARWEEK ((NOW() + INTERVAL 2 DAY),0)-2
			) AS semana_anterior,
			(
				SELECT
					sum(ped.neto) AS total_venta
				FROM
					pedidos ped
				LEFT JOIN tiendas AS tien ON tien.id_tienda = ped.id_tienda
				WHERE
					 YEARWEEK ((fecha_inicio + INTERVAL 2 DAY),0)  = YEARWEEK ((NOW() + INTERVAL 2 DAY),0)-1
			) AS semana_actual


			")->row();
	}

	public function getSalesGraphYear(){
		return $this->dbf->query('

			SELECT
				CASE MONTH(fecha_inicio) when "1" then "Ene"
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
					sum(neto) AS value
				FROM
					pedidos
				WHERE
					YEAR (fecha_inicio) = '.date("Y").'
				GROUP BY MONTH (fecha_inicio);

			')->result();
	}

	public function getSalesGraphYearAfter(){
		return $this->dbf->query('

			SELECT
					sum(neto) AS value
				FROM
					pedidos
				WHERE 
					YEAR (fecha_inicio) = '.(date("Y")-1).'
				GROUP BY MONTH (fecha_inicio);

			')->result();
	}

	public function getSalesGraphYearB(){
		return $this->dbf->query('

			SELECT
					sum(neto) AS value
				FROM
					pedidos
				WHERE 
					YEAR (fecha_inicio) = '.(date("Y")).'
				GROUP BY MONTH (fecha_inicio);

			')->result();
	}

	public function getSalesGraphYearBefore(){
		return $this->dbf->query('

			SELECT
				CASE MONTH(fecha_inicio) when "1" then "Ene"
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
					sum(neto) AS value
				FROM
					pedidos
				WHERE
					YEAR (fecha_inicio) = '.(date("Y")).'
				GROUP BY MONTH (fecha_inicio);

			')->result();
	}

	public function getSaleForYear(){
		return $this->dbf->query("

			SELECT
				SUM(neto) as torder,
				sum(cantidad_items) as item,
				sum(cantidad_total) as coorr
			FROM
				pedidos
			WHERE
			YEAR(fecha_inicio) = ".date("Y").";

			")->row();
	}

	public function getSaleGraphWeek(){
			return $this->dbf->query("
				SELECT
					CONCAT(
						'Semana ',
						WEEK((fecha_inicio + INTERVAL 2 DAY), 0)
					) AS label,
					SUM(neto) AS
				VALUE

				FROM
					pedidos
				WHERE
				YEAR(fecha_inicio) = ".date("Y")." AND MONTH(fecha_inicio) = ".date("m")."
				GROUP BY
				 YEARWEEK((fecha_inicio + INTERVAL 2 DAY), 0) - 1;

				")->result();
	}

	public function getSalesGraphDay(){

			return  $this->dbf->query("
									SELECT
										DAY (fecha_inicio) AS label,
										sum(neto) AS
									VALUE

									FROM
										pedidos
									WHERE
										MONTH (fecha_inicio) = ".date("m")." AND YEAR(fecha_inicio) = ".date("Y")."
									GROUP BY
										DAY (fecha_inicio);")->result();

			
	}

	public function getSaleProductGraphYear(){
			return $this->dbf->query("
				SELECT
					pro.nombre as label,
					sum(l.cantidad) as value
				FROM
					pedidos AS p
				LEFT JOIN lineas_pedido AS l ON l.id_pedido = p. id_pedido
				LEFT JOIN productos as pro ON pro.codigo = l.cod_producto
				WHERE
				YEAR(p.fecha_inicio) = ".date(" Y ")."
				GROUP BY
				l.cod_producto
				ORDER BY
				sum(l.cantidad) DESC
				LIMIT
				10
				")->result();
		
		
	}

	public function getSaleProductGraphMonth(){
			return $this->dbf->query("
				SELECT
					pro.nombre as label,
					sum(l.cantidad) as value
				FROM
					pedidos AS p
				LEFT JOIN lineas_pedido AS l ON l.id_pedido = p. id_pedido
				LEFT JOIN productos as pro ON pro.codigo = l.cod_producto
				WHERE
				YEAR(p.fecha_inicio) = ".date(" Y ")." and MONTH(p.fecha_inicio) = ".date(" m ")."
				GROUP BY
				l.cod_producto
				ORDER BY
				sum(l.cantidad) DESC
				LIMIT
				10
				")->result();
		
		
	}

	public function getSaleForMonth(){
	
			return $this->dbf->query('
				SELECT
					MONTH(fecha_inicio) as mes_nro,
					CASE MONTH(o.fecha_inicio) when "1" then "Ene"
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
					CASE MONTH(o.fecha_inicio) when "1" then "Enero"
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
						sum(o.neto) AS t
					FROM
						pedidos AS o
					WHERE
					 YEAR(o.fecha_inicio) = "'.date("Y").'"
					GROUP BY
						MONTH(o.fecha_inicio);
				')->result();
		
	}

	public function getSalesGraphWeek(){
		return $this->dbf->query("
				SELECT
					CONCAT(
						'Semana ',
						WEEK((fecha_inicio + INTERVAL 2 DAY), 0)
					) AS label,
					SUM(neto) AS
				VALUE

				FROM
					pedidos
				WHERE
				YEAR(fecha_inicio) = 2017 
				GROUP BY
				YEARWEEK((fecha_inicio + INTERVAL 2 DAY), 0) - 1;
				")->result();
	}

}