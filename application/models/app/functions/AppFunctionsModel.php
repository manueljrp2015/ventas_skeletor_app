<?php

/**
 *
 */
class appFunctionsModel extends CI_Model
{

  function __construct()
  {
    parent::__construct();
  }

  public function hashPassword($password)
	{
		$opciones = [
            'cost' => 12,
        ];
    return password_hash($password, PASSWORD_BCRYPT, $opciones);
	}


	public function generatePassword()
    {
        $tokenrand = '';
        $string = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'W', 'X', 'Y', 'Z','a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'w', 'x', 'y', 'z');
        $number = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 0);
        for ($i = 0; $i <= 5; $i++) {
            $rand = rand(0, 48);
            $randn = rand(0, 9);
            $tokenrand .= $number[$randn];
            $tokenrand .= $string[$rand];
        }

        return $tokenrand;
    }

    public function getCodeAreaFromCountry($country_id)
    {
        return $this->db->select("_codephone")
        ->where(["id" => $country_id])
        ->get("tbapp_country")
        ->row();
    }

    public function generateCodePinBusiness($id, $idb)
    {
        $parse_1 = substr(strrev($idb), 0,4) ;
        $parse_2 = date("Y");
        $code = CODE_PREFIX.$parse_2.$parse_1."-".sprintf("%04d",$id);

        return $code;
    }

    public function verificadorRut($rut){
         if(strpos($rut,"-")==false){
            $RUT[0] = substr($rut, 0, -1);
            $RUT[1] = substr($rut, -1);
        }else{
            $RUT = explode("-", trim($rut));
        }
        $elRut = str_replace(".", "", trim($RUT[0]));
        $factor = 2;
        $suma = 0;
        for($i = strlen($elRut)-1; $i >= 0; $i--):
            $factor = $factor > 7 ? 2 : $factor;
            $suma += $elRut{$i}*$factor++;
        endfor;
        $resto = $suma % 11;
        $dv = 11 - $resto;
        if($dv == 11){
            $dv=0;
        }else if($dv == 10){
            $dv="k";
        }else{
            $dv=$dv;
        }
       if($dv == trim(strtolower($RUT[1]))){
           return true;
       }else{
           return false;
       }
    }

    public function buscarDigitoVerificador($_rol) {

        while($_rol[0] == "0") {
            $_rol = substr($_rol, 1);
        }
        $factor = 2;
        $suma = 0;
        for($i = strlen($_rol) - 1; $i >= 0; $i--) {
            $suma += $factor * $_rol[$i];
            $factor = $factor % 7 == 0 ? 2 : $factor + 1;
        }
        $dv = 11 - $suma % 11;
        /* Por alguna razón me daba que 11 % 11 = 11. Esto lo resuelve. */
        $dv = $dv == 11 ? 0 : ($dv == 10 ? "K" : $dv);
        return $_rol . "-" . $dv;
    }

    public function cleanString($string){

        $string = trim($string);
     
        $string = str_replace(
            array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
            array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
            $string
        );
     
        $string = str_replace(
            array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
            array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
            $string
        );
     
        $string = str_replace(
            array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
            array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
            $string
        );
     
        $string = str_replace(
            array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
            array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
            $string
        );
     
        $string = str_replace(
            array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
            array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
            $string
        );
     
        $string = str_replace(
            array('ñ', 'Ñ', 'ç', 'Ç'),
            array('n', 'N', 'c', 'C',),
            $string
        );
 
        $string = str_replace(
            array( "-", "~",
                 "#",  "|", "!", "",
                 "·", "$", "%", "&", "/",
                 "(", ")", "?", "'", "¡",
                 "¿", "[", "^", "<code>", "]",
                 "+", "}", "{", "¨", "´",
                 ">", "< ", ";", ",", ":"),
            '',
            $string
        );
 
 
        return  $string;                    
 
    }

    public function getTax($country = 2){
        return $this->db->where(["_country_id" => $country])->get("tbapp_tax_configuation")->row();
    }

    public function verifyRut($data){
        if($this->appFunctionsModel->verificadorRut($data["rut"])){
            $exrut = explode("-", $data["rut"]);
                if($this->db->get_where("tbapp_stores", ["_idn" => $exrut[0]])->row()){
                    return ["msg" => "notin"];
                }
                else{
                    return ["msg" => "in"];
                }
        }
        else{
                return ["msg" => "badrut"];
            }
        }


    public function verifyExistRut($data){
        if($this->appFunctionsModel->verificadorRut($data["rut"])){
         
                if($this->db->get_where("tbapp_stores", ["_idn" => $data["rut"]])->row()){
                    return ["msg" => "notin"];
                }
                else{
                    return ["msg" => "in"];
                }
        }
        else{
                return ["msg" => "badrut"];
            }
    }

    public function changeStateGeneric($data){
        $query = $this->db->where(["_order_id" => $data["order_id"], "_order_state" => $data["state"]])->get("tbapp_order_timeline")->row();
        if($query){
            return false;
        }
        else{

            $this->db->where(["_order_id" => $data["order_id"]])->update("tbapp_orders",[
                "_order_state" => $data["state"]
            ]);

            return $this->db->insert("tbapp_order_timeline", [
                "_order_id"    => $data["order_id"], 
                "_order_state" => $data["state"]
            ]);
        }
    }
}