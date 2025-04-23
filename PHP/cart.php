<!Doctype html>
<title>Shopping cart</title>
    <link rel="stylesheet" href="../CSS/cart.css" type="text/css">
    <style>
        .shopcust {
            border-bottom: 5px solid lightyellow;
            text-align: center;
            padding: 20px;
            font-size: 24px;
            background-color: lightyellow;
            font-weight: bold;
            font-family: italic;
        }

        .cart-text{
            font-size: 30px;
            font-family: 'century gothic';
            font-weight: 'bold'; 
        }

        .order_price{
            font-size: 30px;
            text-align: center; 
            font-family: 'century gothic';
            font-weight: bold; 
        }

        .clear-button {
            background-color: darkred;
            color: white;
            text-align: left;
            font-size: 17px;
            border-radius: 7px;
            padding: 10px 20px; /* Adjust padding as needed */
            border: none; /* Remove border if not needed */
            cursor: pointer; /* Add cursor pointer on hover */
            margin-left: 45px; /* Add margin from the left side */
            /* Additional styles as needed */
        }

        .clear-text {
            font-size: 40px; 
            text-align: center;
            padding: 20px;
            font-size: 24px;
            background-color: red;
            font-weight: bold;
            font-family: italic;
           margin-bottom: 100px; 

        }

        .order-icon{
            width:25px;
            height:60px;
            transform:translate(-220%,-15%);
        }


        .order-icon1{
            width:25px;
            height:25px;
            transform:translate(-625%,-40%)
        }

        .Order_now-button{
            background-color: darkgreen;
            color: white;
            text-align: left;
            font-size: 17px;
            border-radius: 7px;
        }

        .ordersuccess{
        border-bottom: 5px solid lightgreen;
        text-align: center;
        padding: 20px;
        font-size: 36px;
        background-color: lightgreen;
        font-weight: bold;
        font-family: italic;
    }

    .orderlink{
        font-size: 36px;
        text-align: center;
        font-weight: bold;
        color:darkgreen; 
        text-decoration:none; 
    }
    .orderlink:hover{
        text-decoration:underline; 
    }


    </style> 
