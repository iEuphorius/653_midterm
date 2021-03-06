<?php
    include_once '../../config/database.php';
    include_once '../../models/author.php';

    // Instantiate DC & connect

$dataBase = new Database();
$db = $dataBase->connect();

// Instantiate blog post object
$author = new Author($db);

// Blog post query
$result = $author->read();
// Get row count
$num = $result->rowCount();

// Check if any author
if($num > 0) {
    // author array
    $author_arr = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        
        $author_item = array(
            'id'=>$id,
            'author'=>$author,
        );

        // Push to "data
        array_push($author_arr, $author_item);
    }

    // Turn to JSON
    echo json_encode($author_arr);
} else {
    // No author
    echo json_encode(
        array('message'=>'No Authors Found')
        );

}