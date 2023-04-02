<?php
$check=false;
// Connect to the database
$servername = "localhost";
$username = "naitik";
$password = "naitik";
$dbname = "register";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Get user input from form
$first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
$last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

// Validate user input
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Error: Invalid email format.";
    exit();
}

if (strlen($password) < 8) {
    echo "Error: Password must be at least 8 characters long.";
    exit();
}

if ($password != $confirm_password) {
    echo "Error: Passwords do not match.";
    exit();
}

// Hash password
//$password = password_hash($password, PASSWORD_DEFAULT);

// Generate unique ID for user
$id = uniqid();

// Insert user data into database using prepared statements
$stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, password) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $first_name, $last_name, $email, $password);

//$stmt->execute();
	
if($stmt->execute()){
	$check=true;
}

// Close database connection
$stmt->close();
$conn->close();

?>




<!DOCTYPE html>
<html>
<head>
	<title>User Registration Form</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script type="text/javascript">
	

		function deleteLastRecord() {
		var confirmation = confirm("Are you sure you want to delete the last record?");
		if (confirmation == true) {
			// send request to delete last record
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					alert("Last record deleted successfully!");
				}
			};
			xhttp.open("GET", "delete_last_record.php", true);
			xhttp.send();
		}
	}
	
	
	
	
		function validateForm() {
			var password = document.forms["registration"]["password"].value;
			var confirm_password = document.forms["registration"]["confirm_password"].value;
			if (password != confirm_password) {
				alert("Error: Passwords do not match.");
				return false;
			}
		}

		function checkPasswordStrength(password) {
			var strengthBar = document.getElementById("password-strength-bar");
			var strengthText = document.getElementById("password-strength-text");
			var strength = 0;
			if (password.match(/[a-z]+/)) {
				strength++;
			}
			if (password.match(/[A-Z]+/)) {
				strength++;
			}
			if (password.match(/[0-9]+/)) {
				strength++;
			}
			if (password.match(/[$@#&!]+/)) {
				strength++;
			}
			switch(strength) {
				case 0:
				case 1:
					strengthBar.style.backgroundColor = "#e74c3c";
					strengthText.innerHTML = "Weak";
					break;
				case 2:
					strengthBar.style.backgroundColor = "#f1c40f";
					strengthText.innerHTML = "Moderate";
					break;
				case 3:
					strengthBar.style.backgroundColor = "#2ecc71";
					strengthText.innerHTML = "Strong";
					break;
				case 4:
					strengthBar.style.backgroundColor = "#2ecc71";
					strengthText.innerHTML = "Very Strong";
					break;
				default:
					break;
			}
		}
	</script>
</head>
<body>
	<form name="registration" method="post" action="register.php" onsubmit="return validateForm()">
		<h2>User Registration Form</h2>
		<label>First Name:</label>
		<input type="text" name="first_name" required>

		<label>Last Name:</label>
		<input type="text" name="last_name" required>

		<label>Email:</label>
		<input type="email" name="email" required>

		<label>Password:</label>
		<input type="password" name="password" required onkeyup="checkPasswordStrength(this.value)">
		<div id="password-strength">
			<div id="password-strength-bar"></div>
			<span id="password-strength-text"></span>
		</div>

		<label>Confirm Password:</label>
		<input type="password" name="confirm_password" required>

		<input type="submit" value="Register">
		<button onclick="location.href='update_page.html'">Update User</button>
	</form>
	

	
<?php
if($check==true){

   echo "<div class='success-message'>Congratulations! You have successfully registered.</div>";
  
   // show button to delete last inserted data
    echo "<div class='button-container'><button onclick=\"deleteLastRecord()\">Delete Last Record</button></div>";
  
}else{
  echo "<div class='failure-message'>Failure! not registered.</div>";
}
?>



</body>
</html>


