<?php
    header("Access-Control-Allow-Origin:*");
    header("Content-Type: application/json;");
    header("Access-Control-Allow-Methods: *");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config.php';
    include_once './book.php';

    $database = new DB();
    $db = $database->getConnection();

    $book = new Book($db);
    if(count($_FILES) > 0) {
        if($_FILES["post_img"]){
            $book->image=$_FILES["image"]["name"];
            move_uploaded_file($_FILES["image"]["tmp_name"], "../upload/" . $_FILES["image"]["name"]);
        }
       
    }

    $book->id= $_POST["id"];
    $book->title=$_POST["title"];
    $book->author=$_POST["author"];
    $book->description=$_POST["description"];
    
    
    

    if($book->updateBook()){
        echo json_encode("post update.");

    } else{
        echo json_encode("Failed to create post.");
    }
?>