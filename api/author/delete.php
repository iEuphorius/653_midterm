<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-Width');


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
    echo $author->id;
} else {
    echo json_encode(
        array('message'=> 'Author not deleted')
    );
}