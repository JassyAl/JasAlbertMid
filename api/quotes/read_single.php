<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    
    include_once '../../config/Database.php';
    include_once '../../models/Quote.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate quotes
    $quotes = new Quote($db);

    // Get ID from URL
    $quotes->id = isset($_GET['id']) ? $_GET['id'] : die();

    // Get post
    $quotes->read_single();

// Check for quote
if ($quotes->quote) {
    // Create array
    $quote_arr = array(
        'id' => $quotes->id,
        'quote' => $quotes->quote,
        'author_id' => $quotes->author_id,
        'category_id' => $quotes->category_id
    );
    // Make JSON   
    print_r(json_encode($quote_arr)); //prints an array but wraps it
} else {
    // No Quotes
    echo json_encode(
        array('message' => 'No Quotes Found')
    );
}
