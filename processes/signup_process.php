<?php

require_once "../includes/dbConn.php";

if(isset($_POST["register"])){

   $fullname = $_POST["fullname"];
   $email= $_POST["email"];
   $password = $_POST["password"];

   if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    die("Incorrect Email");
   }

   $encrpt_pass= password_hash($password,PASSWORD_DEFAULT);

   $insert_sql =" INSERT INTO users(Fullname, email, password) VALUES('$fullname','$email','$encrpt_pass')";

   if($conn->query($insert_sql) === TRUE){
    header("Location: ../Users.php");
   }else{
    die("Error: ". $insert_sql . "<br>" . $conn->error);
   }

}
?>