<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-Width');


    include_once '../../config/database.php';
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


// Delete category
if($category->delete()){
    echo $category->id;
} else {
    echo json_encode(
        array('message'=> 'Category not deleted')
    );
}