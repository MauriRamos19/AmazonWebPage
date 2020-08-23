<?php
    
    header("Content-Type: application/json");
    include_once("../classes/class-product.php");
    $_POST = json_decode(file_get_contents("php://input"),true);
    switch ($_SERVER["REQUEST_METHOD"]) {
        case 'POST':
            $post = new Product(
                $_POST['productID'],
                $_POST['categoryID'],
                $_POST['name'],
                $_POST['brand'],
                $_POST['image'],
                $_POST['price'],
                $_POST['calification']
            );
            $post->addProduct($_GET['id']);
            break;

        case 'GET':
           

        case 'PUT':
            $_PUT = json_decode(file_get_contents("php://input"),true);
            $delete = new Product(
                $_PUT['productID'],
                $_PUT['categoryID'],
                $_PUT['name'],
                $_PUT['brand'],
                $_PUT['image'],
                $_PUT['price'],
                $_PUT['calification']
            );
            $delete->deleteUserProd($_GET['id']);
        break;

        case 'DELETE':
            $_DELETE = json_decode(file_get_contents("php://input"),true);
             Product::deleteProduct($_DELETE['index'],$_DELETE['userID'],$_DELETE['categoryID']);
        
            
            
        break;
    
    
    
    
    
    }   




?>