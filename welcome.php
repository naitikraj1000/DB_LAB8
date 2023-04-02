<?php
// Start session
session_start();
                                                    
// Check if user is logged in, redirect to login form if not
if (!isset($_SESSION['first_name']) || !isset($_SESSION['last_name'])) {
	header("Location: login_form.php");
	exit();
}

// Get user data from session variables
$first_name = $_SESSION['first_name'];
$last_name = $_SESSION['last_name'];
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Welcome Page</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			background-color: #f2f2f2;
		}
		h1 {
			color: #333;
			text-align: center;
			margin-top: 50px;
		}
		p {
			color: #371;
			text-align: center;
			margin-top: 20px;
			font-size: 1.2em;
		}
		a {
			display: block;
			margin-top: 30px;
			font-size: 1.1em;
			text-align: center;
			color: #333;
			text-decoration: none;
			padding: 10px;
			background-color: #f2f2f2;
			border: 1px solid #ccc;
			border-radius: 5px;
			width: 200px;
			margin: 0 auto;
		}
		a:hover {
			background-color: #ddd;
		}
	</style>
</head>
<body>
	<h1>Welcome!</h1>
	<p>Hello, <?php echo $first_name . " " . $last_name; ?>!</p>
	<a href="view_info.php">View Your Information</a>
	<a href="logout.php">Logout</a>
</body>
</html>

