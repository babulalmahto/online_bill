<?php

include_once 'dbconn.php';

//$tablename = '';
//$rate = '';
$data = array();

if (isset($_GET['mode'])) {
    $input = $_GET['mode'];

    $cQuery = "SELECT itm_description FROM item WHERE itm_code = " . $input;
    $cStatement = $pdo->prepare($cQuery);
    $cStatement->execute();
    while ($result = $cStatement->fetch(PDO::FETCH_ASSOC)) {
        $data[] = array("txtName" => $result['itm_description']);
    }
    echo json_encode($data);
}