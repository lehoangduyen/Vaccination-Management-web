<?php
error_reporting(E_ERROR | E_PARSE);
if (!defined('browsable')) {
    header("location:javascript://history.go(-1)");
}

include("object_Schedule.php");
include("object_Citizen.php");

class Register
{
    private $Citizen;
    private $Sched;
    private $Time;
    private $NO;
    private $Status;
    private $Image;
    private $DoseType;
    private $ID;

    public function __construct()
    {
        $this->Citizen = new Citizen();
        $this->Sched = new Schedule();
        $this->Time = -1;
        $this->NO = -1;
        $this->Status = -1;
        $this->Image = "";
        $this->DoseType = "";
        $this->ID = -1;
    }

    public function set_citizen($citizen)
    {
        $this->Citizen = $citizen;
    }

    public function set_sched($sched)
    {
        $this->Sched = $sched;
    }

    public function set_time($time)
    {
        $this->Time = $time;
    }

    public function set_no($no)
    {
        $this->NO = $no;
    }

    public function set_status($status)
    {
        $this->Status = $status;
    }

    public function set_image($image)
    {
        $this->Image = $image;
    }

    public function set_dosetype($dosetype)
    {
        $this->DoseType = $dosetype;
    }

    public function set_id($id)
    {
        $this->ID = $id;
    }

    public function get_citizen()
    {
        return $this->Citizen;
    }

    public function get_sched()
    {
        return $this->Sched;
    }

    public function get_time()
    {
        switch ($this->Time) {
            case 0:
                return "Sáng";
            case 1:
                return "Trưa";
            case 2:
                return "Tối";
            default:
                return "";
        }
    }

    public function get_no()
    {
        return $this->NO;
    }

    public function get_status($value = 0)
    {
        if ($value == 1)
            return $this->Status;
            
        switch ($this->Status) {
            case 0:
                return 'Đã đăng ký';
            case 1:
                return 'Đã điểm danh';
            case 2:
                return 'Đã tiêm';
            case 3:
                return 'Đã hủy';
            default:
                return $this->Status;
        }
    }

    public function get_image()
    {
        return $this->Image;
    }

    public function get_dosetype()
    {
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

    public function get_id()
    {
        return $this->ID;
    }
}
