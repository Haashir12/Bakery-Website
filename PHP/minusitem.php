<?php
require_once 'ns.php'; // Include the file containing database connection code

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["minus_item"]) && isset($_POST["Customer_ID"]) && isset($_POST["product_id"])) {
    // Retrieve data from the form submission
    $Customer_ID = $_POST["Customer_ID"];
    $product_id = $_POST["product_id"];

    // Database connection for updating the quantity
    $conn_product = mysqli_connect($servername, $username, $p, $db_name);
    if ($conn_product->connect_error) {
        die("Connection failed: " . $conn_product->connect_error);
    }

    // Retrieve the current quantity of the product
    $get_quantity_query = "SELECT Quantity FROM Shopping_cart WHERE Customer_ID = '$Customer_ID' AND product_id = '$product_id'";
    $quantity_result = $conn_product->query($get_quantity_query);

    if ($quantity_result->num_rows > 0) {
        $row = $quantity_result->fetch_assoc();
        $current_quantity = $row["Quantity"];

        // Check if the quantity is greater than 1
        if ($current_quantity > 1) {
            // Decrease the quantity by 1
            $new_quantity = $current_quantity - 1;
            $update_quantity_query = "UPDATE Shopping_cart SET Quantity = '$new_quantity' WHERE Customer_ID = '$Customer_ID' AND product_id = '$product_id'";
            $result_update = $conn_product->query($update_quantity_query);
        } else {
            // If quantity is 1, remove the product from the cart
            $delete_product_query = "DELETE FROM Shopping_cart WHERE Customer_ID = '$Customer_ID' AND product_id = '$product_id'";
            $result_delete = $conn_product->query($delete_product_query);
        }
    }

    // Redirect back to the cart page after updating/deleting the product
    header('Location: cart.php?Customer_ID=' . $Customer_ID . (!empty($product_ids) ? '&product_ID[]=' . implode('&product_ID[]=', $product_ids) : ''));
    exit();
}
?>
