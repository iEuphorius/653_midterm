<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
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
$author->author = $data->author;

// create author
if($author->create()){
    $lastId = $db->lastInsertId();
    echo "created author(" .$lastId . "," . $author->author . ")";
} else {
    echo json_encode(
        array('message'=> 'Author not Created')
    );
}