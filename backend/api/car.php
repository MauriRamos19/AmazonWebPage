<?php
    
    header("Content-Type: application/json");
    include_once("../classes/class-car.php");
    
    $_POST = json_decode(file_get_contents("php://input"),true);
    switch ($_SERVER["REQUEST_METHOD"]) {
        case 'POST':
            
        
        case 'GET':
            Car::getProductsFromCar($_GET['id']);
            
            break;

        case 'PUT':
        break;

        case 'DELETE':
        break;
    
    
    
    
    
    }   


?>