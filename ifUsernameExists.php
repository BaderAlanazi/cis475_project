<?php
	if(isset($_GET['user']))
	{
		$host = "localhost";
		$db = "CIS475";
		$user = "root";
		$pwd = "";
	
		$conn = new mysqli($host,$user,$pwd,$db);
        
		if(!$conn){
            die("Connection Unestablished: ".mysqli_connect_error());
        }
        
		$user_name = filter_var($_GET['user'], FILTER_SANITIZE_STRING);
		$query = "SELECT * FROM User WHERE Username='$user_name'";
        
        $result = mysqli_query($conn, $query);
        if($result){
            if(mysqli_num_rows($result) == 0){
                echo "<div class='alert alert-success'><strong>&#10004 Username is available!</strong></div>";
            }
            else{
                echo "<div class='alert alert-danger'><strong>&#10008 Username is taken. Try another one!</strong></div>";
            }
        }
    }
	

?>