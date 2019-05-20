<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Login</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
        <style>
            .alert{
                background-color: #009688;
                color: #f8f9fa;
            }
            .btn{
                width: 100%;
            }
            .btn:hover {
                cursor: pointer;
            }
            .container{
                width: 36%;
                border: 1px dotted rgb(94, 143, 94);
                border-radius: 10px;
                border-width: thin;
                background-color: rgba(85, 181, 85, 0.54);
            }
            input[type=text], input[type=password]{
                width: 100%;
            }
        </style>
    </head>
    <body style="background-color: #8fd2a070;">
        <br>
        <div class="container">
            <br>
            <h4 style="text-align: center">User Login</h4>
            <hr>
            <form class="login-form" name="form" method="post" action="userLogin.php">
                <span id="isLoginFailed"></span>
                <input type="text" class="form-control" name="username" placeholder="Username" /><br>
                <input type="password" class="form-control" name="password" placeholder="Password" /><br>

                <input type="submit" name="submit" value="Login" class="btn btn-success" />
                <br><br>
            </form>
        </div>
    </body>
</html>
<?php

	$host = "localhost";
	$db = "CIS475";
	$user = "root";
	$pwd = "";
	
	$conn = new mysqli($host,$user,$pwd,$db);
    if ($conn->connect_error) die($conn->connect_error);
    if(isset($_POST['submit'])){
        $username_input = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
        $password_input = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
        
        $query = "SELECT * FROM User WHERE Username='$username_input'";
        
        $result = $conn->query($query);
        
        if(!$result) die($conn->error);
        
        elseif ($result->num_rows){
            $row = $result->fetch_array(MYSQLI_NUM);
            $result->close();
            $aLt1 = "qm&h*";
            $aLt2 = "pg!@";
            $token = hash('ripemd128',"$aLt1$password_input$aLt2");
            
            if($token == $row[3]){
                echo "<br><div style='text-align:center;' class='alert alert-info'><h5>Hi $row[1] $row[2],</h5> you are now logged in as <b>'$row[0]'</b></div>";
            }
            else{
                echo '<script language="javascript">';
                echo 'document.getElementById("isLoginFalied").innerHTML = "hhhhhh"';
                echo 'alert("Invalid username / password combination")';
                echo '</script>';
            }
        }
        else{
            echo '<script language="javascript">';
            echo 'alert("Invalid username / password combination")';
            echo '</script>';
        }
        
        
    }
    

?>