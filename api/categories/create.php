<?php

     //Headers
     header('Access-Control-Allow-Origin: *');
     header('Content-Type: application/json');
     header('Access-Control-Allow-Methods: POST');
     header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods, categoryization, X-Requested-With');
 
     include_once '../../config/Database.php';
     include_once '../../models/Category.php';
 
     //Instantiate DB & connect
     $database = new Database();
     $db = $database->connect(); // the one we created
 
     //Instantiate category obj
     $cat = new Category($db);

     // Get raw category data
     $data = json_decode(file_get_contents("php://input"));

     // assign data to category
     $cat->category = $data->category;
     
     // Create category
     if($cat->create()) {
        echo json_encode(
            array('message' => 'Category Created')
        );
     } else {
        echo json_encode(
            array('message' => 'Category Not Created')
        );
     }