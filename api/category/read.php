<?php

    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Category.php';

    //Instantiate DB & connect
    $database = new Database();
    $db = $database->connect(); // the one we created

    //Instantiate category category obj
    $cat = new Category($db);

    //call read function
    //Category query
    $result = $cat->read();
    //Get row count using method rowCount()
    $num = $result->rowCount();

    // //Check if any categories
    // if($num > 0){
    //     // Category array
    //     $category_arr = array();

    //     while($row = $result->fetch(PDO::FETCH_ASSOC)) {
    //         extract($row);

    //         $category_item = array(
    //             'id' => $id,
    //             'category' => $category
    //         );

    //         // Push to 'data'
    //         array_push($category_arr, $category_item);
    //     }

    //     // Turn to JSON & output
    //     echo json_encode($category_arr);
    // } else {
    //     // No Categories
    //     echo json_encode(
    //         array('message' => 'No Categories Found')
    //     );
    // }

    // new coding
    if($num > 0){
        $category_arr = array();
        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          // Push to "data"
          array_push($category_arr, ['id'=>$id, 'category' => $category]);
        }

        // Turn to JSON & output
        echo json_encode($category_arr);

  } else {
        // No Categories
        echo json_encode(
          array('message' => 'No Categories Found')
        );
    }


