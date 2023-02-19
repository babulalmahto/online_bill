<?php

include_once 'Models/mdlCustomerWiseItem.php';

class ctrlCustomerWiseItem {

    public $model;
    public $error;

    public function __construct() {
        $this->model = new clsCustomerWiseItem();
        $this->error = "";
    }

    public function invoke() {
        $page = filter_input(INPUT_GET, 'mdl', FILTER_SANITIZE_SPECIAL_CHARS);

        if (isset($_POST["btnShow"])) {
            $this->model->nDate1 = $_POST['txtFromDate'];
            $this->model->nDate2 = $_POST['txtToDate'];
            if (empty($_POST["txtFromDate"])) {
                $this->model->error = "*select date first";
            } elseif ($_POST["txtFromDate"] != "" && empty($_POST["txtToDate"])) {
                $this->model->error = "*select date second";
            } else {
                $this->model->show();
            }
        } elseif (isset($_POST['btnClear'])) {
            $this->model->clear();
        }

        require "Views/vewCustomerWiseItem.php";
    }

}

?>