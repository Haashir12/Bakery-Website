<!DOCTYPE html>
<html>
    <?php
    require_once 'ns.php';
    ?>
<head>
<link rel="stylesheet" href="../CSS/CustomerProfile.css" type="text/css">
<style>
    .update-success{
        border-bottom: 5px solid lightgreen;
        text-align: center;
        padding: 20px;
        font-size: 25px;
        background-color: lightgreen;
        font-weight: bold;
        font-family: italic;
    }
    </style>

<?php
                        $conn = mysqli_connect($servername, $username, $p, $db_name);

                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        if (isset($_GET["Customer_ID"])) {
                            $Customer_ID = $_GET["Customer_ID"];

                            $sql = "SELECT * FROM Customer WHERE Customer_ID = '" . $Customer_ID . "'";
                            
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                $name = $row['Customer_Name'];
                                $address = $row['Address'];
                                $phone = $row['Phone_Number'];
                                $email = $row['Email'];
                            } else {
                                // Customer not found
                                echo "Customer not found";
                            }
                        } else {
                            // Customer ID not provided in the URL
                            echo "Customer ID not specified";
                        }

                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $name = $_POST["Full_Name"];
                            $address = $_POST["Address"];
                            $phone = $_POST["Phone_Number"];
                            $email = $_POST["Email_Address"];

                            // Update query
                            $sql = "UPDATE Customer SET Customer_Name = '$name', Address = '$address', Phone_Number = '$phone', Email = '$email' WHERE Customer_ID = '$Customer_ID'";

                            if (mysqli_query($conn, $sql)) {
                                echo "<p class = 'update-success'>Details Successfully Updated!!! </p>";
                            } else {
                                echo "Error updating record: " . mysqli_error($conn);
                            }
                        }


                        $conn->close();

?>
</head>
<body>
<div class="bottom-bar">
  <div class="options-bar">
  <a href="../PHP/changepassword.php?Customer_ID=<?php echo $row['Customer_ID']; ?>" > Change password </a>
    <a href="../PHP/CustomerProfile.php?Customer_ID=<?php echo $row['Customer_ID']; ?>">My Account</a>
    <a href="#">My orders</a>
    <a href="#">My Address</a>
    <a href="#">Payment History</a>
  </div>
</div>
<img src="../Icons/Profileicon.jpeg"  alt="Account logo" class="account-logo">
<br>
<div class="personal-details">
<h2>Personal Details</h2>
<br>
<p class="welcome">Welcome, <?php echo $name; ?></p>
  <div class="form-table">
  <form method="post" action="CustomerProfile.php?Customer_ID=<?php echo $row['Customer_ID']; ?>" >
    <div class="form-group">
        <label for="Full_Name">Full Name</label>
        <input type="text" id="Full_Name" name="Full_Name" placeholder="Full Name" value="<?php echo $name; ?>">
    </div>
    <div class="form-group">
        <label for="Address">Address</label>
        <input type="text" id="Address" name="Address" placeholder="Address" value="<?php echo $address; ?>">
    </div>
    <div class="form-group">
        <label for="Phone_Number">Phone Number</label>
        <input type="number" id="Phone_Number" name="Phone_Number" placeholder="+971" value="<?php echo $phone; ?>">
    </div>
    <div class="form-group">
        <label for="Email_Address">Email Address</label>
        <input type="email" id="Email_Address" name="Email_Address" placeholder="Email Address" value="<?php echo $email; ?>">
    </div>
    <button type="submit">Save Personal Details</button>
</form>
  </div>
</div>
</body>
</html>
