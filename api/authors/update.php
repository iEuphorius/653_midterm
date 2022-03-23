<?php
    include_once '../../config/database.php';
    include_once '../../models/author.php';

    // Instantiate DC & connect

$dataBase = new Database();
$db = $dataBase->connect();

// Instantiate category object
$author = new Author($db);

// get raw category data
$data = json_decode(file_get_contents("php://input"));

// set ID to update
$author->id = $data->id;
$author->author = $data->author;

// update category
if($category->update()){
    $message = array(
        'id' => $author->id,
        'author' => $author->author
    );
    echo json_encode($message);
} else {
    echo json_encode(
        array('message'=> 'Author not Updated')
    );
}