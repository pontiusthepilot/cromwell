<?php
    ini_set('display_errors', 1);   //!!!!!!!!!!!!! 

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: *');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
      
    session_start();

    include_once '../database/Database.php';
    include_once '../models/Customer.php';

    $email = $_POST['email'];
    $password = $_POST['password'];

    $database = new Database();

    $db = $database->connect();

    $customer = new Customer($db);

    $customer->email_address = $email;
    $customer->password = $password;

    $rtnData = $customer->getCustomerForLogin()->fetch(PDO::FETCH_ASSOC);

    // if (password_verify($customer->password, $rtnData['password'])) {

    if ($customer->password == $rtnData['password']) {
        $_SESSION['user'] = $rtnData;
        header('Location: ../views/home.php');
        exit();
    } else {
        header('Location: ../index.php?message=Incorrect email or password');
        exit();
    }


