<!DOCTYPE html>
<html><head><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
    <style>body{text-align: center;}.alert{text-align: center;height: 10em;padding:25px 25px;}.btn{text-align: center;cursor: pointer}a{color: white;}a:hover{color: white;text-decoration: none}</style></head><body><div></div></body></html>
<?php

    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "CIS475";
    
    $conn = mysqli_connect($host, $user, $pass, $db);
    if ($conn->connect_error) die($conn->connect_error);

    $user_name = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
    $first_name = filter_var($_POST["firstname"], FILTER_SANITIZE_STRING);
    $last_name = filter_var($_POST["lastname"], FILTER_SANITIZE_STRING);
    $user_pass = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
    
    $aLt1 = "qm&h*";
    $aLt2 = "pg!@";
    $token = hash('ripemd128',"$aLt1$user_pass$aLt2");	

    addUser($conn, $user_name, $first_name, $last_name, $token);


function addUser($conn, $username, $firstname, $lastname, $password){
    $query = "INSERT INTO User VALUES ('$username','$firstname','$lastname','$password')";
    $result = $conn->query($query);
	if(!$result) die($conn->error);
    else{ 
        echo "<div class='alert alert-success'><h1>Completed!</h1> <h5><strong>".$username."</strong> Has been successfully registered.</h5></div>";
        echo "<br><br><button class='btn btn-success'><a href='userLogin.php'>Login</a></button>";
    }
}
?>