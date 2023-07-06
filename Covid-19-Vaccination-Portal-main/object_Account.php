<?php
error_reporting(E_ERROR | E_PARSE);
/*
The If statement used to check the existence of the variable 'browsable'.
If a direct access is made, there is no declaration for 'browsable' in these included files.
Then the access is backward.
*/
if (!defined('browsable')) {
    header("location:javascript://history.go(-1)");
}

class Account {
    private $Username;
    private $Password;
    private $Role;
    private $Status;

    public function __construct(){
        $this->Username = "";
        $this->Password = "";
        $this->Role = -1;
        $this->Status = -1;
    }

    public function set_username($username){
        $this->Username = $username;
    }

    public function set_password($password){
        $this->Password = $password;
    }

    public function set_role($role){
        $this->Role = $role;
    }

    public function set_status($status){
        $this->Status = $status;
    }

    public function get_username(){
        return $this->Username;
    }

    public function get_password(){
        return $this->Password;
    }

    public function get_role(){
        return $this->Role;
    }

    public function get_status(){
        return $this->Status;
    }
}