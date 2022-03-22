<?php
    include_once '../../config/Database.php';
    include_once '../../models/category.php';

    // Instantiate DC & connect

$dataBase = new Database();
$db = $dataBase->connect();

// Instantiate blog post object
$category = new Category($db);

// Blog post query
$result = $category->read();
// Get row count
$num = $result->rowCount();

// Check if any posts
if($num > 0) {
    // Post array
    $category_arr = array();
    $category_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        
        $category_item = array(
            'id'=>$id,
            'author'=>$author,
        );

        // Push to "data
        array_push($category_arr['data'], $category_item);
    }

    // Turn to JSON
    echo json_encode($category_arr);
} else {
    // No posts
    echo json_encode(
        array('message'=>'No Posts Found')
        )    ;

}