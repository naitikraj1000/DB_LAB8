<?php
// Start a session to access user information

session_start();
//$user_id = $_SESSION["id"];
//  echo $user_id;
// Check if user is logged in, otherwise redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){

   header("location: login.html");
    exit;
}

// Connect to the database
$servername = "localhost";
$username = "naitik";
$password = "naitik";
$dbname = "register";


$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user information from database
$user_id = $_SESSION["id"];
$sql = "SELECT * FROM users WHERE id = '$user_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $first_name = $row["first_name"];
    $last_name = $row["last_name"];
    $email = $row["email"];
} else {
    echo "Error: User not found.";
}

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>User Information</title>
    <style>
        body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
            margin-top: 50px;
        }

        table {
            margin: 0 auto;
            border-collapse: collapse;
            width: 50%;
        }

        td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: center;
        }

        th {
            padding: 10px;
            border: 1px solid #ccc;
            background-color: #ddd;
            text-align: center;
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
    <h1>User Information</h1>
    <table>
        <tr>
            <th>Field</th>
            <th>Value</th>
        </tr>
        <tr>
            <td>First Name</td>
            <td><?php echo $first_name; ?></td>
        </tr>
        <tr>
            <td>Last Name</td>
            <td><?php echo $last_name; ?></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><?php echo $email; ?></td>
        </tr>
    </table>
    <a href="logout.php">Log Out</a>
</body>
</html>

