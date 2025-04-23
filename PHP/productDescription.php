<!DOCTYPE HTML>
<html>
    <head>
<title>Product Description</title>
<link rel="stylesheet" href="../CSS/productDescription.css" type="text/css">

    </head>
    <body>

<?php

require_once 'ns.php';

$conn=mysqli_connect($servername, $username, $p, $db_name);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['product_id'])) {
    $productId = $_GET['product_id'];

    // Prepare SQL statement to select product by ID
    $productQuery = "SELECT * FROM product WHERE Product_ID = ?";
    $productStmt = $conn->prepare($productQuery);
    $productStmt->bind_param("i", $productId);
    $productStmt->execute();
    $productResult = $productStmt->get_result();

    if ($productResult->num_rows > 0) {
        $productRow = $productResult->fetch_assoc();

        // Prepare SQL statement to select category
        $categoryQuery = "SELECT C.Category_Name FROM Category C INNER JOIN product P ON C.Category_ID = P.Category_ID WHERE P.Product_ID = ?";
        $categoryStmt = $conn->prepare($categoryQuery);
        $categoryStmt->bind_param("i", $productId);
        $categoryStmt->execute();
        $categoryResult = $categoryStmt->get_result();

        if ($categoryResult->num_rows > 0) {
            $categoryRow = $categoryResult->fetch_assoc();

            // Output product details
            echo "<br><br><div class='container'>";
            echo "<h1 class='product-title'>" . $productRow["Product_Name"] . "</h1>";
            echo "<div class='product-image'>";
            echo "<img src='../Images/" . $productRow["Picture_File"] . "' alt='" . $productRow["Product_Name"] . "'>";
            echo "</div>";
            echo "<div class='product-info'>";
            echo "<ul>";
            echo "<li><strong>Price:</strong> AED " . $productRow["product_price"] . "</li>";
            echo "<li><strong>Calories:</strong> Minimum: " . $productRow["calorie_min"] . ", Maximum: " . $productRow["calorie_max"] . "</li>";
            echo "</ul>";
            echo "<p class='description'><b>Description:</b> <br>" . $productRow["product_description"] . "</p>";
            echo "<ul>"; 
            echo "<br>"; 
            echo "<li class='description'><b>Category:</b><br>". $categoryRow["Category_Name"] . "</li>"; 
            echo "</ul>"; 
            echo "</div>";
            echo "</div>";
        } else {
            echo "Category not found for this product.";
        }
    } else {
        echo "Product not found.";
    }
}


            $conn->close();

?>
</body>
            
</html>