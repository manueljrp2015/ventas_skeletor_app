<?php


$this->load->view("app/dashboard/parse/header");
$this->load->view("app/dashboard/parse/body-in");

$this->load->view("app/".$folder."/".$file);
//$this->load->view("app/dashboard/parse/page-footer");
$this->load->view("app/dashboard/parse/body-out");