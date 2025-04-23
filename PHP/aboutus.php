<!DOCTYPE html>
<html lang="en">
    <?php
    require_once 'ns.php'; 


                                        $conn = mysqli_connect($servername, $username, $p, $db_name);


                                                                    if ($conn->connect_error) {
                                                                        die("Connection failed: " . $conn->connect_error);
                                                                    }

                                        if (isset($_GET["Customer_ID"])) {
                                            $Customer_ID = $_GET["Customer_ID"];

                                            $sql = "SELECT * FROM Customer WHERE Customer_ID = '$Customer_ID'";
                                        
                                            $result = $conn->query($sql);

                                            if ($result->num_rows > 0) {
                                    
                                                $row = $result->fetch_assoc();
                                                $customer =  "<p>Welcome, " . $row["Customer_Name"] . "</p>";

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
    <br>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/aboutus.css" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=El+Messiri:wght@400..700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&display=swap" rel="stylesheet">
    <title>About Us</title>
</head>

<body>

    <section class="aboutus_section">
        <div class="overlay"></div>
        <h1 class="aboutus_heading gothic">About Us</h1>
    </section>

    <section class="aboutus_welcome">

        <div class="welcome_info">
            <h3 class="gothic">Welcome To Downtown Delights</h2>
                <div style="margin-top: 10px;">
                    <h4 class="gothic">Who are we?
            </h3>
            <p style="padding-top: 5px;">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt
                ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                laboris
                nisi ut aliquip ex ea commodo consequat.
            </p>
        </div>
        </div>
        <div class="gallery">
            <img src="../Images/BakeShop.png" alt="Image of a bakery" width="80%">
        </div>

    </section>

    <section>
        <div class="aboutus_chefs">
            <h3 class="gothic center">MEET OUR AMAZING CHEFS</h3>
            <div class="flex" style="margin-top: 30px;">
                <div class="chef">
                    <img src="../Images/chef1.png" alt="Chef 1" width="100%" height="280px">
                    <div class="chef_tag">
                        <h4 class="gothic">Chef Naomi</h4>
                        <p class="small">Head Chef</p>
                    </div>
                </div>
                <div class="chef">
                    <img src="../Images/chef2.png" alt="Chef 2" width="100%" height="280px">
                    <div class="chef_tag">
                        <h4 class="gothic">Chef Tina</h4>
                        <p class="small">Pastry Chef</p>
                    </div>
                </div>
                <div class="chef">
                    <img src="../Images/chef3.png" alt="Chef 3" width="100%" height="280px">
                    <div class="chef_tag">
                        <h4 class="gothic">Chef Chris</h4>
                        <p class="small">Executive Chef</p>
                    </div>
                </div>
            </div>
        </div>

        <div style="display:flex; justify-content: end; margin-top: 10px;">
            <button class="buttonfont">
                Join The Team
            </button>
        </div>

    </section>

    <section class="aboutus_products" style="margin-top: 40px;">
        <h3 class="gothic center">OUR CATEGORIES</h3>
        <div class="center">
            <p style="width: 55%; padding-top: 30px;">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                ex
                ea commodo consequat.
            </p>
        </div>


        <div class="flex" style="margin-top: 30px; gap:10px">
            <div class="chef">
                <img src="../Images/Cookies.png" alt="Chef 1" width="100%" height="280px">
                <div class="label">
                    Cookies
                </div>
            </div>
            <div class="chef">
                <img src="../Images/Cupcakes.png" alt="Chef 2" width="100%" height="280px">
                <div class="label">
                    Cupcakes
                </div>
            </div>
            <div class="chef">
                <img src="../Images/Cakes.png" alt="Chef 3" width="100%" height="280px">
                <div class="label">
                    Cakes
                </div>
            </div>

            <div class="chef">
                <img src="../Images/Croissants.png" alt="Chef 3" width="100%" height="280px">
                <div class="label">
                    Croissants
                </div>
            </div>
        </div>

    </section>

    <section class="aboutus_branches" style="margin-top: 130px;">
        <h3 class="gothic center">OUR BRANCHES</h3>


        <div class="flex" style="margin-top: 30px; gap:10px">

            <div class="center-col" style="width: 100%;">
                <img src="../Images/Branch1.png" alt="Chef 1" class="branch">
                <div class="label">
                    Al Barsha
                </div>

                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. 
                </p>

            </div>

            <div class="center-col" style="width: 100%;">
                <img src="../Images/Branch2.png" alt="Chef 2" class="branch">
                <div class="label">
                    DAMAC Hills
                </div>

                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua.
                </p>

            </div>


            <div class="center-col" style="width: 100%;">
                <img src="../Images/Branch3.png" alt="Chef 3" class="branch">
                <div class="label">
                    City Walk
                </div>

            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua. 
            </p>

            </div>

        </div>

    </section>

</body>

</html>