<?php

      
    class Department{

        private $categoryID;
        private $nameDepartment;
        private $products;




        public function __construct(
            $categoryID,
            $nameDepartment,
            $products

        ){

            $this->categoryID=$categoryID;
            $this->nameDepartment=$nameDepartment;
            $this->products=$products;

        }


        public static function getDepartment($categoryID){
            $fileContent = file_get_contents("../data/departments.json");
            $departments = json_decode($fileContent,true);
            $department = null;
            for ($i=0; $i <sizeof($departments) ; $i++) { 
                if($departments[$i]['categoryID']==$categoryID){
                    $department = $departments[$i];
                    break;
                }
            }

            
        }


        public static function getAllDepartments(){
            $fileContent = file_get_contents("../data/departments.json");
            echo $fileContent;
        }



        public function addProduct(){

        }



    }


?>