<?php

class clsCustomerWiseItem {

    public $nBillNum = array();
    public $cBillCode = array();
    public $cBillCode2 = array();
    public $nDate1 = "";
    public $nDate2 = "";
    public $cName = "";
    public $nSNo = array();
    public $nDate = array();
    public $nBillNo = array();
    public $cCustName = array();
    public $nGross = array();
    public $cItName = array();
    public $nQuantity = array();
    public $nRate = array();
    public $nNet = array();
    public $nNetTotal = array();
    public $cItNamess ="";
    public $nGrossTotal = "";
    public $nDisTotal = "";
    public $nGstTotal = "";
    public $nFlag = "";
    public $error = "";
    public $message = "";
    public $row = 0;
    public $nCtr = "";
    public $nMax = "";
    public $cQuery = "";
    public $cQuery1 = "";
    public $cQuery2 = "";
    public $dTotal = 0;

    public function __construct() {
        $this->pdo = $this->dbconnect();
    }

    public function dbconnect() {
        $cServername = 'localhost';
        $cUsername = 'root';
        $cPassword = 'mysql123';
        $cDbname = 'my_training';

        try {
            $this->cnConn = new PDO("mysql:host=$cServername;dbname=$cDbname", $cUsername, $cPassword);
            $this->cnConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//            echo "Connection Successful";
            return $this->cnConn;
        } catch (PDOException $e) {
            echo "Connection Failed" . $e->getMessage();
        }
    }

    public function show() {
        $nCtr = 0;
//        $sql = "SELECT bill1_date, bill1_no, bill1_total, bill1_grandtotal, cus_name FROM bill1 LEFT JOIN customer ON "
//                . "cus_code = bill1_customercode WHERE bill1_date between '" . $this->nDate1 . "'AND'" . $this->nDate2 . "'";

        $sql = "SELECT DISTINCT bill1_no, bill1_customercode, bill1_date, bill1_total, bill1_discount2, bill1_gst2, bill1_grandtotal, cus_name, itm_description,"
                . "bill2_bill1_no, bill2_quantity, bill2_rate, bill2_amount FROM bill1 "
                . "LEFT JOIN bill2 ON bill2_bill1_no = bill1_no "
                . "LEFT JOIN customer ON cus_code = bill1_customercode "
                . "LEFT JOIN item ON itm_code = bill2_it_code "
                . "WHERE bill1_date BETWEEN '" . $this->nDate1 . "' AND '" . $this->nDate2 . "' OR cus_name='" . $this->cName . "'"
                . "ORDER BY cus_name ";
//        echo $sql;

        foreach ($this->cnConn->query($sql) as $row1) {
//            $this->cBillCode[$nCtr] = $row1["bill1_no"];
            $this->cBillCode2[$nCtr] = $row1["bill2_bill1_no"];
            $this->nDate[$nCtr] = $row1["bill1_date"];
            $this->nBillNo[$nCtr] = $row1["bill1_no"];
            $this->cCustCode[$nCtr] = $row1["bill1_customercode"];
            $this->cCustName[$nCtr] = $row1["cus_name"];
            $this->cItNamess= $row1["itm_description"];
            $this->cItName[$nCtr] = $row1["itm_description"];
            $this->nQuantity[$nCtr] = $row1["bill2_quantity"];
            $this->nRate[$nCtr] = $row1["bill2_rate"];
            $this->nAmount[$nCtr] = $row1["bill2_amount"];
            $this->nGross[$nCtr] = $row1["bill1_total"];
            $this->nDisc[$nCtr] = $row1["bill1_discount2"];
            $this->nTax[$nCtr] = $row1["bill1_gst2"];
            $this->nNet[$nCtr] = $row1["bill2_amount"];
            $this->nNetTotal[$nCtr] = $row1["bill1_grandtotal"];

//            $sql = "SELECT bill2_quantity, bill2_rate, itm_description FROM bill2 LEFT JOIN item ON "
//                    . "itm_code = bill2_it_code WHERE bill2_it_code =".$row1["bill1_no"];
            $nCtr++;
        }
    }

    public function clear() {
        $this->nBillNum = array();
        $this->nDate1 = "";
        $this->nDate2 = "";
        $this->nSNo = array();
        $this->nDate = array();
        $this->nBillNo = array();
        $this->cCustName = array();
        $this->nGross = array();
        $this->cItName = array();
        $this->nQuantity = array();
        $this->nRate = array();
        $this->nNet = array();
        $this->nGrossTotal = "";
        $this->nDisTotal = "";
        $this->nGstTotal = "";
        $this->nNetTotal = "";
    }
}

?>