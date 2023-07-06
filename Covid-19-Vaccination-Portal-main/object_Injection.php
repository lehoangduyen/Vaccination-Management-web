 <?php
error_reporting(E_ERROR | E_PARSE);
if (!defined('browsable')) {
    header("location:javascript://history.go(-1)");
}

include("object_Citizen.php");
include("object_Schedule.php");

class Injection{
    private $Citizen;
    private $InjNO;
    private $Sched;
    private $DoseType;

    public function __construct(){
        $this->Citizen = new Citizen();
        $this->InjNO = -1;
        $this->Sched = new Schedule();
        $this->DoseType = "";
    }

    public function set_citizen($citizen){
        $this->Citizen = $citizen;
    }

    public function set_injno($injno){
        $this->InjNO = $injno;
    }

    public function set_sched($sched){
        $this->Sched = $sched;
    }

    public function set_dosetype($dosetype){
        $this->DoseType = $dosetype;
    }

    public function get_citizen(){
        return $this->Citizen;
    }

    public function get_injno(){
        return $this->InjNO;
    }

    public function get_sched(){
        return $this->Sched;
    }

    public function get_dosetype(){
        switch ($this->DoseType) {
            case 0:
                return "Cơ bản";
            case 1:
                return "Tăng cường";
            case 2: 
                return "Nhắc lại";
            default:
                return "";
        }
    }
}
