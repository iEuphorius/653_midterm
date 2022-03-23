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

$quote->quote = $data->quote;
$quote->authorId = $data->authorId;
$quote->categoryId = $data->categoryId;

// create quote
if($quote->create()){
    $lastId = $db->lastInsertId();
    $message = array(
        'id' => $lastId,
        'quote' => $quote,
        'authorId' => $quote->authorId,
        'categoryId' => $quote->categoryId
    );
    echo json_encode(
        array($lastId,$quote->quote,$quote->authorId,$quote->categoryId)
    );
} else {
    echo json_encode(
        array('message'=> 'quote not Created')
    );
}