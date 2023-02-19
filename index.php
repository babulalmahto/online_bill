<?php
//
session_start();
include_once 'Controllers/ctrlController.php';
$ctrlHomecont = new Controller();
$ctrlHomecont->invoke();
?>
