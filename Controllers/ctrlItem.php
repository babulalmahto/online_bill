<?php

include_once 'Models/mdlItem.php';

class ctrlItem {

    public $model;
    public $error;

    public function __construct() {
        $this->model = new clsItem();
        $this->error = "";
    }

    public function invoke() {
        $page = filter_input(INPUT_GET, 'mdl', FILTER_SANITIZE_SPECIAL_CHARS);
//    echo "Page is ".$page."        ";

        if (isset($_POST['btnSave'])) {

            $this->model->nCode = trim($_POST["txtCode"]);
            $this->model->cDescription = trim($_POST["txtDescription"]);
            $this->model->nRate = trim($_POST["txtRate"]);
            $this->model->nFlag = trim($_POST["txtFlag"]);

            if (empty($this->model->nCode)) {
                $this->model->error = "Please enter the code.";
            } elseif (!ctype_digit($this->model->nCode)) {
                $this->model->error = $this->model->error . "Please enter a positive code.";
            } else {
                $this->model->nCode = trim($_POST["txtCode"]);
            }

            if (empty($this->model->cDescription)) {
                $this->model->error = $this->model->error . "Please enter description.";
            } else {
                $this->model->cDescription = trim($_POST["txtDescription"]);
            }

            if (empty($this->model->nRate)) {
                $this->model->error = $this->model->error . "Please enter rate.";
            } else {
                $this->model->nRate = trim($_POST["txtRate"]);
            }
            if ($this->model->error == "") {
                $this->model->save();
            }
        } elseif (isset($_POST["btnRead"])) {

            if (empty(trim($_POST["txtCode"]))) {
                $this->model->error = $this->model->error . "*Enter code first.";
            } elseif (!ctype_digit(trim($_POST["txtCode"]))) {
                $this->model->error = $this->model->error . "Please enter a right code.";
            } else {
                $this->model->nCode = trim($_POST["txtCode"]);
                $this->model->read();
            }
        } elseif (isset($_POST["btnDelete"])) {

            if (empty(trim($_POST["txtCode"]))) {
                $this->model->error = $this->model->error . "*Enter code first.";
            } elseif (!ctype_digit(trim($_POST["txtCode"]))) {
                $this->model->error = $this->model->error . "Please enter a right code.";
            } else {
                $this->model->nCode = trim($_POST["txtCode"]);
                $this->model->delete();
            }
        } elseif (isset($_POST['btnClear'])) {
            $this->model->clear();
        }
        require "Views/vewItem.php";
    }

}

?>