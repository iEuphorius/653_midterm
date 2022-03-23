<?php
    include_once '../../config/database.php';
    include_once '../../models/author.php';

    // Instantiate DC & connect
if($_GET['id'] != null){
    $dataBase = new Database();
    $db = $dataBase->connect();

    // Instantiate blog post object
    $author = new Author($db);

    // get id from url
    $author->id = $_GET['id'];

    // get post
    $author->read_single();

    // create array
    $author_arr = array(
        'id'=> $author->id,
        'author'=> $author->author
    );

    // make json data
    echo json_encode($author_arr);
} else {
    echo json_encode(
        array('message'=>'authorId Not Found')
        );
}