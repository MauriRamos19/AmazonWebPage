<?php
    class Product{
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
            $name,
            $brand,
            $image,
            $price,
            $calification

        ){
            $this->productID=$productID;
            $this->categoryID=$categoryID;
            $this->name=$name;
            $this->brand=$brand;
            $this->image=$image;
            $this->price=$price;
            $this->calification=$calification;
        }



        public function getProducts(){
            $fileContent = file_get_contents('../data/products.json');
            echo $fileContent;
        }

        public static function getProductsByDepartment($categoryID){
            $fileContent = file_get_contents('../data/departments.json');
            $departments = json_decode($fileContent,true);
            $department = null;
            for ($i=0; $i < sizeof($departments) ; $i++){ 
                if($departments[$i]['categoryID']==$categoryID){
                    $department = $departments[$i];
                    break;
                }
            }

            $fileContentProducts = file_get_contents('../data/products.json');
            $products = json_decode($fileContentProducts,true);
            $resultProducts = array();
            for ($i=0; $i <sizeof($products) ; $i++) { 
                if(in_array($products[$i]['productID'],$department['products'])){
                    $resultProducts[] = $products[$i];
                }
            }

            echo json_encode($resultProducts);
        }


        public function addProductToCar($userID){
            $fileContent = file_get_contents('../data/users.json');
            $users = json_decode($fileContent,true);
            for ($i=0; $i < sizeof($users); $i++) { 
                if($users[$i]['userID']==$userID){
                    $users[$i]['car'][] = $this->productID;
                break;
                }
            }

            $file = fopen('../data/users.json','w');
            fwrite($file, json_encode($users));
            fclose($file);

            echo json_encode($users);
        }


        public function addProduct($userID){
            $fileContent = file_get_contents('../data/products.json');
            $products = json_decode($fileContent,true);
            $count = 0;
            for ($i=0; $i < sizeof($products)+1; $i++) { 
                $count = $count + 1; 
            }
            $products[] = array(
                "productID" => $count,
                "categoryID" => $this->categoryID,
                "name" => $this->name,
                "brand" => $this->brand,
                "image" => $this->image,
                "price" => $this->price,
                "calification" => $this->calification
            );

            $fileContent = file_get_contents('../data/departments.json');
            $departments = json_decode($fileContent,true);
            $department = null;
            $index = 0;
            for ($i=0; $i < sizeof($departments); $i++) { 
                if($departments[$i]['categoryID'] == $this->categoryID){
                    $department = $departments[$i];
                    $index = $i;
                break;
                }
            }
 
            $fileContentUsers = file_get_contents('../data/users.json');
            $users = json_decode($fileContentUsers,true);
            $user = null;
            $indexUser;
            for ($i=0; $i < sizeof($users); $i++) { 
                if($users[$i]['userID']==$userID){
                    $user = $users[$i];
                    $indexUser=$i;
                }
            }


            $user['products'] = array();

            $user['products'][]=array(
                "id"=>$count,
                "name"=>$this->name,
                "brand"=>$this->brand
            );


            $users[$indexUser]=$user;


            $department['products'][]=$count;
            $departments[$index] = $department;

            $file = fopen('../data/departments.json','w');
            fwrite($file, json_encode($departments));
            fclose($file);

            $fileProduct = fopen('../data/products.json','w');
            fwrite($fileProduct, json_encode($products));
            fclose($fileProduct);

            $fileUsers = fopen('../data/users.json','w');
            fwrite($fileUsers, json_encode($users));
            fclose($fileUsers);

            echo json_encode($products);


        }

    
        
        public function deleteUserProd($userID){
            $fileContent = file_get_contents('../data/users.json');
            $users = json_decode($fileContent,true);
            $user = null;
            $indice;
            for ($i=0; $i < sizeof($users); $i++) { 
                if($users[$i]['userID']==$userID){
                    $user = $users[$i];
                    $indice = $i;
                break;
                }
            }

            
            $fileContentProducts = file_get_contents('../data/products.json');
            $products = json_decode($fileContentProducts,true);
            $result = array();
            for ($i=0; $i < sizeof($products); $i++) { 
                if(in_array($products[$i]['productID'],$user['car'])){
                    for ($j=0; $j < sizeof($user['car']) ; $j++) { 
                        if($user['car'][$j]==$this->productID){
                            
                            unset($user['car'][$j]);
                        break;
                        }
                    
                  
                    }
            
                }
            }
            
            $users[$indice] = $user;
            $file = fopen('../data/users.json','w');
            fwrite($file, json_encode($users));
            fclose($file);

            echo json_encode($users);
        
        }


        public static function deleteProduct($index,$userID,$categoryID){
            $fileContent = file_get_contents('../data/departments.json');
            $categories = json_decode($fileContent,true);
            $category = null;
            $indexCategory;    
            
            for ($i=0; $i < sizeof($categories); $i++) { 
                if($categories[$i]['categoryID']==$categoryID){
                    $category =  $categories[$i];
                    $indexCategory=$i;
                break; 
                }
            }

            $fileContentProducts = file_get_contents('../data/products.json');
            $products = json_decode($fileContentProducts,true);

            $productID = $category['products'][$index];

            $fileContentUsers = file_get_contents('../data/users.json');
            $users = json_decode($fileContentUsers,true);
            $productsUser=$users[$userID-1]['products'];

            for ($i=0; $i < sizeof($productsUser); $i++) { 
                if($productsUser[$i]['id']==$productID){

                    array_splice($category['products'],$index,1);
                    array_splice($products,$productID-1,1);
                    unset($users[$userID-1]['products'][$i]);


                    $categories[$indexCategory]=$category;
                    $file = fopen('../data/departments.json','w');
                    fwrite($file, json_encode($categories));
                    fclose($file);

                    $fileProduct = fopen('../data/products.json','w');
                    fwrite($fileProduct, json_encode($products));
                    fclose($fileProduct);

            
                    $fileUsers = fopen('../data/users.json','w');
                    fwrite($fileUsers, json_encode($users));
                    fclose($fileUsers);

                    return '{"resultID":1,"message":"Success"}';
                
                }else{
                    return null;
                }

            }


            

            
        
            

            


            
            


        

        }





        
    }


?>