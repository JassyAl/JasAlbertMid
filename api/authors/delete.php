<?php

     //Headers
     header('Access-Control-Allow-Origin: *');
     header('Content-Type: application/json');
     header('Access-Control-Allow-Methods: DELETE');
     header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,
            Access-Control-Allow-Methods, Authorization, X-Requested-With');
 
     include_once '../../config/Database.php';
     include_once '../../models/Author.php';
 
     //Instantiate DB & connect
     $database = new Database();
     $db = $database->connect(); // the one we created
 
     //Instantiate blog author obj
     $author = new Author($db);

     // Get raw authored date
     $data = json_decode(file_get_contents("php://input"));

     // Set ID to delete
     $author->id = $data->id;
     
     // Delete author
     if($author->delete()) {
        echo json_encode(
            array('message' => 'Author Deleted')
        );
     } else {
        echo json_encode(
            array('message' => 'Author Not Deleted')
        );
     }