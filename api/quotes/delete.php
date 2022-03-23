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

// set ID to update
$quote->id = $data->id;


// Delete quote
if($quote->delete()){
    $message = array('id'=>$quote->id);
    echo json_encode($message);
} else {
    echo json_encode(
        array('message'=> 'Quote not deleted')
    );
}