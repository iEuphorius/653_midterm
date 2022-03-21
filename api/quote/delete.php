<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
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

// set ID to update
$quote->id = $data->id;


// Delete quote
if($quote->delete()){
    echo $quote->id;
} else {
    echo json_encode(
        array('message'=> 'Quote not deleted')
    );
}