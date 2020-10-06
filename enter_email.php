<?php

// php code to Update data from mysql database Table

if(isset($_POST['update']))
{
    
   $hostname = "localhost";
   $username = "root";
   $password = "";
   $databaseName = "phplogin";
   
   $connect = mysqli_connect('localhost', 'root', '', 'phplogin');
   
   // get values form input text and number
   
   $email = $_POST['email'];
   $password = $_POST['password'];
   
           
   // mysql query to Update data
   $query = "UPDATE accounts SET password='$password' WHERE email = '$email'";
   
   $result = mysqli_query($connect, $query);
   
   /* if($result)
   {
       echo 'Data Updated';
   }else{
       echo 'Data Not Updated';
   } */
   
   mysqli_close($connect);
   header('Location: ../index.html');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Password Reset PHP</title>
	<link rel="stylesheet" href="main.css">
</head>
<body>
	<form class="login-form" action="enter_email.php" method="post">
		<h2 class="form-title">Reset password</h2>
		<!-- form validation messages -->
		<!-- ?php include('messages.php'); ? -->
		<div class="form-group">
			<label>Your email address</label>
			<input input type="email" name="email">
			<label>Your new password</label>
			<input input type="password" name="password">
		</div>
		<div class="form-group">
			<button type="submit" name="update" class="login-btn" value="Update Data">Submit</button>
		</div>
	</form>
</body>

</html>