<?php

include_once 'dbconn.php';

$name = '';
$tablename = '';
$rate = '';
//$cQuery = '';
$data = array();

if (isset($_GET['mode'])) {
    $input = $_GET['mode'];

    $cQuery = "SELECT cus_name FROM customer WHERE cus_code = " . $input;
    $cStatement = $pdo->prepare($cQuery);
    $cStatement->execute();
    while ($result = $cStatement->fetch(PDO::FETCH_ASSOC)) {
        $data[] = array("txtName" => $result['cus_name']);
    }
    echo json_encode($data);
}