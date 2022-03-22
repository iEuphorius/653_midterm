<?php
    include_once '../../config/database.php';
    include_once '../../models/author.php';

    // Instantiate DC & connect

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
print_r(json_encode($author_arr));