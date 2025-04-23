<!doctype html>
<head>
</head>
<body>
    <?php


    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $cart_empty = "DELETE FROM Shopping_cart WHERE Customer_ID = '$Customer_ID';"; 

        if (mysqli_query($conn_product, $cart_empty)) {
            echo "<p class = 'clear-text'>Your items have been removed from the cart</p>";
        } else {
            echo "Error in removing item record: " . mysqli_error($conn_product);
        }
    }
    ?>
<div>
        <form  method="post" action="../PHP/cart.php?Customer_ID=<?php echo $Customer_ID;?><?php echo !empty($product_ids) ? '&product_ID[]=' . implode('&product_ID[]=', $product_ids) : ''; ?>">
            <button type="submit" class = "clear-button">Empty Cart</button>
        </form>
    </div>
</body>
</html>





