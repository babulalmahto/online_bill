<?php

include_once 'dbconn.php';

//$tablename = '';
//$rate = '';
$data = array();

if (isset($_GET['mode'])) {
    $input = $_GET['mode'];

    $cQuery = "SELECT bill1_date, bill1_no, bill1_total, bill1_discount2, bill1_gst2, bill1_grandtotal FROM item WHERE itm_code = " . $input;
    $cStatement = $pdo->prepare($cQuery);
    $cStatement->execute();
    while ($result = $cStatement->fetch(PDO::FETCH_ASSOC)) {
        $data[] = array("txtDate" => $result['bill1_date'], "txtBillNo" => $result['bill1_no'], "txtGross" => $result['bill1_total'], "txtDisc" => $result['bill1_discount2'], "txtGst" => $result['bill1_gst2'], "txtNet" => $result['bill1_grandtotal']);
    }
    echo json_encode($data);
}