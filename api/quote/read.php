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

    // Quote query
    $result = $quotes->read();
    // Get row count
    $num = $result->rowCount();

    // Check for quotes
    if($num > 0) {
        $quotes_arr = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $quote_item = array(
                'id' => $id,
                'quote' => $quote,
                'author_id' => $author_id,
                'category_id' => $category_id
            );

            // Push to "data"
            array_push($quotes_arr, $quote_item);
        } 

        // Convert to JSON & output
        echo json_encode($quotes_arr);
    }
       else {
            // No Quotes
            echo json_encode(
            array('message' => 'No Quotes Found')
            );
        }
    
?>