<?php
// Connect to the database
$servername = "localhost";
$username = "naitik";
$password = "naitik";
$dbname = "register";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}



// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $password=$_POST["password"];
    // Update the user information in the database
    $sql = "UPDATE users SET first_name='$first_name', last_name='$last_name', email='$email',password='$password' WHERE id=$id";
if (mysqli_query($conn, $sql)) {
    echo '<p style="color: green; font-family: Arial, sans-serif; font-size: 16px; font-weight: bold; margin-top: 20px;">User information updated successfully.</p>';
} else {
    echo '<p style="color: red; font-family: Arial, sans-serif; font-size: 16px; font-weight: bold; margin-top: 20px;">Error updating user information: ' . mysqli_error($conn) . '</p>';
}

}






// Get the last user record from the database
$sql = "SELECT * FROM users ORDER BY id DESC LIMIT 1";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
echo " Connected to DB";
    $row = mysqli_fetch_assoc($result);
    $id = $row["id"];
    $first_name = $row["first_name"];
    $last_name = $row["last_name"];
    $email = $row["email"];
    $password = $row["password"];
// Display the user information in a form
echo '
<form action="update.php" method="post" style="font-family: Arial, sans-serif; background-color: #f9f9f9; padding: 40px;">
  <h2 style="font-size: 24px; margin-bottom: 20px;">Edit User Information</h2>
  <label for="first_name" style="display: block; margin-bottom: 10px;">First Name:</label>
  <input type="text" id="first_name" name="first_name" value="'.$first_name.'" style="padding: 8px; border: 1px solid #ccc; border-radius: 4px; margin-bottom: 20px;" required>
  
  <label for="last_name" style="display: block; margin-bottom: 10px;">Last Name:</label>
  <input type="text" id="last_name" name="last_name" value="'.$last_name.'" style="padding: 8px; border: 1px solid #ccc; border-radius: 4px; margin-bottom: 20px;" required>
  
  <label for="email" style="display: block; margin-bottom: 10px;">Email:</label>
  <input type="email" id="email" name="email" value="'.$email.'" style="padding: 8px; border: 1px solid #ccc; border-radius: 4px; margin-bottom: 20px;" required>
  
    <label for="password" style="display: block; margin-bottom: 10px;">Password:</label>
  <input type="password" id="password" name="password" value="'.$password.'" style="padding: 8px; border: 1px solid #ccc; border-radius: 4px; margin-bottom: 20px;" required>
  
  <input type="hidden" name="id" value="'.$id.'">
  <input type="submit" value="Save" style="background-color: #4CAF50; color: white; padding: 12px 20px; border: none; border-radius: 4px; cursor: pointer; font-size: 16px;">
</form>

    ';

} else {
    echo "No users found.";
}

mysqli_close($conn);
?>

