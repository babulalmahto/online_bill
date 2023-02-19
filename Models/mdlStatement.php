<?php

class clsStatement {

    public $nBillNum = array();
    public $nDate1 = "";
    public $nDate2 = "";
    public $nSNo = array();
    public $nDate = array();
    public $nBillNo = array();
    public $cCustName = array();
    public $nGross = array();
    public $nDis = array();
    public $nGST = array();
    public $nNet = array();
    public $nGrossTotal = "";
    public $nDisTotal = "";
    public $nGstTotal = "";
    public $nNetTotal = "";
    public $nFlag = "";
    public $error = "";
    public $message = "";
    public $row = 0;
    public $nCtr = "";
    public $nMax = "";
    public $cQuery = "";
    public $cQuery1 = "";
    public $cQuery2 = "";

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
        $sql = "SELECT bill1_date, bill1_no, bill1_total, bill1_discount2,bill1_gst2,bill1_grandtotal, cus_name FROM bill1 LEFT JOIN customer ON "
                . "cus_code = bill1_customercode WHERE bill1_date between '" . $this->nDate1 . "'AND'" . $this->nDate2 . "'"
                . "ORDER BY cus_name, bill1_date, bill1_no ";
//echo $sql;
        foreach ($this->cnConn->query($sql) as $row1) {
//            $this->cSNo[$nCtr] = $row1["bill2_sl_no"];
            $this->nDate[$nCtr] = $row1["bill1_date"];
            $this->nBillNo[$nCtr] = $row1["bill1_no"];
            $this->cCustName[$nCtr] = $row1["cus_name"];
            $this->nGross[$nCtr] = $row1["bill1_total"];
            $this->nDis[$nCtr] = $row1["bill1_discount2"];
            $this->nGST[$nCtr] = $row1["bill1_gst2"];
            $this->nNet[$nCtr] = $row1["bill1_grandtotal"];
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
        $this->nDis = array();
        $this->nGST = array();
        $this->nNet = array();
        $this->nGrossTotal = "";
        $this->nDisTotal = "";
        $this->nGstTotal = "";
        $this->nNetTotal = "";
    }

}

?>