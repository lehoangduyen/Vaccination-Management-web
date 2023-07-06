<?php
error_reporting(E_ERROR | E_PARSE);
if (!defined('browsable')) {
    header("location:javascript://history.go(-1)");
}

class Vaccine {
    private $ID;
    private $Name;
    private $Technology;
    private $Country;

    public function __construct(){
        $this->ID = "";
        $this->Name = "";
        $this->Technology = "";
        $this->Country = "";
    }

    public function set_id($id){
        $this->ID = $id;
    }

    public function set_name($name){
        $this->Name = $name;
    }

    public function set_technology($technology){
        $this->Technology = $technology;
    }

    public function set_country($country){
        $this->Country = $country;
    }

    public function get_id(){
        return $this->ID;
    }

    public function get_name(){
        return $this->Name;
    }

    public function get_technology(){
        return $this->Technology;
    }

    public function get_country(){
        return $this->Country;
    }
}
?>