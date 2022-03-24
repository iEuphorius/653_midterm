<?php
    include_once '../../config/database.php';
    include_once '../../models/quote.php';

    // Instantiate DC & connect

$dataBase = new Database();
$db = $dataBase->connect();

// Instantiate quote object
$quote = new Quote($db);

// get raw quote data
$data = json_decode(file_get_contents("php://input"));

if($data->quote == null){
    echo json_encode(array('message'=> 'Missing Required Parameters'));
} else {

    $quote->quote = $data->quote;
    $quote->authorId = $data->authorId;
    $quote->categoryId = $data->categoryId;

    // create quote
    if($quote->create()){
        $lastId = $db->lastInsertId();
        $message = array(
            'id' => $lastId,
            'quote' => $quote->quote,
            'authorId' => $quote->authorId,
            'categoryId' => $quote->categoryId
        );
        echo json_encode(
            array($message)
        );
    } else {
        echo json_encode(
            array('message'=> 'quote not Created')
        );
    }
}