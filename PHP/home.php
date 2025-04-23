<!Doctype html>
<html>
<head>
    <title> home </title>
    <link rel="stylesheet" href="../CSS/home.css" type="text/css"> 
    <script src="https://kit.fontawesome.com/ad63a3ea3e.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=El+Messiri:wght@400..700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&display=swap" rel="stylesheet">
</head>
<?php
    require_once 'ns.php';
    ?>
<br>
<body>
<?php 
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
                                        $customer =  "<p>Welcome,  " . $row["Customer_Name"] . "</p>";

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

       <div id="header-content">
        <br>
            <h1>Downtown Delights</h1>

       </div>
      
    </body>
    </html>
    
       

   </div>

<div id="main-content">
    
    <section class="homepage_products" style="margin-top: 40px;">
        <h3 class="gothic center"> Daily Picks </h3>
        <div class="center">
            <p style="width: 55%; padding-top: 30px;">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua. 
            </p>
        </div>
    
    
        <div class="flex" style="margin-top: 30px; gap:10px">
            <div>
                <img src="../Images/Cookies.png" alt="Cookies" width="100%" height="280px">
                <div class="label">
                    Cookies
                </div>
            </div>
            <div>
                <img src="../Images/Cupcakes.png" alt="Cupcakes" width="100%" height="280px">
                <div class="label">
                    Cupcakes
                </div>
            </div>
    
            <div>
                <img src="../Images/Croissants.png" alt="Croissants" width="100%" height="280px">
                <div class="label">
                    Croissants
                </div>
            </div>
        </div>
        <br><br><br><br><br>
    
    </section>

</div>

   

    <div id="footer-content"></div>

  <div id="footer-content"> <div class="footer-section"> <h3>Contact Us</h3> <p>Phone: 123-456-7890</p> <p>Email: info@myecommercewebsite.com</p> <p>Address: 1234 Example Street, Town, State 12345</p> </div> <div class="footer-section"> <h3>Careers</h3> <p>Interested in joining our team? Visit our <a href="pages/careers.html">Careers page</a> to view current openings.</p> </div> <div class="footer-section"> <h3>About Us</h3> <p>Learn more about our company and our mission on our <a href="pages/aboutus.html">About Us page</a>.</p> </div> <div class="footer-section"> <h3>Schedule</h3> <p>View our <a href="pages/schedule.html">Schedule page</a> to see our upcoming events and promotions.</p> </div>
  <div class="footer-section"> <h3>Follow Us</h3> <p>Stay up-to-date with us on social media! Follow us on <a href="https://www.instagram.com/myecommercewebsite/">Instagram</a> </p>
  </div> 
  <div class="footer-section">
  <h3>Join Our Emailing List</h3>
  <p>Sign up for our emailing list to receive exclusive promotions and updates. Enter your email address below:</p> <form action="pages/emailsignup.html" method="post"> <input type="email" name="email" placeholder="Enter your email"> <input type="submit" value="Sign Up"> </form> </div> </div>
  <footer id="footer-content"> <p> &copy;2024 Downtown Delights Website. All rights reserved.</p> </footer>


</body>


</html>