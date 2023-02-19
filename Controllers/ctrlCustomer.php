<?php

include_once 'Models/mdlCustomer.php';

class ctrlCustomer {

    public $model;
    public $error;

    public function __construct() {
        $this->model = new clsCustomer();
        $this->error = "";
    }

    public function invoke() {
        $page = filter_input(INPUT_GET, 'mdl', FILTER_SANITIZE_SPECIAL_CHARS);
//    echo "Page is ".$page."        ";

        if (isset($_POST['btnSave'])) {

            $this->model->nCode = trim($_POST["txtCode"]);
            $this->model->cName = trim($_POST["txtName"]);
            $this->model->cAddress = trim($_POST["txtAddress"]);
            $this->model->nJoined = trim($_POST["txtJoined"]);
            $this->model->nFlag = trim($_POST["txtFlag"]);

            if (empty($this->model->nCode)) {
                $this->model->error = "Please enter the cus_code.";
            } elseif (!ctype_digit($this->model->nCode)) {
                $this->model->error = $this->model->error . "Please enter a positive integer value.";
            } else {
                $this->model->nCode = trim($_POST["txtCode"]);
            }

            if (empty($this->model->cName)) {
                $this->model->error = $this->model->error . "Please enter name.";
            } elseif (!filter_var($this->model->cName, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
                $this->model->error = $this->model->error . "Name:only letters and white space allowed.";
            } else {
                $this->model->cName = trim($_POST["txtName"]);
            }

            if (empty($this->model->cAddress)) {
                $this->model->error = $this->model->error . "Please enter an address.";
            } else {
                $this->model->cAddress = trim($_POST["txtAddress"]);
            }

            if (empty($this->model->nJoined)) {
                $this->model->error = $this->model->error . "Please enter date.";
            } else {
                $this->model->nJoined = trim($_POST["txtJoined"]);
            }
            if ($this->model->error == "") {
                $this->model->save();
            }
        } elseif (isset($_POST["btnSearch"])) {

            if (empty(trim($_POST["txtCode"]))) {
                $this->model->error = $this->model->error . "*Enter code first.";
            } elseif (!ctype_digit(trim($_POST["txtCode"]))) {
                $this->model->error = $this->model->error . "Please enter a right cus_code.";
            } else {
                $this->model->nCode = trim($_POST["txtCode"]);
                $this->model->search();
            }
        } elseif (isset($_POST["btnDelete"])) {

            if (empty(trim($_POST["txtCode"]))) {
                $this->model->error = $this->model->error . "*Enter code first.";
            } elseif (!ctype_digit(trim($_POST["txtCode"]))) {
                $this->model->error = $this->model->error . "Please enter a right cus_code.";
            } else {
                $this->model->nCode = trim($_POST["txtCode"]);
                $this->model->delete();
            }
        } elseif (isset($_POST['btnClear'])) {
            $this->model->clear();
        }
        require "Views/vewCustomer.php";
    }

}

?>