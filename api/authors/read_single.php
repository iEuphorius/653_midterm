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
    'title'=> $author->title,
    'body'=> $author->body,
    'author'=> $author->author,
    'category_id'=> $author->category_id,
    'category_name'=> $author->category_name
);

// make json data
print_r(json_encode($author_arr));