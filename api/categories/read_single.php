<?php

//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Category.php';

//Instantiate DB & connect
$database = new Database();
$db = $database->connect(); // the one we created

//Instantiate Category obj
$cat = new Category($db);

// Get ID from URL
$cat->id = isset($_GET['id']) ? $_GET['id'] : die();

// Get Category
$cat->read_single();

// Check if Category is found
if ($cat->category) {
    // Create array
    $category_arr = array(
        'id' => (int)$cat->id,
        'category' => $cat->category
    );
    echo json_encode($category_arr);
    // Make JSON
    // print_r(json_encode($category_arr)); //prints an array but wraps it
    } else {
        // No Categories
        echo json_encode(
            array('message' => 'category_id Not Found')
        );
    }
