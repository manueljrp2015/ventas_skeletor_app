<?php

use GeoIp2\Database\Reader;

class appGeoLocalModel extends CI_Model
{

	private $reader_city;
	private $reader_country;
	private $record;

	public function __construct(){
		parent::__construct();
		$this->reader_city = new Reader('public/GeoIP/GeoLite2-City.mmdb');
		$this->record = $this->reader_city->city(($_SERVER["REMOTE_ADDR"] == "127.0.0.1" || $_SERVER["REMOTE_ADDR"] == "::1" || $_SERVER["REMOTE_ADDR"] == "192.168.2.137") ? '190.215.103.47' : $_SERVER["REMOTE_ADDR"] );
	}

	public function getNameCity(){
		return $this->record->country->name;
	}

	public function getFullNameCity(){
		return $this->record->country->name."-".$this->record->country->isoCode." ".$this->record->mostSpecificSubdivision->name.", ".$this->record->city->name;
	}

	public function getShortNameCity(){
		return $this->record->country->name."-".$this->record->city->name;
	}
}