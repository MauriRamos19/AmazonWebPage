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
            $post->addProductToCar($_GET['id']);
            break;

        case 'GET':
            if(isset($_GET['categoryID'])){
                Product::getProductsByDepartment($_GET['categoryID']);
            }else{
                Product::getProducts();
               
            }

        case 'PUT':
        break;

        case 'DELETE':
            $_DELETE = json_decode(file_get_contents("php://input"),true);
            //Product::deleteUserProd($_DELETE['userID'],$_DELETE['productID']);
            $delete = new Product(
                $_DELETE['productID'],
                $_DELETE['categoryID'],
                $_DELETE['name'],
                $_DELETE['brand'],
                $_DELETE['image'],
                $_DELETE['price'],
                $_DELETE['calification']
            );
            $delete->deleteUserProd($_GET['id']);
            break;
        break;
    
    
    
    
    
    }   




?>