<?php

$servername = "127.0.0.1";
$username = "root";
$p = "786@Haashir"; 
$db_name = "Bakery_Data";

$conn = mysqli_connect($servername,$username,$p,$db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

if ($_SERVER["REQUEST_METHOD"] == "POST") 
    // Check if all fields are set and not empty
    if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['address']) && isset($_POST['password']) &&
        !empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['phone']) && !empty($_POST['address']) && !empty($_POST['password'])) {
        // Dummy registration process (just for demonstration)
        // In a real application, you would perform validation, sanitization, and probably database operations
        
        // Retrieve submitted data
        $username = $_POST['username'];
        $email = $_POST['email'];
        $phone = $_POST ['phone'];
         $address = $_POST ['address'];
          $password = $_POST ['password'];
        }

        $CustID = 'Cust113'; 

        $check_query = "SELECT * FROM Customer WHERE Email = '$email'";
        $result = $conn->query($check_query);

        if ($result->num_rows > 0) {
            // Username or email already exists
            echo "Email is already registered.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        }

        
       
        $insert_query = "INSERT INTO Customer VALUES ('$CustID','$username', '$email', '$phone', '$address', '$hashed_password')";

        $conn->query($insert_query); 


    

?> 

<!DOCTYPE html>
<html>
<head>
    <title>Registration Form</title>
    <link rel="stylesheet" href="../CSS/Registration.css" type="text/css">
</head>
<body>

<h2>Register</h2>

<form method="post">
    <div>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
    </div>
    <br>
    <div>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
    </div>
    <br>
    <div>
        <label for="phone">Phone Number:</label>
        <input type="tel" id="phone" name="phone" required>
    </div>
    <br>
    <div>
        <label for="address">Address:</label>
        <input type="text" id="address" name="address" required>
    </div>
    <br>
    <div>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
    </div>
    <br>
    <button type="submit">Register</button>
</form>
</body>
</html>
