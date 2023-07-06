<?php
error_reporting(E_ERROR | E_PARSE);
if (!defined('browsable')) {
    header("location:javascript://history.go(-1)");
}

class Citizen
{
    private $ID;
    private $LastName;
    private $FirstName;
    private $Birthday;
    private $Gender;
    private $HomeTown;
    private $ProvinceName;
    private $DistrictName;
    private $TownName;
    private $Street;
    private $Phone;
    private $Email;
    private $Guardian;
    private $Avatar;

    public function __construct()
    {
        $this->ID = "";
        $this->LastName = "";
        $this->FirstName = "";
        $this->Birthday = "";
        $this->Gender = -1;
        $this->HomeTown = "";
        $this->ProvinceName = "";
        $this->DistrictName = "";
        $this->TownName = "";
        $this->Street = "";
        $this->Phone = "";
        $this->Email = "";
        $this->Guardian = "";
        $this->Avatar = "";
    }

    public function set_id($id)
    {
        $this->ID = $id;
    }

    public function set_lastname($lastname)
    {
        $this->LastName = $lastname;
    }

    public function set_firstname($firstname)
    {
        $this->FirstName = $firstname;
    }

    public function set_birthday($birthday)
    {
        $this->Birthday = $birthday;
    }

    public function set_gender($gender)
    {
        $this->Gender = $gender;
    }

    public function set_hometown($hometown)
    {
        $this->HomeTown = $hometown;
    }

    public function set_provincename($provincename)
    {
        $this->ProvinceName = $provincename;
    }

    public function set_districtname($districtname)
    {
        $this->DistrictName = $districtname;
    }

    public function set_townname($townname)
    {
        $this->TownName = $townname;
    }

    public function set_street($street)
    {
        $this->Street = $street;
    }

    public function set_phone($phone)
    {
        $this->Phone = $phone;
    }

    public function set_email($email)
    {
        $this->Email = $email;
    }

    public function set_guardian($guardian)
    {
        $this->Guardian = $guardian;
    }

    public function set_avatar($avatar)
    {
        $this->Avatar = $avatar;
    }

    public function get_id()
    {
        return $this->ID;
    }

    public function get_lastname()
    {
        return $this->LastName;
    }

    public function get_firstname()
    {
        return $this->FirstName;
    }

    public function get_fullname()
    {
        return $this->LastName .' '. $this->FirstName;
    }

    public function get_birthday()
    {
        return $this->Birthday;
    }

    public function get_gender($v = 0)
    {
        if ($v == 1)
            return $this->Gender;
        switch ($this->Gender) {
            case 0:
                return "Nữ";
            case 1:
                return "Nam";
            case 2:
                return "Khác";
            default:
                return "";
        }
    }

    public function get_hometown()
    {
        return $this->HomeTown;
    }

    public function get_provincename()
    {
        return $this->ProvinceName;
    }

    public function get_districtname()
    {
        return $this->DistrictName;
    }

    public function get_townname()
    {
        return $this->TownName;
    }

    public function get_street()
    {
        return $this->Street;
    }

    public function get_phone()
    {
        return $this->Phone;
    }

    public function get_email()
    {
        return $this->Email;
    }

    public function get_guardian()
    {
        return $this->Guardian;
    }

    public function get_avatar()
    {
        return $this->Avatar;
    }
}
