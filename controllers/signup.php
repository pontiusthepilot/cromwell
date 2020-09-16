<?php
        ini_set('display_errors', 1);   //!!!!!!!!!!!!! 

        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        header('Access-Control-Allow-Methods: *');
        header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
          
        session_start();
    
        include_once '../database/Database.php';
        include_once '../models/Customer.php';

        $database = new Database();

        $db = $database->connect();
    
        $customer = new Customer($db);

        $customer->forenames = $_POST['forenames'];
        $customer->surname = $_POST['surname'];
        $customer->title = $_POST['title'];
        $customer->date_of_birth = $_POST['dateofbirth'];
        $customer->mobile_number = $_POST['mobilenumber'];
        $customer->phone_number = $_POST['phonenumber'];
        $customer->email_address = $_POST['emailaddress'];
        $customer->password = $_POST['password'];
        $customer->repeatpassword = $_POST['repeatpassword'];

        if ( $customer->post() )
        {
            header('Location: ../index.php');
            exit();
        }
        else
        {
            $_SESSION['message'] ='Account creation failed';
            header('Location: ../views/signup.php');
            exit();

        }