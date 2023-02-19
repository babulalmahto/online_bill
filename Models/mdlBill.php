<?php

class clsBill {

    public $cnConn;
    public $nBill = "";
    public $nDate = "";
    public $nCustomerCode = "";
    public $cName = "";
    public $cSNo = array();
    public $nCode = array();
    public $cTableName = array();
    public $nQuantity = array();
    public $nRate = array();
    public $nAmount = array();
    public $nTotal = "";
    public $nDiscount1 = "";
    public $nDiscount2 = "";
    public $nGst1 = "";
    public $nGst2 = "";
    public $nGrandTotal = "";
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

    public function save() {

        if ($this->nFlag == "Y") {
            $cQuery2 = "UPDATE bill1 SET bill1_date='" . $this->nDate . "', bill1_customercode= " . $this->nCustomerCode . ", bill1_total=" . $this->nTotal . ","
                    . "bill1_discount1=" . $this->nDiscount1 . ", bill1_discount2=" . $this->nDiscount2 . ", bill1_gst1=" . $this->nGst1 . ","
                    . "bill1_gst2=" . $this->nGst2 . ", bill1_grandtotal=" . $this->nGrandTotal . " WHERE bill1_no=" . $this->nBill;
            $this->nCount = $this->cnConn->exec($cQuery2);
        } else {
            $cQuery = "INSERT INTO bill1 (bill1_no, bill1_date, bill1_customercode, bill1_total, bill1_discount1, bill1_discount2, bill1_gst1, bill1_gst2, bill1_grandtotal) VALUES"
                    . " (" . $this->nBill . ", '" . $this->nDate . "', " . $this->nCustomerCode . "," . $this->nTotal . "," . $this->nDiscount1 . "," . $this->nDiscount2 . "," . $this->nGst1 . "," . $this->nGst2 . "," . $this->nGrandTotal . ")";
            $this->nCount = $this->cnConn->exec($cQuery);
        }
        $nCtr = $this->cnConn->exec("DELETE FROM `bill2` WHERE bill2_bill1_no=" . $this->nBill);
        $nMax = count($this->nCode);
        $cSNo = 0;
        for ($nCtr = 0; $nCtr < $nMax; $nCtr++) {
            $cSNo = $nCtr + 1;
//            echo $this->nCode[$nCtr];
            $cQuery1 = "INSERT INTO bill2 (bill2_bill1_no, bill2_sl_no, bill2_it_code, bill2_quantity, bill2_rate, bill2_amount) VALUES"
                    . "(" . $this->nBill . "," . $cSNo . "," . $this->nCode[$nCtr] . "," . $this->nQuantity[$nCtr] . "," . $this->nRate[$nCtr] . "," . $this->nAmount[$nCtr] . ")";
            $this->nCount = $this->cnConn->exec($cQuery1);
        }
            if ($this->nFlag == "Y") {
                $this->message = $this->message . "*Records Updated Successfully";
            } else {
                $this->message = $this->message . "*New Record Inserted Succeessfully";
            }
    }

    public function search() {
        $this->cStatement = $this->cnConn->prepare("SELECT bill1_no, bill1_date, bill1_customercode, bill1_total, bill1_discount1, bill1_discount2, "
                . "bill1_gst1, bill1_gst2, bill1_grandtotal, cus_name FROM bill1 LEFT JOIN customer ON cus_code = bill1_customercode "
                . "WHERE bill1_no=" . $this->nBill);
        $this->cQuery_execute = $this->cStatement->execute();
        $result = $this->cStatement->fetch(PDO::FETCH_ASSOC);

        if ($result != false) {
            $this->nBill = $result["bill1_no"];
            $this->nDate = $result["bill1_date"];
            $this->nCustomerCode = $result["bill1_customercode"];
            $this->cName = $result["cus_name"];
            $this->nTotal = $result["bill1_total"];
            $this->nDiscount1 = $result["bill1_discount1"];
            $this->nDiscount2 = $result["bill1_discount2"];
            $this->nGst1 = $result["bill1_gst1"];
            $this->nGst2 = $result["bill1_gst2"];
            $this->nGrandTotal = $result["bill1_grandtotal"];
            $this->nFlag = 'Y';
            $sql = "SELECT bill2_sl_no, bill2_it_code, bill2_quantity, bill2_rate, bill2_amount, itm_description FROM bill2 LEFT JOIN item ON "
                    . "itm_code = bill2_it_code WHERE bill2_bill1_no=" . $this->nBill;
            $nCtr = 0;

            foreach ($this->cnConn->query($sql) as $row1) {
                $this->cSNo[$nCtr] = $row1["bill2_sl_no"];
                $this->nCode[$nCtr] = $row1["bill2_it_code"];
                $this->cTableName[$nCtr] = $row1["itm_description"];
                $this->nQuantity[$nCtr] = $row1["bill2_quantity"];
                $this->nRate[$nCtr] = $row1["bill2_rate"];
                $this->nAmount[$nCtr] = $row1["bill2_amount"];
                $nCtr++;
            }
        } else {
            $this->error = "*No Record Found";
        }
    }

    public function billDelete() {
        $sql = "DELETE FROM bill1 WHERE bill1_no=" . $this->nBill;
        $this->cnConn->exec($sql);
        $sql2 = "DELETE FROM bill2 WHERE bill2_bill1_no =" . $this->nBill;
        $this->cnConn->exec($sql2);
        $this->message = "*Record deleted successfully";
        $this->nBill = "";
    }

    public function clear() {
        $this->nBill = "";
        $this->nDate = "";
        $this->nCustomerCode = "";
        $this->cName = "";
        $this->nCode = array();
        $this->cTableName = array();
        $this->nQuantity = array();
        $this->nRate = array();
        $this->nAmount = array();
        $this->nTotal = "";
        $this->nDiscount1 = "";
        $this->nDiscount2 = "";
        $this->nGst1 = "";
        $this->nGst2 = "";
        $this->nGrandTotal = "";
        $this->nFlag = "";
    }

}

?>
