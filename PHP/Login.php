<!DOCTYPE html>
<html lang="en">
<?php 
    require_once 'ns.php'; 
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="../CSS/login.css" type="text/css"> 
</head>
<body>
<?php

$err = ""; // Initialize error message

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $userEmail = '';
    $userPassword = '';

    if(isset($_POST['username']) && isset($_POST['password'])) {
        $userEmail = $_POST['username'];
        $user_input_Password = $_POST['password'];
    
        $conn = mysqli_connect($servername, $username, $p, $db_name);
    
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if (isset($_GET["Customer_ID"])) {
            $Customer_ID = $_GET["Customer_ID"];
        
            $sql_customer = "SELECT * FROM Customer WHERE Customer_ID = '$Customer_ID'";
            $result_customer = $conn->query($sql_customer);
        }

        if ($result_customer->num_rows > 0) {
            $row = $result_customer->fetch_assoc();
        }

        $sql = "SELECT * FROM Customer WHERE Email = '" . $userEmail . "'";
    
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            
            $row = $result->fetch_assoc();
            
            $user_hash_password = $row['Password_'];
    
            if (password_verify($user_input_Password, $user_hash_password)) {
              
                $l = "Login Successful...";
                
                $lr = "<a href='../PHP/home.php?Customer_ID=" . $row["Customer_ID"] . "'> Time to Order!!!</a>";
                
                // Redirect to home.php
                header("Location: ../PHP/home.php?Customer_ID=" . $row["Customer_ID"]);
                exit();
                
            } else {
                $err = "Invalid email or password."; // Display error message
            }
        
            $conn->close();
        } else {
            $err = "Your Email or password is Invalid."; // Display error message
        }
    }
}

?>
<br>
<br>
<div class="login-container">
    <div class="login-header">
        <img src="../Images/logo.jpeg" width="100" height="100">
        <h2>Downtown Delights Bakery Login</h2>
    </div>
    <form method="POST" action=""> <!-- Removed action attribute -->
        <div class="input-group">
            <label for="username">Email ID</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="input-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit"> Login</button>
        <br><br>
        <?php 
        echo $l; 
        echo "<br>";
        echo $lr; 
        echo $err; 
        ?>
    </form>
</div>

</body>
</html>
