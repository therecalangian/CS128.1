<?php
session_start();

$con = mysqli_connect('localhost', 'root', '', 'phplogin');
if ( mysqli_connect_error() ) {
	// Shows error in connection
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

// Check if data exists
if ( !isset($_POST['username'], $_POST['password']) ) {
	// Incomplete fields
	exit('Please fill both the username and password fields!');
}

// Prepare SQL 
if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ?')) {
	// Bind parameters
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	// Stores the result to check if data is in the database
	$stmt->store_result();

	if ($stmt->num_rows > 0) {
	$stmt->bind_result($id, $password);
	$stmt->fetch();

	// Account exists then check the password
	if ($_POST['password'] == $password) {
		// User has succesfully logged in
		session_regenerate_id();
		$_SESSION['loggedin'] = TRUE;
		$_SESSION['name'] = $_POST['username'];
		$_SESSION['id'] = $id;
		header("Location: ../home.php");

	} else {
		// Incorrect password
		echo 'Incorrect username and/or password!';
	}
} else {
	// Incorrect username
	echo 'Incorrect username and/or password!';
}

	$stmt->close();

}
?>