</head>
<body>
    <?php
    require_once 'ns.php'; 
    echo "<br>"; 
    echo "<br>";
    echo "<br>";
    
      // Database connection for fetching customer details
      $conn_customer = mysqli_connect($servername, $username, $p, $db_name);
      if ($conn_customer->connect_error) {
          die("Connection failed: " . $conn_customer->connect_error);
      }
    
       // Database connection for fetching product details
       $conn_product = mysqli_connect($servername, $username, $p, $db_name);
       if ($conn_product->connect_error) {
           die("Connection failed: " . $conn_product->connect_error);
       }




       $sql_customer = "SELECT * FROM Customer WHERE Customer_ID = '$Customer_ID'";
       $result_customer = $conn_customer->query($sql_customer);
   
       if ($result_customer->num_rows > 0) {
           $row_customer = $result_customer->fetch_assoc();
           $customer = "<p>Welcome, " . $row_customer["Customer_Name"] . "</p>";
           
   
           if (isset($_GET['product_id'])) {
               $product_id = $_GET['product_id'];
   
               // Initialize quantity
               $quantity = 1;
   
               // Check if the product is already in the shopping cart for the customer
               $check_cart_query = "SELECT * FROM Shopping_cart WHERE Customer_ID = '$Customer_ID' AND product_id = '$product_id'";
               $check_cart_result = $conn_product->query($check_cart_query);
   
   
               if ($check_cart_result->num_rows > 0) {
                   // Product already exists in the shopping cart, update quantity
                   $row = $check_cart_result->fetch_assoc();
                   $quantity = $row['Quantity'] + 1;
                   $update_cart_query = "UPDATE Shopping_cart SET Quantity = '$quantity' WHERE Customer_ID = '$Customer_ID' AND product_id = '$product_id'";
                   $result_update = $conn_product->query($update_cart_query);
   
               } 
              
               
               else 
               {
                   // Product does not exist in the shopping cart, insert new entry
                   $insert_cart_query = "INSERT INTO Shopping_cart (Customer_ID, product_id, Quantity) VALUES ('$Customer_ID', '$product_id', '$quantity')";
                    $result_insert = $conn_product->query($insert_cart_query);

                    // Fetch the inserted row
                    $sql_select_insert = "SELECT p.Product_Name, p.product_price, p.Picture_File, sc.Quantity 
                    FROM Product p 
                    INNER JOIN Shopping_cart sc ON p.product_ID = sc.product_ID 
                    WHERE sc.Customer_ID = '$Customer_ID' AND sc.product_ID = '$product_id';";
                    $result_select_insert = $conn_product->query($sql_select_insert);



                    

                    if ($result_select_insert->num_rows > 0) {
                        $row = $result_select_insert->fetch_assoc(); // Fetch the inserted row
                        echo "<p class = 'cart-text'>Your Selected Item has been added to your cart</p>"; 
                        echo "<br>"; 
                        echo "<ul class='shop-order'>";
                        echo "<li><img src='../Images/" . $row["Picture_File"] . "' class='order-image'></li>";
                        echo "<li><p style='transform:translate(-40%,-50%)'>" .  $row["Product_Name"]. "</p></li>";
                        echo "<li><img src='../Icons/minus-icon.jpeg' class='order-icon'></li>";
                        echo "<li><p class='order-quantity'>" . $row["Quantity"] . "</p></li>";
                        echo "<li><img src='../Icons/plus.png' class='order-icon1'></li>";
                        echo "<li class='shop-order-price'>AED " .$row["product_price"] . "</li>";
                        echo "</ul>";
                        echo "<br>";
                        echo "<br>";
                    }

               }
               
            } 
            else {
                if (isset($Customer_ID) && empty($product_ids))
                {
                echo "<p class='shopcust'>Your Shopping cart is currently empty</p>";
            }
        }
            
        }
        else {
            echo "<p class = 'shopcust'>Please login to add items to the cart</p>";
        }

                    $sql_select = "SELECT p.Product_Name, p.product_price, p.Picture_File, sc.Quantity
                FROM Product p 
                INNER JOIN Shopping_cart sc ON p.product_ID = sc.product_ID 
                WHERE sc.Customer_ID = '$Customer_ID' AND sc.product_ID IN (" . implode(",", $product_ids) . ")
                GROUP BY p.Product_Name, p.product_price, p.Picture_File, sc.Quantity;";
                $result_select = $conn_product->query($sql_select);



                                    if ($result_select->num_rows > 0) {
                                        echo "<br>"; 
                                        echo "<br>"; 
                                        echo "<br>"; 
                                    echo "<p class='cart-text'>Your Shopping cart</p>"; 
                                    echo "<br>"; 
                                    while($row = $result_select->fetch_assoc()) {
                                    echo "<ul class='shop-order'>";
                                    echo "<li><img src='../Images/" . $row["Picture_File"] . "' class='order-image'></li>";
                                    echo "<li><p style='transform:translate(-20%,-100%)'>" .  $row["Product_Name"]. "</p></li>";
                                    echo "<li><img src='../Icons/minus-icon.jpeg' class='order-icon'></li>";
                                    echo "<li><p class='order-quantity'>" . $row["Quantity"] . "</p></li>";
                                    echo "<li><img src='../Icons/plus.png' class='order-icon1'></li>";
                                    echo "<li class='shop-order-price'>AED " .$row["product_price"] . "</li>";
                                    echo "<p><b>Product Total:</b> AED " . $row["product_price"] * $row["Quantity"]  . "</p>";
                                    echo "</ul>";
                                    echo "<br>";
                                    echo "<br>"; 
                                    }
                                    // Output total price after looping through the results
                                    echo "<br>";
                                    echo "<br>";

                                    }




                                    

                                    $Order_Total = "SELECT SUM(p.product_price * sc.Quantity) AS Order_Total
                                    FROM Product p 
                                    INNER JOIN Shopping_cart sc ON p.product_ID = sc.product_ID 
                                    WHERE sc.Customer_ID = '$Customer_ID' AND sc.product_ID IN (" . implode(",", $product_ids) . ")";

                                    $result_total = $conn_product->query($Order_Total);

                                    if ($result_total) {
                                        $row = $result_total->fetch_assoc();
                                        $totalAmount = $row["Order_Total"];
                                        if ($totalAmount !== null) {
                                            echo "<p class = 'order_price'><b>Order Total: </b> AED " . $totalAmount . "</p>";
                                        }
                                        else {
                                            echo "<p class = 'shopcust'>Please login to add items to the cart</p>";
                                            echo "<br>";
                                            echo "<br>";
                                        } 
                                    }
                                    echo "<br>"; 
                                    echo "<br>"; 
                                    echo "<br>"; 


                     
                    include_once 'emptycart.php'; 
                    echo "<br>"; 
                    echo "<br>"; 
                    echo "<br>"; 
                    echo "<br>"; 


                                   

    
    
    ?>
<br>
<br>
<p ><a href = "../PHP/shoppingcart.php?Customer_ID=<?php echo $Customer_ID;?><?php echo !empty($product_ids) ? '&product_ID[]=' . implode('&product_ID[]=', $product_ids) : ''; ?>" class='orderlink'>Click here: When you are ready to order!!</a></p>
<br>
<br>
<br>
<br>
</body>
</html>