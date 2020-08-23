<?php
    
    class Car{
        
        private $productID;
        private $categoryID;
        private $name;
        private $brand;
        private $image;
        private $price;
        private $calification;
        


        public function __construct(
            $productID,
            $categoryID,
            $userID,
            $name,
            $brand,
            $image,
            $price,
            $calification

        ){
            $this->productID=$productID;
            $this->categoryID=$categoryID;
            $this->userID=$userID;
            $this->name=$name;
            $this->brand=$brand;
            $this->image=$image;
            $this->price=$price;
            $this->calification=$calification;
        
        }


        public static function getProductsFromCar($userID){
            $fileContent = file_get_contents('../data/users.json');
            $users = json_decode($fileContent,true);
            $user = null;
            for ($i=0; $i < sizeof($users) ; $i++) { 
                if($users[$i]['userID']==$userID){
                    $user = $users[$i];
                    break;
                }
            }


            $fileContentProducts = file_get_contents('../data/products.json');
            $products = json_decode($fileContentProducts,true);
            $result = array();
            for ($i=0; $i < sizeof($products); $i++) { 
                if(in_array($products[$i]['productID'],$user['car'])){
                    $result[] = $products[$i];
                }
            }

            echo json_encode($result);

        } 




    }




?>