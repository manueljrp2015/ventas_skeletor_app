<?php


class oauthHooks 
{

	private $CI;

	public function __construct(){
		$this->CI =& get_instance();
		$this->CI->load->library('session');
	}

	public function authorizedLicense()
	{
		
		if(is_dir(dirname(__FILE__)."/faq/23ef94879b97ae4294d39d799837fba2/")){
			$fkey = fopen(dirname(__FILE__)."/faq/23ef94879b97ae4294d39d799837fba2/23ef94879b97ae4294d39d799837fba2.key", "r");
			$fcad = fopen(dirname(__FILE__)."/faq/23ef94879b97ae4294d39d799837fba2/f0a911354cd74cf57f21b0fa33d5aa92.cad", "r");
			$furi= fopen(dirname(__FILE__)."/faq/23ef94879b97ae4294d39d799837fba2/2e4770e70e32137e53d91de76b870146.uri", "r");
			$linea[0] = fgets($fkey);
			$line[0] = fgets($fcad);
			$uri[0] = fgets($furi);
			fclose($fkey);
			fclose($fcad);
			fclose($furi);

			if(password_verify($linea[0], KEY_LICENSE)){

				$string = base64_decode($line[0]);
				$diff = self::diffDate(date("Y-m-d"), $string);

				if($diff == 0 || $date1 = new DateTime(date("Y-m-d")) > $date2 = new DateTime($string)){
					redirect('warning','auto');
					die();
				}
				else{
					if(base64_decode($uri[0]) === $_SERVER["HTTP_HOST"]){
						return true;
					}
					else{
						redirect('warning','auto');
						die();
					}
				}
			}
			else{
				redirect('warning','auto');
				die();
			}
		}
		else
		{
			redirect('warning','auto');
			die();
		}
		
	}

	protected function diffDate($today, $finish){
		$datetime1 = new DateTime($today);
		$datetime2 = new DateTime($finish);
		$interval = $datetime1->diff($datetime2);
		return $interval->format('%a');
	}

}