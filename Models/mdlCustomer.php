<?php

class clsCustomer {

    public $nCode = "";
    public $cName = "";
    public $cAddress = "";
    public $nJoined = "";
    public $nFlag = "";
    public $error = "";
    public $message = "";
    public $pdo;

    public function __construct() {
        $this->pdo = $this->dbconnect();
    }

    public function dbconnect() {
        $dsn = 'mysql:host=localhost;dbname=my_training';
        $user = 'root';
        $passwd = 'mysql123';

        try {
            $pdo = new PDO($dsn, $user, $passwd);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Could not connect to the database: ' . $e->getMessage());
//echo "Connection failed: " . $e->getMessage();
        }
        return $pdo;
    }

    public function save() {
//        $cSql = " INSERT Query";customer
//        $this->pdo->query($cSql);

        if ($this->nFlag == "Y") {
            $sql = "UPDATE customer SET cus_name='" . $this->cName . "', address='" . $this->cAddress . "', joined='" . $this->nJoined . "' WHERE cus_code=" . $this->nCode;
        } else {
            $sql = "INSERT INTO customer (cus_code, cus_name, address, joined) VALUES (:cus_code, :cus_name, :address, :joined)";
        } if ($sql != "") {
            $stmt = $this->pdo->prepare($sql);
            $data = [":cus_code" => $this->nCode, ":cus_name" => $this->cName, ":address" => $this->cAddress, ":joined" => $this->nJoined];

            $stmt->execute($data);
            if ($this->nFlag == "Y") {
                $this->message = $this->message . "Records Updated Successfully";
            } else {
                $this->message = $this->message . "New Record Inserted Succeessfully";
            }
            $this->nCode = $this->cName = $this->cAddress = $this->nJoined = "";
        }
    }

    public function search() {

        $stmt = $this->pdo->prepare("SELECT cus_code, cus_name, address, joined FROM customer WHERE cus_code =" . $this->nCode);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row != false) {
            $this->nCode = $row["cus_code"];
            $this->cName = $row["cus_name"];
            $this->cAddress = $row["address"];
            $this->nJoined = $row["joined"];

            $this->nFlag = "Y";
        } else {
            $this->message = $this->message . "Oops! Code: " . $this->nCode . " is not exist.";
            $this->nCode = "";
        }
    }

    public function delete() {
        $sql = "DELETE FROM customer WHERE cus_code=" . $this->nCode;
        if ($this->pdo->exec($sql)) {
            $this->message = $this->message . "Record deleted successfully";
            $this->nCode = "";
        } else {
            $this->message = $this->message . "Opps! code: " . $this->nCode . " is not exist.";
            $this->nCode = "";
        }
    }

    public function clear() {
        $this->Code = "";
        $this->cName = "";
        $this->cAddress = "";
        $this->nJoined = "";
        $this->nFlag = "";
    }

}

?>
