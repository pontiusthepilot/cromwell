<?php
    ini_set('display_errors', 1);   //!!!!!!!!!!!!! 

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: *');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
        
    session_start();

    include_once '../database/Database.php';
    include_once '../models/Address.php';

    $database = new Database();

    $db = $database->connect();

    $address = new Address($db);

    $address->customer_id = $_SESSION['user']['id'];
    $address->contact_name = $_POST['contactname'];
    $address->business_name = $_POST['businessname'];
    $address->address_line1 = $_POST['address_line1'];
    $address->address_line2 = $_POST['address_line2'];
    $address->city = $_POST['city'];
    $address->county = $_POST['county'];
    $address->country = $_POST['country'];
    $address->postcode = $_POST['postcode'];
    $address->address_type = $_POST['addresstype'];

    if ( $address->post() )
    {
        header('Location: ' .$_SERVER['HTTP_REFERER']);
        exit();
    }
    else
    {
        $_SESSION['message'] ='Address creation failed';

        foreach ($address->errors as $key => $error)
        {
            if ($error != 'valid')
            {
                $_SESSION['message'] = $error;
                break;
            }
        }

        header('Location: ' .$_SERVER['HTTP_REFERER']);
        exit();
    }