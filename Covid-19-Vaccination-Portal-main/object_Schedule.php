<?php
error_reporting(E_ERROR | E_PARSE);
if (!defined('browsable')) {
    header("location:javascript://history.go(-1)");
}

include("object_Organization.php");
include("object_Vaccine.php");

class Schedule {
    private $ID;
    private $Org;
    private $OnDate;
    private $Vaccine;
    private $Serial;
    private $LimitDay;
    private $LimitNoon;
    private $LimitNight;
    private $DayRegistered;
    private $NoonRegistered;
    private $NightRegistered;

    public function __construct(){
        $this->ID = "";
        $this->Org = new Organization();
        $this->OnDate = "";
        $this->Vaccine = new Vaccine();
        $this->Serial = "";
        $this->LimitDay = 0;
        $this->LimitNight = 0;
        $this->LimitNoon = 0;
        $this->DayRegistered = 0;
        $this->NoonRegistered = 0;
        $this->NightRegistered = 0;
    }

    public function newOrg() {
        $this->Org = new Organization();
    }

    public function set_id($id){
        $this->ID = $id;
    }

    public function set_org($org){
        $this->Org = $org;
    }

    // public function set_orgname($orgname){
    //     $this->OrgName = $orgname;
    // }

    public function set_ondate($ondate){
        $this->OnDate = $ondate;
    }

    public function set_vaccine($vaccine){
        $this->Vaccine = $vaccine;
    }

    public function set_serial($serial){
        $this->Serial = $serial;
    }

    public function set_limitday($limitday){
        $this->LimitDay = $limitday;
    }

    public function set_limitnight($limitnight){
        $this->LimitNight = $limitnight;
    }

    public function set_limitnoon($limitnoon){
        $this->LimitNoon = $limitnoon;
    }

    public function set_dayregistered($dayregistered){
        $this->DayRegistered = $dayregistered;
    }

    public function set_noonregistered($noonregistered){
        $this->NoonRegistered = $noonregistered;
    }

    public function set_nightregistered($nightregistered){
        $this->NightRegistered = $nightregistered;
    }

    public function get_id(){
        return $this->ID;
    }

    public function get_org(){
        return $this->Org;
    }

    public function get_ondate(){
        return $this->OnDate;
    }

    public function get_vaccine(){
        return $this->Vaccine;
    }

    public function get_serial(){
        return $this->Serial;
    }

    public function get_limitday(){
        return $this->LimitDay;
    }

    public function get_limitnight(){
        return $this->LimitNight;
    }

    public function get_limitnoon(){
        return $this->LimitNoon;
    }

    public function get_dayregistered(){
        return $this->DayRegistered;
    }

    public function get_noonregistered(){
        return $this->NoonRegistered;
    }

    public function get_nightregistered(){
        return $this->NightRegistered;
    }
}
?>