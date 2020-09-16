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
    $address->contact_name = $_GET['contactname'];
    $address->business_name = $_GET['businessname'];
    $address->address_line1 = $_GET['addressline1'];
    $address->address_line2 = $_GET['addressline2'];
    $address->postcode = $_GET['postcode'];

    $rtnData = $address->get()->fetch(PDO::FETCH_ASSOC);

    if ( $rtnData )
    {
        $addressarray = array();

        $addressarray['id'] = $rtnData['id'];
        $addressarray['customer_id'] = $rtnData['customer_id'];
        $addressarray['contact_name'] = $rtnData['contact_name'];
        $addressarray['business_name'] = $rtnData['business_name'];
        $addressarray['address_line1'] = $rtnData['address_line1'];
        $addressarray['address_line2'] = $rtnData['address_line2'];
        $addressarray['city'] = $rtnData['city'];
        $addressarray['county'] = $rtnData['county'];
        $addressarray['country'] = $rtnData['country'];
        $addressarray['postcode'] = $rtnData['postcode'];
        $addressarray['address_type'] = $rtnData['address_type'];

        $_SESSION['address'] = $addressarray;

        header('Location: ../views/address.php');
        exit();
    }
    else
    {
        $_SESSION['message'] ='Address not found';
        header('Location: ../views/address.php');
        exit();
    }