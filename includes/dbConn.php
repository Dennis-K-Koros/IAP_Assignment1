<?php
     $server="localhost"; 
     $user="root";
     $pass="";
     $db_name="user details";
     $conn=new mysqli($server, $user, $pass, $db_name);
    if($conn->connect_error){
        echo("Error: ". $conn->connect_error);
     }
     else{
        echo("Connection Successfull");
     }
     
?>