<?php

    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method === 'OPTIONS') {
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
        header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
    }

    include_once '../../config/database.php';
    include_once '../../models/author.php';

    $database = new Database();
    $db = $database->connect();


    

    switch ($method) {
        case "GET":
            if($_GET['id'] != null) {
                require_once('read_single.php');
            }
            require_once('read.php');
            break;
        case "POST":
            require_once('create.php');
            break;
        case "PUT":
            require_once('update.php');
            break;
        case "DELETE":
            require_once('delete.php');
            break;
        default:
            http_response_code(404);
            break;        
    }