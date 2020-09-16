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

    $address->id = $_GET['id'];

    if ( $address->delete() )
    {
        $_SESSION['message'] ='Address deleted';
        header('Location: ' .$_SERVER['HTTP_REFERER']);
        exit();
    }
    else
    {
        $_SESSION['message'] ='Address deletion failed';
        header('Location: ' .$_SERVER['HTTP_REFERER']);
        exit();
    }