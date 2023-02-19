<?php

//include_once 'Models/mdlShopCart.php';

class Controller {

    private $pdo;

    public function __construct() {
        
    }

    public function invoke() {



        $page = filter_input(INPUT_GET, 'mdl', FILTER_SANITIZE_SPECIAL_CHARS);

        switch ($page) {

            case "1":

                include_once 'Controllers/ctrlItem.php';
                $ctrlHomecont = new ctrlItem();
                $ctrlHomecont->invoke();
                break;

            case "2":

                include_once 'Controllers/ctrlCustomer.php';
                $ctrlHomecont = new ctrlCustomer();
                $ctrlHomecont->invoke();
                break;

            case "3":

                include_once 'Controllers/ctrlBill.php';
                $ctrlHomecont = new ctrlBill();
                $ctrlHomecont->invoke();
                break;

            case "4":

                include_once 'Controllers/ctrlStatement.php';
                $ctrlHomecont = new ctrlStatement();
                $ctrlHomecont->invoke();
                break;
            
            case "5":

                include_once 'Controllers/ctrlCustomerWise.php';
                $ctrlHomecont = new ctrlCustomerWise();
                $ctrlHomecont->invoke();
                break;
            
            case "6":

                include_once 'Controllers/ctrlCustomerWiseItem.php';
                $ctrlHomecont = new ctrlCustomerWiseItem();
                $ctrlHomecont->invoke();
                break;
            
            default:
                include_once 'Controllers/ctrlMenu.php';
                $ctrlHomeMenu = new ctrlMenu();
                $ctrlHomeMenu->invoke();
        }
    }

}

?>