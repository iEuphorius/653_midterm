<?php
    include_once '../../config/database.php';
    include_once '../../models/quote.php';

    // Instantiate DC & connect

$dataBase = new Database();
$db = $dataBase->connect();

// Instantiate quote object
$quote = new Quote($db);

// quotes query
$result = $quote->read();

// Get row count
$num = $result->rowCount();

    // Check if any quotes
if($num > 0) {
    // quote array
    $quote_arr = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
            
        $quote_item = array(
            'id'=> $id,
            'quote'=> $quote,
            'category'=> $categoryName,                
            'author'=> $authorName          
        );

        // Push to "data
        array_push($quote_arr, $quote_item);
    }

    // Turn to JSON
    echo json_encode($quote_arr);
} 