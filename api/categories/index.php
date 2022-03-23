<?php

    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method === 'OPTIONS') {
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
        header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
        header("HTTP/1.1 200 OK");
    }

    include_once '../../config/database.php';
    include_once '../../models/category.php';

    $database = new Database();
    $db = $database->connect();


    switch ($method) {
        case "GET":
            if($_GET['id'] != null) {
                require_once('read_single.php');
                break;
            }
            require_once('read.php');
            break;
        case "POST":
            if(isset($_GET['category']) == null){
                echo json_encode(array('message'=> 'Missing Required Parameters'));
                break;
            } else{
            require_once('create.php');
            break;
            }
        case "PUT":
            if(isset($_GET['category']) == null){
                echo json_encode(array('message'=> 'Missing Required Parameters'));
                break;
            } else{
                require_once('update.php');
                break;
            }
        case "DELETE":
            require_once('delete.php');
            break;
        default:
            http_response_code(404);
            break;        
    }