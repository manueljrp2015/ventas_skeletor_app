<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class appAdministrationModel extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}


	public function getPayMonth($month = null, $year = null){

		$month = date("m");
		$year = date("Y");

			return $this->db->query("
							SELECT
				ty._type_payment AS paym,
				bk1._bank AS bank_ori,
				bk2._bank AS bank_dest,
				st._store,
				pay.*
			FROM
				tbapp_payments AS pay
			LEFT JOIN tbapp_type_payments AS ty ON ty.id = pay._type_payment
			LEFT JOIN tbapp_bank AS bk1 ON bk1.id = pay._bank_origyn
			LEFT JOIN tbapp_bank AS bk2 ON bk2.id = pay._bank_destiny
			LEFT JOIN tbapp_stores AS st ON st.id = pay._store_id
			WHERE
			MONTH(pay._create_at) = ".$month." and YEAR(pay._create_at) = ".$year.";
				")->result();
	
		
	}

}

/* End of file AppAdministrationModel.php */
/* Location: ./application/models/app/administration/AppAdministrationModel.php */