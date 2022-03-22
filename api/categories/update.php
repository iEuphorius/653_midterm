<?php
    include_once '../../config/Database.php';
    include_once '../../models/category.php';

    // Instantiate DC & connect

$dataBase = new Database();
$db = $dataBase->connect();

// Instantiate category object
$category = new Category($db);

// get raw category data
$data = json_decode(file_get_contents("php://input"));

// set ID to update
$category->id = $data->id;
$category->category = $data->category;

// update category
if($category->update()){
        echo "updated category(" . $category->id . "," . $category->category . ")";
} else {
    echo json_encode(
        array('message'=> 'Category not Updated')
    );
}