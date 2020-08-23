<?php


    class User{

        private $name;
        private $email;
        private $password;
        private $permission;


        public function __construct($name,$email,$password,$permission){

            $this->name=$name;
            $this->email=$email;
            $this->password=$password;
            $this->permission=$permission;

        }



        public function addUser(){
                $fileContent = file_get_contents("../data/users.json");
                $users = json_decode($fileContent,true);
                $car = array();
                $count = 0;
                for ($i=0; $i <sizeof($users)+1 ; $i++) { 
                        $count = $count + 1;
                }
                $users[] = array(
                        "userID" => $count,
                        "name" => $this->name,
                        "email" => $this->email,
                        "password" => sha1($this->password),
                        "permission" => $this->permission,
                        "car" => $car
                ); 

                $file = fopen("../data/users.json","w");
                fwrite($file,json_encode($users));
                fclose($file);

                echo '{"resultID":1,"message":"User add succefuly"}';
        
        }
        
        public static function getAllUsers(){
            $fileContent = file_get_contents("../data/users.json");
            echo $fileContent;

        }

        /*
        public static function getUser($userID){
                $fileContent = file_get_contents("../data/users.json");
                $users = json_decode($fileContent,true);
                $user = null;

                $fileContent = file_get_contents("../data/car.json");
                $products = json_decode($fileContent,true);

                for ($i=0; $i < sizeof($users) ; $i++) { 
                        if($users[$i]['userID']==$userID){
                                $user = $users[$i];
                                $users[$i]['car'] = array();
                                for ($j=0; $j < sizeof($products) ; $j++) { 
                                        if ($products[$j]['userID']==$user['userID']) {
                                                $users[$i]['car'][]=$products[$j]['productID'];
                                        }
                                }
                                break;
                        }

                        
                }
                $file = fopen("../data/users.json","w");
                fwrite($file,json_encode($users));
                fclose($file);

                echo json_encode($users);
        }
        */


        public static function getUser($userID){
                $fileContent = file_get_contents("../data/users.json");
                $users = json_decode($fileContent,true);
                $user = 'null';
                for ($i=0; $i < sizeof($users); $i++) { 
                        if($users[$i]['useriID']==$userID){
                                $user = $users[$i];
                        break;
                        }
                }

                echo json_encode($user);
        }

        public static function userVerify($email,$password, $permission){
                $fileContent = file_get_contents('../data/users.json');
                $users = json_decode($fileContent,true);
                for ($i=0; $i < sizeof($users) ; $i++) {
                        if($users[$i]['email']==$email && $users[$i]['password']==sha1($password)){
                                if($users[$i]['permission']==$permission)
                                        return $users[$i];
                        }
                       
                        
                }
                return null;
        }





        /**
         * Get the value of name
         */ 
        public function getName()
        {
                return $this->name;
        }

        /**
         * Set the value of name
         *
         * @return  self
         */ 
        public function setName($name)
        {
                $this->name = $name;

                return $this;
        }

        /**
         * Get the value of email
         */ 
        public function getEmail()
        {
                return $this->email;
        }

        /**
         * Set the value of email
         *
         * @return  self
         */ 
        public function setEmail($email)
        {
                $this->email = $email;

                return $this;
        }

        /**
         * Get the value of password
         */ 
        public function getPassword()
        {
                return $this->password;
        }

        /**
         * Set the value of password
         *
         * @return  self
         */ 
        public function setPassword($password)
        {
                $this->password = $password;

                return $this;
        }
    }




?>