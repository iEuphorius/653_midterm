<?php
    include_once '../../config/database.php';
    include_once '../../models/category.php';

    // Instantiate DC & connect

$dataBase = new Database();
$db = $dataBase->connect();

// Instantiate category object
$category = new Category($db);

// get raw category data
$data = json_decode(file_get_contents("php://input"));

if($data->category == null){
    echo json_encode(array('message'=> 'Missing Required Parameters'));
} else {

    $category->category = $data->category;

    // create category
    if($category->create()){
        $lastId = $db->lastInsertId();
        $message = array(
            'id' => $lastId,
            'category' => $category->category
        );
        echo json_encode($message);
    } else {
        echo json_encode(
            array('message'=> 'Category not Created')
        );
    }
}