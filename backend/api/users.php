<?php
    
    header("Content-Type: application/json");
    include_once("../classes/class-user.php");
    
    $_POST = json_decode(file_get_contents("php://input"),true);
    switch ($_SERVER["REQUEST_METHOD"]) {
        case 'POST':
            
            break;
        
        case 'GET':
            if(isset($_GET['userID'])){
                User::getUser($_GET['userID']);
            }else{
                User::getAllUsers();
            }
            
            break;

        case 'PUT':
        break;

        case 'DELETE':
        break;
    
    
    
    
    
    }   




?>