<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-Width');


    include_once '../../config/database.php';
    include_once '../../models/quote.php';

    // Instantiate DC & connect

$dataBase = new Database();
$db = $dataBase->connect();

// Instantiate quote object
$quote = new Quote($db);

// get raw quote data
$data = json_decode(file_get_contents("php://input"));

$quote->quote = $data->quote;
$quote->authorId = $data->authorId;
$quote->categoryId = $data->categoryId;

// create quote
if($quote->create()){
    $lastId = $db->lastInsertId();
    echo json_encode(
        array(
            "id"=>$lastId,
            "quote"=>$quote->quote,
            "authorId"=>$quote->authorId,
            "categoryId"=>$quote->categoryId
        )
    );
} else {
    echo json_encode(
        array('message'=> 'quote not Created')
    );
}