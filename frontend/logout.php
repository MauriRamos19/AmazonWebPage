<?php

    session_start();
    session_destroy();
    setcookie("token","",time()-1,'/');
    setcookie("userID","",time()-1,'/');
    setcookie("name","",time()-1,'/');
    setcookie("permission","",time()-1,'/');

    header("Location: login.html");


?>