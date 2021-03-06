<?php
    include_once '../../config/database.php';
    include_once '../../models/category.php';

    // Instantiate DC & connect

$dataBase = new Database();
$db = $dataBase->connect();

// Instantiate category object
$category = new Category($db);

// category query
$result = $category->read();
// Get row count
$num = $result->rowCount();

// Check if any categories
if($num > 0) {
    // categories array
    $category_arr = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        
        $category_item = array(
            'id'=>$id,
            'category'=>$category,
        );

        // Push to "data
        array_push($category_arr, $category_item);
    }

    // Turn to JSON
    echo json_encode($category_arr);
} else {
    // No categories
    echo json_encode(
        array('message'=>'No categories Found')
        )    ;

}