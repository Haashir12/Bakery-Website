<!DOCTYPE HTML>
<html>
<?php
require_once 'ns.php';
echo "<br>";
echo "<br>";
echo "<br>";
?>

<head>
    <title>Product Page</title>
    <link rel="stylesheet" href="../CSS/productphp.css" type="text/css">
    <style>
    </style>
</head>

<body>

    <form method="post" action="product.php?Customer_ID=<?php echo $Customer_ID; ?>">
        <input type="text" name="txtsearch" placeholder="Have something in mind?" class="ansearch">
        <input type="submit" value="search" class="submit">
    </form>
    <br><br>

    <div>
        <form method="post" action="product.php?Customer_ID=<?php echo $Customer_ID; ?>">
            <select name="Sort">
                <option value="0" id="0">Sort Products</option>
                <option value="1" id="1">Sort A - Z</option>
                <option value="2" id="2">Sort Z - A</option>
                <option value="3" id="3">Sort by Price (Lower to Higher)</option>
                <option value="4" id="4">Sort by Price (Higher to Lower)</option>
            </select>
            <input type="submit" value="Sort">
        </form>
    </div>

    <?php

$conn = mysqli_connect($servername, $username, $p, $db_name);

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT * FROM product";

                    // Check if form is submitted and search text is provided
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['txtsearch'])) {
                        $s = $_POST["txtsearch"];
                        echo " Results for $s <br>";
                        $sql = "SELECT * FROM product WHERE Product_Name LIKE '%" . $s . "%'";
                    }

                    // Check if form is submitted and sort option is selected
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Sort'])) {
                        $sort = $_POST['Sort'];
                        switch ($sort) {
                            case "1":
                                $sql .= " ORDER BY Product_Name";
                                break;
                            case "2":
                                $sql .= " ORDER BY Product_Name DESC";
                                break;
                            case "3":
                                $sql .= " ORDER BY product_price";
                                break;
                            case "4":
                                $sql .= " ORDER BY product_price DESC";
                                break;
                            default:
                                echo "Invalid sorting option.";
                                break;
                        }
                    }

                    // Check if category is selected and adjust SQL query accordingly
                    if (isset($_GET["cat"]) && $_GET["cat"] != "") {
                        $cat = $_GET["cat"];
                        $sql = "SELECT * FROM product WHERE Category_ID = '$cat'";
                    }

                    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<ul class='normal-list'>";
            echo "<li><img src='../Images/" . $row["Picture_File"] . "' class='normal-image'></li>";
            echo "<br>";
            echo "<li class='normal-text'>" . $row["Product_Name"] . "</li>";
            echo "<br>";
            echo "<li class='normal-text'> AED " . $row["product_price"] . "</li>";
            echo "<br>";
            echo "<li><a href='../PHP/productDescription.php?product_id=" . $row["product_id"] . "&Customer_ID=" . $Customer_ID . "' class='normal-text-link'>Learn more...</a></li>";
            echo "<li><a href='../PHP/cart.php?product_id=" . $row["product_id"] . "&Customer_ID=" . $Customer_ID . "'>
            <button type='button' style='border: none; background: none; padding: 0; margin: 0;'>
                <img src='../Icons/BS.png' class='normal-icon'>
            </button>
          </a></li>";
    
            echo "</ul>";
        }
    } else {
        echo "No products found";
    }

    if (isset($_GET["Customer_ID"])) {
        $Customer_ID = $_GET["Customer_ID"];

        $sql_customer = "SELECT * FROM Customer WHERE Customer_ID = '$Customer_ID'";

        $result_customer = $conn->query($sql_customer);

        if ($result_customer->num_rows > 0) {
            $row_customer = $result_customer->fetch_assoc();
            $customer = "<p>Welcome, " . $row_customer["Customer_Name"] . "</p>";
        } else {
            // Customer not found
            // echo "Customer not found";
        }
    } else {
        // Customer ID not provided in the URL
        // echo "Customer ID not specified";
    }
    
    $conn->close();

    ?>

</body>

</html>
