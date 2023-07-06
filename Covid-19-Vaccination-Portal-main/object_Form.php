<?php
error_reporting(E_ERROR | E_PARSE);
if (!defined('browsable')) {
    header("location:javascript://history.go(-1)");
}

include("object_Citizen.php");

class Form {
    private $CCiitizen;
    private $FilledDate;
    private $Choice;
    private $ID;

    public function __construct(){
        $this->Citizen = new Citizen();
        $this->FilledDate = "";
        $this->Choice = "";
        $this->ID = -1;
    }

    public function set_citizen($citizen){
        $this->Citizen = $citizen;
    }

    public function set_filleddate($filleddate){
        $this->FilledDate = $filleddate;
    }

    public function set_choice($choice){
        $this->Choice = $choice;
    }

    public function set_id($id){
        $this->ID = $id;
    }

    public function get_citizen(){
        return $this->Citizen;
    }

    public function get_filleddate(){
        return $this->FilledDate;
    }

    public function get_choice(){
        return $this->Choice;
    }

    public function get_id(){
        return $this->ID;
    }
}
?>