<?php
// Start session
session_start();//session starts here  

// Connect to the database
$servername = "localhost";
$username = "naitik";
$password = "naitik";
$dbname = "register";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user input from login form
$email = $_POST['email'];
$password = $_POST['password'];

// Prepare SQL query to retrieve user data
$sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
$result = $conn->query($sql);

// Check if query returns any rows
if ($result->num_rows > 0) {
	// Authentication successful, retrieve user data
	$row = $result->fetch_assoc();
	$first_name = $row["first_name"];
	$last_name = $row["last_name"];
	$email=$row["email"];
	$id=$row["id"];
	// Set session variables for welcome page
	$_SESSION['first_name'] = $first_name;
	$_SESSION['last_name'] = $last_name;
	$_SESSION['email']=$email;
	$_SESSION['id']=$id;
	 $_SESSION["loggedin"]=true;
	// Redirect to welcome page
	header("Location: welcome.php");
	exit();
} else {
	// Authentication failed, display error message
	echo "Invalid email or password.";
}

// Close database connection
$conn->close();
?>

