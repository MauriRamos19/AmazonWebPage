<?php
    session_start();
    header("Content-Type: application/json");
    include_once("../classes/class-user.php");
    
    $_POST = json_decode(file_get_contents("php://input"),true);
    switch ($_SERVER["REQUEST_METHOD"]) {
        case 'POST':
            $user = User::userVerify($_POST['email'],$_POST['password'],$_POST['permission']);
            if($user){
                //echo '{"resultID":1,"message":"authenticated user","token":".sha1(unique)}';
                $result = array(
                    "resultID"=>1,
                    "message"=>"Authenticated user",
                    "token"=>sha1(uniqid(rand(),true))
                );
                $_SESSION['token'] = $result["token"];
                setcookie("token",$result["token"],time()+(60*60*24*31),'/');
                setcookie("userID",$user['userID'],time()+(60*60*24*31),'/');
                setcookie("name",$user['name'],time()+(60*60*24*31),'/');
                setcookie("permission",$user['permission'],time()+(60*60*24*31),'/');
                echo json_encode($result);
            }else{
                setcookie("token","",time()-1,'/');
                setcookie("userID","",time()-1,'/');
                setcookie("name","",time()-1,'/');
                setcookie("permission","",time()-1,'/');
                echo '{"resultID":0,"message":"User/Password incorrect"}';
            }
        break;
        case 'GET':
        break;

        case 'PUT':
        break;

        case 'DELETE':
        break;
    
    
    
    
    
    }   




?>