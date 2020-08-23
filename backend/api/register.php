<?php
    session_start();
    header("Content-Type: application/json");
    include_once("../classes/class-user.php");
    
    $_POST = json_decode(file_get_contents("php://input"),true);
    switch ($_SERVER["REQUEST_METHOD"]) {
        case 'POST':
            $post = new User($_POST['name'],$_POST['email'],$_POST['password'],$_POST['permission']);
            $post->addUser();
        break;
        case 'GET':
        break;

        case 'PUT':
        break;

        case 'DELETE':
        break;
    
    
    
    
    
    }   

?>