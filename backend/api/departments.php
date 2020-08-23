<?php
    
    header("Content-Type: application/json");
    include_once("../classes/class-department.php");
    
    switch ($_SERVER["REQUEST_METHOD"]) {
        case 'POST':
            
        
        case 'GET':
            if(isset($_GET['categoryID'])){
                Department::getDepartment($_GET['categoryID']);
            }else{
                Department::getAllDepartments();
            }
            break;



        case 'PUT':
        break;

        case 'DELETE':
        break;
    
    
    
    
    
    }   




?>