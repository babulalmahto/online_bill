<?php

include_once 'Models/mdlBill.php';

class ctrlBill {

    public $model;
    public $error;

    public function __construct() {
        $this->model = new clsBill();
        $this->error = "";
    }

    public function invoke() {
        $page = filter_input(INPUT_GET, 'mdl', FILTER_SANITIZE_SPECIAL_CHARS);
//    echo "Page is ".$page."        ";


        if (isset($_POST["btnSave"])) {

            $this->model->nBill = $_POST["txtBill"];
            $this->model->nDate = $_POST["txtDate"];
            $this->model->nCustomerCode = $_POST["txtCustomerCode"];
            $this->model->cName = $_POST["txtName"];
            $this->model->nTotal = $_POST["txtTotal"];
            $this->model->nDiscount1 = $_POST["txtDiscount1"];
            $this->model->nDiscount2 = $_POST["txtDiscount2"];
            $this->model->nGst1 = $_POST["txtGST1"];
            $this->model->nGst2 = $_POST["txtGST2"];
            $this->model->nGrandTotal = $_POST["txtGrandTotal"];
            $this->model->nFlag = $_POST["txtFlag"];

            $nCount = 0;
            $nValid = 0;
            foreach ($_POST as $cell => $value) {
                if (0 === strpos($cell, 'txtCode') || 0 === strpos($cell, 'txtTableName') || 0 === strpos($cell, 'txtQuantity') || 0 === strpos($cell, 'txtRate') || 0 === strpos($cell, 'txtAmount')) {
//                    echo '<br>' . $cell . "=" . $value;

                    if (0 === strpos($cell, 'txtCode') && $value != "") {
                        $this->model->nCode[$nCount] = $value;
                        $this->model->cTableName[$nCount] = "";
                        $this->model->nQuantity[$nCount] = 0;
                        $this->model->nRate[$nCount] = 0;
                        $this->model->nAmount[$nCount] = 0;
                        $nValid = 1;
                    } elseif (0 === strpos($cell, 'txtTableName') && $nValid == 1) {
                        $this->model->cTableName[$nCount] = $value;
                    } elseif (0 === strpos($cell, 'txtQuantity') && $nValid == 1) {
                        $this->model->nQuantity[$nCount] = $value;
                    } elseif (0 === strpos($cell, 'txtRate') && $nValid == 1) {
                        $this->model->nRate[$nCount] = $value;
                    } elseif (0 === strpos($cell, 'txtAmount') && $nValid == 1) {
                        $this->model->nAmount[$nCount] = $value;
                        $nCount++;
                        $nValid = 0;
                    }
                }
            }
            if (empty($this->model->nBill)) {
                $this->model->error = '*Bill No. Require';
            } elseif (empty($_POST["txtDate"])) {
                $this->model->error = '*Date Require';
            } elseif (empty($_POST["txtCustomerCode"])) {
                $this->model->error = '*Customer code Require';
            } elseif (empty($_POST["txtDiscount1"])) {
                $this->model->error = '*Discount Required';
            } elseif (empty($_POST["txtGST1"])) {
                $this->model->error = '*GST Required';
            } else {
//                ($this->model->error == "") {
                $this->model->save();
                $this->model->clear();
//                $this->model->error = '*New record inserted';
            }
        } elseif (isset($_POST["btnSearch"])) {

            if (empty($_POST["txtBill"])) {
                $this->model->error = "Please enter the bill no after you can search.";
            } elseif (!ctype_digit($_POST["txtBill"])) {
                $this->model->error = "Please enter correct bill no.";
            } else {
                $this->model->nBill = trim($_POST["txtBill"]);
                $this->model->search();
//                $this->model->clear();
            }
        } elseif (isset($_POST['btnDelete'])) {
            $this->model->nBill = $_POST['txtBill'];
            $this->model->nFlag = $_POST["txtFlag"];
            if ($this->model->nFlag == 'Y') {
                $this->model->billDelete();
            } else {
                $this->model->error = '*Search Bill First';
            }
        } elseif (isset($_POST['btnClear'])) {
            $this->model->clear();
        }
        require "Views/vewBill.php";
    }

}

?>