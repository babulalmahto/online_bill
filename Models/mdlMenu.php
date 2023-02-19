<?php

class clsMenu {


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

}
?>