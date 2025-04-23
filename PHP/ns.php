<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="../CSS/ns.css" type="text/css">
    <link rel="icon" href="../Images/logo.jpeg" type="image/png">

<?php

$servername = "127.0.0.1";
$username = "root";
$p = "12345"; 
$db_name = "Bakery_Data";

$conn = mysqli_connect($servername,$username,$p,$db_name);



  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET["Customer_ID"])) {
    $Customer_ID = $_GET["Customer_ID"];

    $sql_customer = "SELECT * FROM Customer WHERE Customer_ID = '$Customer_ID'";
    $result_customer = $conn->query($sql_customer);


    if ($result_customer->num_rows > 0) {
        $row = $result_customer->fetch_assoc();
        $customer = "<a href='../PHP/CustomerProfile.php?Customer_ID={$row['Customer_ID']}'><p class='neat wel'>Welcome,". $row["Customer_Name"]. "</a></p>";
        $Log_out = "<a href = '../PHP/Login.php' class = 'logout'>Log out</a>"; 
    } else {
        $customer = "<a href='../PHP/Login.php' class='neat'><i class='fa-solid fa-user'></i>Login</a>";
    }
} else {
    $customer = "<a href='../PHP/Login.php' class='neat'><i class='fa-solid fa-user'></i>Login</a>";
}

                
    // $product_ids = isset($_GET["product_ID"]) ? $_GET["product_ID"] : array();

                            $product_ids_query = "SELECT product_ID FROM Shopping_cart WHERE Customer_ID = '$Customer_ID'";
                            $result_prod = $conn->query($product_ids_query);
                            $product_ids = array(); // Initialize an empty array to store product IDs

                            if ($result_prod->num_rows > 0) {
                                while ($row = $result_prod->fetch_assoc()) {
                                    $product_ids[] = $row['product_ID']; // Store product IDs in the array
                                }
                            }
                            // No action needed if no rows are found, as the $product_ids array will remain empty


                /*
                $cat = isset($_GET["cat"]) ? $_GET["cat"] : ""; 

                if (!empty($cat)) {
                     $sql = "SELECT * FROM product WHERE category_id = ' .$cat. '";
                    
                } else {
                    $sql = "SELECT * FROM product";
                    
                }
                */
                $cat = $_GET["cat"]; 

                  if ($cat != "") {
                      $sql = "SELECT * FROM product WHERE Category_ID = '$cat'";
                  } else {
                      $sql = "SELECT * FROM product";
                  }

$result = $conn->query($sql);

$conn->close();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/nav.css">

    <script src="https://kit.fontawesome.com/ad63a3ea3e.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=El+Messiri:wght@400..700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="header-container">
            <div class="logo-container">
                <a href="../PHP/home.php?Customer_ID=<?php echo $Customer_ID; ?>">
                    <img src="../Images/logo.jpeg" width="100" height="100" alt="Downtown Delights Logo">
                </a>
                <span class="header-title">Downtown Delights</span>
            </div>

            <ul class="nav_list">
                <li><a href="../PHP/aboutus.php?Customer_ID=<?php echo $Customer_ID; ?>">About Us</a></li>
                <li class="dropdown">
                    Categories 
                    
                  <div class="dropdown-content">
                    <a href="../PHP/product.php?Customer_ID=<?php echo $Customer_ID; ?>">All Categories</a>
                    <a href="../PHP/product.php?Customer_ID=<?php echo $Customer_ID; ?>&cat=CT03">Cookies</a>
                    <a href="../PHP/product.php?Customer_ID=<?php echo $Customer_ID; ?>&cat=CT06">Pastries</a>
                    <a href="../PHP/product.php?Customer_ID=<?php echo $Customer_ID; ?>&cat=CT01">Bread</a>
                    <a href="../PHP/product.php?Customer_ID=<?php echo $Customer_ID; ?>&cat=CT08">Cheesecake</a>
                    <a href="../PHP/product.php?Customer_ID=<?php echo $Customer_ID; ?>&cat=CT02">Cake</a>
                    <a href="../PHP/product.php?Customer_ID=<?php echo $Customer_ID; ?>&cat=CT05">Cupcakes</a>
                    <a href="../PHP/product.php?Customer_ID=<?php echo $Customer_ID; ?>&cat=CT07">Scone</a>
                    <a href="../PHP/product.php?Customer_ID=<?php echo $Customer_ID; ?>&cat=CT09">Brownie</a>
                    <a href="../PHP/product.php?Customer_ID=<?php echo $Customer_ID; ?>&cat=CT10">Pie</a>
                    <a href="../PHP/product.php?Customer_ID=<?php echo $Customer_ID; ?>&cat=CT04">Muffin</a>
                </div>

                </li>

                <li><a href="../PHP/Contactus.php?Customer_ID=<?php echo $Customer_ID; ?>">Contact Us</a></li>
                <li><a href="../PHP/register.php?Customer_ID=<?php echo $Customer_ID; ?>">Register</a></li>

                <li><a href="#"><i class="fa-solid fa-magnifying-glass"></i> </a></li>
            </ul>

            <ul class="nav_list">
                <li class="car"><a href="../PHP/cart.php?Customer_ID=<?php echo $Customer_ID;?><?php echo !empty($product_ids) ? '&product_ID[]=' . implode('&product_ID[]=', $product_ids) : ''; ?>"><i class="fa-solid fa-cart-shopping"></i>Cart</a></li>
            </ul>

            <ul class="nav_list">
                <li><?php echo $customer; ?></li>
            </ul>

            <span></span>

            <ul class="nav_list">
                <li><?php echo $Log_out; ?></li>
            </ul>
        </div>
    </header>
</body>
</html>