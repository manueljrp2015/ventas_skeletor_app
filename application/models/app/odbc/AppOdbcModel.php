<?php
/**
* 
*/
class appOdbcModel extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model([
			"app/functions/appFunctionsModel"
			]);
	}


	public function testConn()
    {
       	 $parameters = array();
         return $this->apiodbc->testConn($parameters, TRUE);
    }


    public function createClient($data){

    	$rut_clean = str_replace([".","*","/","(",")","[","]","{","}"], "", $data["_rut"]);

    	$ex = explode("-", trim($rut_clean));

    	$parameters = array();
    	$parameters = [
		"rut_prep"   => $ex[0],
		"razon"      => strtoupper($this->appFunctionsModel->cleanString($data["_razon_real"])),
		"razonf"     => strtoupper($this->appFunctionsModel->cleanString($data["_name"])),
		"rut_format" => number_format($ex[0],0,".",".")."-".$ex[1],
		"activoaux"  => "S",
		"giroaux"    => trim($data["giro"]),
		"comuna"     => trim($data["comuna"]),
		"ciudad"     => trim($data["ciudad"]),
		"pais"       => trim($data["pais"]),
		"diraux"     => trim($this->appFunctionsModel->cleanString($data["dirfact"])),
		"clacli"     => "S",
		"clapro"     => "N",
		"claemp"     => "N",
		"clasoc"     => "N",
		"cladis"     => "N",
		"claotr"     => "N",
		"bloqueado"  => "N",
		"nota"       => "",
		"emailDTE"   => trim($this->appFunctionsModel->cleanString($data["_email"])),
		"ClaPros"    => "N",
		"Usuario"    => "Usuario",
		"region"     => trim(utf8_encode($data["region"]))
    	];
        return $this->apiodbc->createNewClient($parameters, TRUE);
    }


    public function updateClient($data){

    	$rut_clean = str_replace([".","*","/","(",")","[","]","{","}"], "", $data["_rut"]);

    	$ex = explode("-", trim($rut_clean));

    	$parameters = array();
    	$parameters = [
		"rut_prep"   => $ex[0],
		"razon"      => strtoupper($this->appFunctionsModel->cleanString($data["_razon_real"])),
		"razonf"     => strtoupper($this->appFunctionsModel->cleanString($data["_name"])),
		"rut_format" => number_format($ex[0],0,".",".")."-".$ex[1],
		"giroaux"    => trim($data["giro"]),
		"comuna"     => trim($data["comuna"]),
		"ciudad"     => trim($data["ciudad"]),
		"pais"       => trim($data["pais"]),
		"diraux"     => trim($this->appFunctionsModel->cleanString($data["dirfact"])),
		"emailDTE"   => trim($this->appFunctionsModel->cleanString($data["_email"])),
		"region"     => trim(utf8_encode($data["region"]))
    	];
        return $this->apiodbc->updateClient($parameters, TRUE);
    }
}