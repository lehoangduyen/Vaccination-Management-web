<?php
error_reporting(E_ERROR | E_PARSE);
if (!defined('browsable')) {
    header("location:javascript://history.go(-1)");
}

include("object_Organization.php");

class News {
    private $ID;
    private $Org;
    private $Title;
    private $PublishDate;
    private $Image;
    private $Content;

    public function __construct(){
        $this->ID = "";
        $this->OrgID = new Organization();
        $this->Title = "";
        $this->PublishDate = "";
        $this->Image = "";
        $this->Content = "";
    }

    public function set_id($id){
        $this->ID = $id;
    }

    public function set_org($org){
        $this->Org = $org;
    }

    public function set_title($title){
        $this->Title = $title;
    }

    public function set_publishdate($publishdate){
        $this->PublishDate = $publishdate;
    }

    public function set_image($image){
        $this->Image = $image;
    }

    public function set_content($content){
        $this->Content = $content;
    }

    public function get_id(){
        return $this->ID;
    }

    public function get_org(){
        return $this->Org;
    }

    public function get_title(){
        return $this->Title;
    }

    public function get_publishdate(){
        return $this->PublishDate;
    }

    public function get_image(){
        return $this->Image;
    }

    public function get_content(){
        return $this->Content;
    }
}
?>