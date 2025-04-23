<!DOCTYPE HTML>  
<html>
<head>
    <title>Registration Page</title>
    <link rel="stylesheet" href="../CSS/register.css" type="text/css">
    <style>
    .error {color: #FF0000;}

    .logreg{
    border-bottom: 5px solid red;
    text-align: center;
    padding: 20px;
    font-size: 24px;
    background-color: red;
    font-weight: bold;
    font-family: italic;
    }
    .emailerr {
        color: #FF0000;
        transform:translate(42%,-4300%); 
        font-weight: bold; 
        font-weight:35px;
    }
    .regsucccess{
        border-bottom: 5px solid lightgreen;
        text-align: center;
        padding: 20px;
        font-size: 36px;
        background-color: lightgreen;
        font-weight: bold;
        font-family: italic;
        transform:translate(0%,-1050%); 
    }
    </style>
</head>
    
<body>  
    <?php

    require_once 'ns.php';

    echo "<br>"; 
    echo "<br>"; 
    echo "<br>"; 

    if (isset($_GET["Customer_ID"]) && !empty($_GET["Customer_ID"])) {
        $log_reg = "<p class='logreg'>You are currently logged in</p>";
        echo $log_reg;
        exit; // Exit to stop further execution
    } else {
    

    //define variables and set to empty values
    $snameErr = "";
    $emailErr="";
    $passErr="";
    $sname="";
    $email="";
    $emailErr=""; 
    $phone="";
    $Errphone="";
    $address=""; 
    $Erraddress="";
    $password="";
    $validatedcContent=true;

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
            if (empty($_POST["Sname"]))
            {
                $snameErr = "Name is required";
                $sname = "";
                $validatedcContent=false;
            }
            else
            {
                $sname = test_input($_POST["Sname"]);
            }

            if (empty($_POST["Phone_Number"]))
            {
                $phoneErr = "Phone number is required";
                $phone = "";
                $validatedcContent=false;
            }
            else
            {
                $phone = test_input($_POST["Phone_Number"]);
            }

            if (empty($_POST["Address"]))
            {
                $addressErr = "Address is required";
                $address = "";
                $validatedcContent=false;
            }
            else
            {
                $address = test_input($_POST["Address"]);
            }

            if (empty($_POST["Email"]))
            {
              $emailErr = "Email is required";
              $email = "";
              $validatedcContent=false;
            }
            else
            {
              $email = test_input($_POST["Email"]);
              if (!filter_var($email, FILTER_VALIDATE_EMAIL))
              {
                  $emailErr="Invalid Email format";
                  $validatedcContent=false;
              }
            }

            if (empty($_POST["Password"])) {
                $passErr = "Password is required";
                $password = "";
                $validatedcContent=false;
              } 
              else {
                $password = test_input($_POST["Password"]);
                $pattern = '/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/'; 
                if (preg_match($pattern, $password))
                {
                    $hash_pass = password_hash($password, PASSWORD_DEFAULT);
                }           
                else 
                    $passErr = "Your Password should have at least one letter, one number and more than 8 characters";
                    $validatedcContent=false;
                
              }
    }
}


    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    

    ?>
 <br>
 <br>
 <br>
 <br>
 <br>
 <br>
 <br>
 <div class="form-container">
    <img src="../Images/logo.jpeg" width="100" height="100">
        <h2>Downtwown Delights Registration</h2>
        <p><span class="error">* Required fields</span></p>
        <br><br>
        <form method="post" action="register.php">  
            Full name: <br><br><input type="text" name="Sname" value="<?php echo $sname?>">
            <span class="error">* <?php echo $snameErr;?></span>
            <br><br>
            Phone number: <br><br><input type="text" name="Phone_Number" value="<?php echo $phone?>">
            <span class="error">* <?php echo $phoneErr;?></span>
            <br><br>
            Address: <br><br><input type="text" name="Address" value="<?php echo $address?>">
            <span class="error">* <?php echo $addressErr;?></span>
            <br><br>
            Email: <br><br><input type="email" name="Email" value="<?php echo $email?>">
            <span class="error">* <?php echo $emailErr;?></span>
            <br><br>
            Password: <br><br><input type="password" name="Password">
            <span class="error">* <?php echo $passErr;?></span>
            <br>
            <br>
            <br>
            <input type="submit" name="submit" value="Submit">  
            <br>
            <br>
        </form>
    </div>
    <?php

        
        $conn=mysqli_connect($servername, $username, $p, $db_name);
    
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }
        // echo "Connected successfully";

        $check_queryy = "SELECT * FROM Customer WHERE Email = '$email'";
        $resultt = $conn->query($check_queryy);

        if ($resultt->num_rows > 0) {
            echo "<p class = 'emailerr'>Email is already registered.</p>";
        } 
        else {

        if (! preg_match($pattern, $password)) 
            {
                $passErr ;
            } else {

        $sql_name = "SELECT RIGHT(Customer_ID, 3) AS last_three_chars FROM Customer ORDER BY customer_id DESC LIMIT 1";

        $result1 = $conn->query($sql_name);
        
        // Check if the query executed successfully
        if ($result1->num_rows > 0) {
            // Fetch the result row as an associative array
            $row = $result1->fetch_assoc();
            
            // Assign the last three characters to $sql_name
            $last_three_chars = $row["last_three_chars"];
        
            $sql_name = strval(intval($last_three_chars) + 1); 
            
            // Output the result
            // echo $sql_name;
          } 
          else {
            // Handle the case when no rows are returned
            echo "No rows found";
        }
        
        $CustID = "Cust" . $sql_name;  

        if ($_SERVER["REQUEST_METHOD"] == "POST") {


    
        $sql= "INSERT INTO Customer VALUES ('$CustID','$sname', '$phone', '$address', '$email', '$hash_pass')";

        
        // echo $sql;
    
        if ($conn->query($sql)===TRUE)
        {
                 echo "<p class ='regsucccess'> Registration Successful!!!</p>";
        }
        else
        {
                echo "can't insert customer data";
        }

        $conn->close();

        // echo "hiii testing";
    }
    else {
        echo "Please Fill the required fields"; 
    }
}
}
    ?>
</body>
</html>