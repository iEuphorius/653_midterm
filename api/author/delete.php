<?php
    include_once '../../config/database.php';
    include_once '../../models/author.php';

    // Instantiate DC & connect

$dataBase = new Database();
$db = $dataBase->connect();

// Instantiate author object
$author = new Author($db);

// get raw author data
$data = json_decode(file_get_contents("php://input"));

// set ID to update
$author->id = $data->id;


// Delete author
if($author->delete()){
    $message = array('id'=>$author->id);
    echo json_encode($message);
} else {
    echo json_encode(
        array('message'=> 'Author not deleted')
    );
}