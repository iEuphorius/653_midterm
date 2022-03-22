<?php
    include_once '../../config/database.php';
    include_once '../../models/quote.php';

    // Instantiate DC & connect

$dataBase = new Database();
$db = $dataBase->connect();

// Instantiate quote object
$quote = new Quote($db);

if(isset($_GET['id'])){
    $_GET['id'];
    // get post
    $result = $quote->read_single();

    // create array
    $quote_arr = array(
        'id'=>$id,
        'quote'=> $quote,
        'categoryId'=>$categoryId,                
        'authorId'=>$authorId            
    );

    // make json data
    print_r(json_encode($quote_arr));
} else{
    // quotes query
    $result = $quote->read();
    // Get row count
    $num = $result->rowCount();

    // Check if any quotes
    if($num > 0) {
        // quote array
        $quote_arr = array();
        $quote_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            
            $quote_item = array(
                'id'=>$id,
                'quote'=> $quote,
                'categoryId'=>$categoryId,                
                'authorId'=>$authorId            
            );

            // Push to "data
            array_push($quote_arr['data'], $quote_item);
        }

        // Turn to JSON
        echo json_encode($quote_arr);
    } else {
        // No posts
        echo json_encode(
            array('message'=>'No Posts Found')
            )    ;

    }
}