<?php

include_once 'Models/mdlMenu.php';

class ctrlMenu {

    public $model;
    public $error;

    public function __construct() {
        $this->model = new clsMenu();
        $this->error = "";
    }
    public function invoke() {



        $page = filter_input(INPUT_GET, 'mdl', FILTER_SANITIZE_SPECIAL_CHARS);
    
        require 'Views/vewMenu.php';
    }
}
?>