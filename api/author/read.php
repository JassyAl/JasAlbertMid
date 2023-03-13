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

    //call read function
    //Author query
    $result = $auth->read();
    //Get row count using method rowCount()
    $num = $result->rowCount();

    //Check if any authors
    if($num > 0){
        // Author array
        $author_arr = array();
        //return array with data
        $author_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $author_item = array(
                'id' => $id,
                'author' => $author
            );

            // Push to 'data'
            array_push($author_arr['data'], $author_item);
        }

        // Turn to JSON & output
        echo json_encode($author_arr);
    } else {
        // No Authors
        echo json_encode(
            array('message' => 'No Authors Found')
        );
    }
