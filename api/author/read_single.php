<?php

//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Author.php';

//Instantiate DB & connect
$database = new Database();
$db = $database->connect(); // the one we created

//Instantiate author obj
$auth = new Author($db);

// Get ID from URL
$auth->id = isset($_GET['id']) ? $_GET['id'] : die();

// Get author
$auth->read_single();

// Check if author is found
if ($auth->author) {
    // Create array
    $author_arr = array(
        'id' => $auth->id,
        'author' => $auth->author
    );

    // Make JSON
    print_r(json_encode($author_arr)); //prints an array but wraps it
} else {
    // No Authors
    echo json_encode(
        array('message' => 'author_id Not Found')
    );
}
