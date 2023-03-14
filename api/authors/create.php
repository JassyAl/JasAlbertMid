<?php

     //Headers
     header('Access-Control-Allow-Origin: *');
     header('Content-Type: application/json');
     header('Access-Control-Allow-Methods: POST');
     header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');
 
     include_once '../../config/Database.php';
     include_once '../../models/Author.php';
 
     //Instantiate DB & connect
     $database = new Database();
     $db = $database->connect(); // the one we created
 
     //Instantiate author obj
     $auth = new Author($db);

     // Get raw author data
     $data = json_decode(file_get_contents("php://input"));

     // assign data to author
     $auth->author = $data->author;
     
     // Create author
     if($auth->create()) {
        echo json_encode(
            array('message' => 'Author Created')
        );
     } else {
        echo json_encode(
            array('message' => 'Author Not Created')
        );
     }