<?php

class clsItem {

    public $nCode = "";
    public $cDescription = "";
    public $nRate = "";
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
//        $cSql = " INSERT Query";
//        $this->pdo->query($cSql);

        if ($this->nFlag == "Y") {
            $sql = "UPDATE item SET itm_description='" . $this->cDescription . "', rate='" . $this->nRate . "' WHERE itm_code=" . $this->nCode;
        } else {
            $sql = "INSERT INTO item (itm_code, itm_description, rate) VALUES (:itm_code, :itm_description, :rate)";
        } if ($sql != "") {
            $stmt = $this->pdo->prepare($sql);
            $data = [":itm_code" => $this->nCode, ":itm_description" => $this->cDescription, ":rate" => $this->nRate];

            $stmt->execute($data);
            if ($this->nFlag == "Y") {
                $this->message = $this->message . "Records Updated Successfully";
            } else {
                $this->message = $this->message . "New Record Inserted Succeessfully";
            }
            $this->nCode = $this->cDescription = $this->nRate = "";
        }
    }

    public function read() {

        $stmt = $this->pdo->prepare("SELECT itm_code, itm_description, rate FROM item WHERE itm_code =" . $this->nCode);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row != false) {
            $this->nCode = $row["itm_code"];
            $this->cDescription = $row["itm_description"];
            $this->nRate = $row["rate"];

            $this->nFlag = "Y";
        } else {
            $this->message = $this->message . "Oops! Code: " . $this->nCode . " is not exist.";
            $this->nCode = "";
        }
    }

    public function delete() {
        $sql = "DELETE FROM item WHERE itm_code=" . $this->nCode;
        if ($this->pdo->exec($sql)) {
            $this->message = $this->message . "Record deleted successfully";
            $this->nCode = "";
        } else {
            $this->message = $this->message . "Opps! code: " . $this->nCode . " is not exist.";
            $this->nCode = "";
        }
    }

    public function clear() {
        $this->nCode = "";
        $this->cDescription = "";
        $this->nRate = "";
        $this->nFlag = "";
    }

}

?>
