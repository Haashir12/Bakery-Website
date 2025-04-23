<!DOCTYPE html>
<html>
    <head>
            <link rel="stylesheet" href="../CSS/changepassword.css" type="text/css">
    </head>
<body>
<?php
$name = ""; // This should be fetched or initialized properly

if (isset($_GET["Customer_ID"])) {
    $Customer_ID = $_GET["Customer_ID"];

    $sql = "SELECT * FROM Customer WHERE Customer_ID = '" . $Customer_ID . "'";
}

require_once 'ns.php';

 $conn = mysqli_connect($servername, $username, $p, $db_name);
 if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
 }

                        $passErr = "";
                        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_password'])) {
                            $currentPassword = $_POST['Current_Password'];
                            $newPassword = $_POST['New_Password'];
                            $confirmPassword = $_POST['Confirm_Password'];
                            
                            // Validate the new password against the pattern
                            $pattern = '/^(?=.[A-Za-z])(?=.\d)[A-Za-z\d]{8,}$/';
                            if (!preg_match($pattern, $newPassword)) {
                                $passErr = "Your password should have at least one letter, one number, and be longer than 8 characters.";
                            } elseif ($newPassword !== $confirmPassword) {
                                $passErr = "New passwords do not match.";
                            } elseif ($newPassword === $currentPassword) {
                                $passErr = "New password cannot be the same as the current password.";
                            } else {
                                // Fetch the current password from the database
                                $sql = "SELECT password FROM customers WHERE Customer_ID = '$customerID'";
                                $result = $conn->query($sql);
                                if ($result === false) {
                                    $passErr = "SQL error fetching user: " . $conn->error;
                                } elseif ($result->num_rows > 0) {
                                    $user = $result->fetch_assoc();
                                    if (password_verify($currentPassword, $user['password'])) {
                                        // Update the password in the database
                                        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                                        $updateSql = "UPDATE customers SET password = '$hashedPassword' WHERE Customer_ID = '$customerID'";
                                        if ($conn->query($updateSql) === TRUE) {
                                            echo "<p>Password changed successfully!</p>";
                                        } else {
                                            echo "<p>Error updating password: " . $conn->error . "</p>";
                                        }
                                    } else {
                                        $passErr = "Current password is incorrect.";
                                    }
                                } else {
                                    $passErr = "User not found.";
                                }
                            }
                        
                            if (!empty($passErr)) {
                                echo "<p style='color:red;'>$passErr</p>";
                            }
                            $conn->close();
                        }
?>
</head>
<body>
<div class="bottom-bar">
  <div class="options-bar">
    <a href="#">My orders</a>
    <a href="#">My Address</a>

  </div>
</div>
<img src="../Icons/Profileicon.jpeg"  alt="Account logo" class="account-logo">

<div class="form-table">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?Customer_ID=<?php echo $customerID; ?>">
        <div class="form-group">
            <label for="Current_Password">Current Password</label>
            <input type="password" id="Current_Password" name="Current_Password" placeholder="Current Password" required>
        </div>
        <div class="form-group">
            <label for="New_Password">New Password</label>
            <input type="password" id="New_Password" name="New_Password" placeholder="New Password" required>
        </div>
        <div class="form-group">
            <label for="Confirm_Password">Confirm New Password</label>
            <input type="password" id="Confirm_Password" name="Confirm_Password" placeholder="Confirm New Password" required>
        </div>
        <button type="submit" name="submit_password">Change Password</button>
    </form>
</div>


  </div>
</div>
</body>
</html>