<!doctype html>
<html>
<head>
</head>
<body>
    <?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn_product = mysqli_connect($servername, $username, $p, $db_name);
       if ($conn_product->connect_error) {
           die("Connection failed: " . $conn_product->connect_error);
       }

$sql_order = "SELECT RIGHT(ORDER_ID, 3) AS last_three_chars FROM _order_ ORDER BY ORDER_ID DESC LIMIT 1";

$result1 = $conn_product->query($sql_order);

// Check if the query executed successfully
if ($result1->num_rows > 0) {
    // Fetch the result row as an associative array
    $row = $result1->fetch_assoc();
    
    // Assign the last three characters to $sql_name
    $last_three_chars = $row["last_three_chars"];

    $sql_order = strval(intval($last_three_chars) + 1); 
    
    // Output the result
    // echo $sql_name;
  } 
  else {
    // Handle the case when no rows are returned
    echo "No rows found";
}

$Order_ID = "ORD" . $sql_order; 

$date = date('Y-m-d');

$time = date('H:i:s');



$sql_item = "SELECT RIGHT(Baked_Item_ID, 2) AS last_three_chars FROM Baked_Item ORDER BY last_three_chars DESC LIMIT 1;";

$result1 = $conn_product->query($sql_item);

// Check if the query executed successfully
if ($result1->num_rows > 0) {
    // Fetch the result row as an associative array
    $row = $result1->fetch_assoc();
    
    // Assign the last three characters to $sql_name
    $last_three_chars = $row["last_three_chars"];

    $sql_item = strval(intval($last_three_chars) + 1); 
    
    // Output the result
    // echo $sql_name;
  } 
  else {
    // Handle the case when no rows are returned
    echo "No rows found";
}

$Baked_Item_ID = "BI0" . $sql_item; 

$p_date = date('Y-m-d', strtotime($date . ' - 5 days'));

$b_date = date('Y-m-d', strtotime($date . ' + 5 days'));


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind SQL statements to prevent SQL injection
    $cart_insert = "INSERT INTO _order_ (Order_ID, Customer_ID, order_date, order_time, Total) VALUES (?, ?, ?, ?, ?)";
    $cart_item_insert = "INSERT INTO Baked_Item (Baked_Item_ID, Production_Date, Bestbefore_Date, Order_ID, Product_ID, QUANTITY) VALUES (?, ?, ?, ?, ?, ?)"; 
    $cart_empty = "DELETE FROM Shopping_cart WHERE Customer_ID = ?"; 
    
    // Create a prepared statement for insertion
    $insert_stmt = $conn_product->prepare($cart_insert);
    $insert_stmt->bind_param("sssss", $Order_ID, $Customer_ID, $date, $time, $totalAmount);

    // Create a prepared statement for inserting baked items
    $insert_item_stmt = $conn_product->prepare($cart_item_insert);
    $insert_item_stmt->bind_param("sssssi", $Baked_Item_ID, $p_date, $b_date, $Order_ID, $product_id, $quantity);

    // Create a prepared statement for deletion
    $delete_stmt = $conn_product->prepare($cart_empty);
    $delete_stmt->bind_param("s", $Customer_ID);
    

    // Execute deletion
    if ($insert_stmt->execute()) {
        echo "<p class='ordersuccess'>Your order has been placed.</p>";
    
        // Loop through each product ID
        foreach ($product_ids as $product_id) {
            // Generate a unique Baked_Item_ID for each product
            $Baked_Item_ID = "BI0" . uniqid();
    
            // Execute insertion for baked item
            if ($insert_item_stmt->execute()) {
               // echo "<p class='clear-text'>Baked item with ID $Baked_Item_ID has been added for product ID $product_id.</p>";
            } else {
                echo "Error in inserting baked item: " . $insert_item_stmt->error;
            }
        }
    } else {
        echo "Error in placing order: " . $insert_stmt->error;
    }
    
    if ($delete_stmt->execute()) {
        // No need to output any message here since it's a cleanup operation
    } else {
        echo "Error in removing item record: " . $delete_stmt->error;
    }
}
    

    ?>
<div>
        <form  method="post" action="../PHP/shoppingcart.php?Customer_ID=<?php echo $Customer_ID;?><?php echo !empty($product_ids) ? '&product_ID[]=' . implode('&product_ID[]=', $product_ids) : ''; ?>">
            <button type="submit" class = "Order_now-button"> Order Now</button>
        </form>
    </div>
</body>
</html>

