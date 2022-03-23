<?php
    include_once '../../config/database.php';
    include_once '../../models/category.php';

    // Instantiate DC & connect

$dataBase = new Database();
$db = $dataBase->connect();

// Instantiate quote object
$quote = new Quote($db);

// get raw quote data
$data = json_decode(file_get_contents("php://input"));

// set ID to update
$quote->id = $data->id;
$quote->category = $data->quote;

// update quote
if($quote->update()){
    echo json_encode(
        array('message'=> 'Quote Updated')
    );
} else {
    echo json_encode(
        array('message'=> 'quote not Updated')
    );
}