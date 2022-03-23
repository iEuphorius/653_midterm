<?php
    include_once '../../config/database.php';
    include_once '../../models/author.php';

    // Instantiate DC & connect

$dataBase = new Database();
$db = $dataBase->connect();

// Instantiate blog post object
$quote = new Quote($db);

// get id from url
$quote->id = $_GET['id'];

// get post
$quote->read_single();

// create array
$quote_arr = array(
    'id'=> $quote->id,
    'author'=> $quote->quote,
    'authorId'=> $quote->authorId,
    'categoryId'=> $quote->categoryId,
);

// make json data
print_r(json_encode($quote_arr));