<!DOCTYPE html>
<html lang="en">
    <link rel="icon" href="imgs/Downtown-logo.jpeg" type="image/png">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Downtown Delights</title>
    <link rel="stylesheet" href="../CSS/Contactus.css" type="text/css">
</head>
<body>
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
    <main>
        <div class="sidebar">
            <a href="offices.html">Our Offices</a>
            <a href="History.html">Our History</a>
            <a href="faqs.html">FAQs</a>
            <a href="News.html">News</a>
            <a href="forms.html">Forms</a> <br>
            
            <img src="../Images/insta.jpeg" alt="Instagram" width="30" height="30">
            <img src="../Images/face.jpeg" alt="Facebook" width="30" height="30">
            <img src="../Images/mail.jpeg" alt="E-Mail" width="30" height="30">
            <img src="../Images/twitter.jpeg" alt="Twitter" width="30" height="30"> <br>
            <br>
            <!--<p> Phone:For immediate assistance, please call us at:<br>📞(971) 55 2565082 Our phone lines are open Monday through Friday, from 9:00 AM to 5:00 PM (GST).</p>-->
        </div>

            <div class="content">
                
                <h1>Frequently Asked Questions (FAQs)</h1>
                <div class="faq">
                    <h2 class="faq-question">What are your operating hours?</h2>
                <div class="faq-answer">
                    <p>Our bakery operates from 8:00 AM to 6:00 PM, Monday through Saturday. On Sundays, we open at 9:00 AM and close at 4:00 PM. Please note that these hours may be subject to change during holidays, so we recommend checking our website or giving us a call for any updates on special business hours. We strive to provide you with fresh and delicious baked goods throughout our regular business hours.</p>
                </div>
                </div>
                
                <div class="faq">
                    <h2 class="faq-question">What is your return policy?</h2>
                <div class="faq-answer">
                    <p>We accept returns within 48 hours of purchase if you are not satisfied with your product. Please return the product in its original condition for a full refund or exchange. Custom orders are not eligible for returns due to their personalized nature.</p>
                </div>
                </div>

                
                <div class="faq">
                    <h2 class="faq-question">Do you have a loyalty or rewards program?</h2>
                <div class="faq-answer">
                    <p>Yes, we do! Sign up for our Sweet Rewards program to earn points for every purchase, which can be redeemed for discounts and free goodies. Plus, get a free treat on your birthday!</p>
                </div>
                </div>

                
                <div class="faq">
                    <h2 class="faq-question">How far in advance should I place an order for a special event?</h2>
                    <div class="faq-answer">
                    <p>For special events, we recommend placing your order at least 2 weeks in advance. For large orders or custom designs, more notice may be required. Please contact us to discuss your needs and we will do our best to accommodate you.</p>
                </div>
                </div>

                <div class="faq">
                    <h2 class="faq-question">Do you accommodate special dietary needs?</h2>
                    <div class="faq-answer">
                    <p>Yes, we offer a variety of options for those with dietary restrictions, including gluten-free, dairy-free, and vegan treats. Please inform us of any allergies or dietary needs when you place your order.</p>
                </div>
                </div>

                <div class="faq">
                    <h2 class="faq-question">Do you use organic ingredients?</h2>
                    <div class="faq-answer">
                    <p>Our commitment to quality means we use organic and locally sourced ingredients whenever possible. We believe in supporting sustainable agriculture and providing our customers with the freshest, highest quality baked goods.</p>
                </div>
                </div>

                <div class="faq">
                    <h2 class="faq-question">What is your cancellation policy for orders?</h2>
                    <div class="faq-answer">
                    <p>For regular orders, cancellations must be made at least 24 hours in advance for a full refund. Custom orders and catering services require a minimum of 48 hours' notice for cancellations. Please contact us as soon as possible if you need to cancel or modify your order.</p>
                </div>
                </div>

                <div class="faq">
                    <h2 class="faq-question">How do I provide feedback about my experience?</h2>
                    <div class="faq-answer">
                    <p>Your feedback is invaluable to us. Please feel free to share your thoughts through our website's contact form, via email, or directly in our bakery. We're always looking for ways to improve and appreciate your input.</p>
                </div>
                </div>

                <div class="faq">
                    <h2 class="faq-question">Can I request a donation for a local event or charity?</h2>
                    <div class="faq-answer">
                    <p>We're committed to supporting our community and consider donation requests on a case-by-case basis. Please send us detailed information about your event or charity, and we'll get back to you as soon as possible.</p>
                </div>
                </div>

                <div class="faq">
                    <h2 class="faq-question">Can I place an order for delivery?</h2>
                    <div class="faq-answer">
                    <p>Yes, we offer delivery services within a certain radius of our bakery. Delivery charges may apply based on the distance. Please visit our website or contact us directly to place an order for delivery.</p>
                </div>
                </div>

                <div class="faq">
                    <h2 class="faq-question">How should I store my pastries to keep them fresh?</h2>
                    <div class="faq-answer">
                    <p>Most pastries are best enjoyed on the day of purchase. However, if you need to store them, keep them in an airtight container at room temperature for up to 2 days. For longer storage, you can refrigerate them, though this may affect their texture. Bread should be kept in a bread box or wrapped in a paper bag to retain its crustiness.</p>
                </div>
                </div>

                <div class="faq">
                    <h2 class="faq-question">How can I find out about the nutritional information of your products?</h2>
                    <div class="faq-answer">
                    <p>Nutritional information for our products is available upon request. We understand the importance of dietary needs and strive to provide our customers with all the information they need to make informed choices. Please contact us directly for specific details.</p>
                </div>
                </div>

                
            </div>
            
        </div>
    </main>
    <div id="footer-content"></div>

  <div id="footer-content"> <div class="footer-section"> <h3>Contact Us</h3> <p>Phone: 123-456-7890</p> <p>Email: info@myecommercewebsite.com</p> <p>Address: 1234 Example Street, Town, State 12345</p> </div> <div class="footer-section"> <h3>Careers</h3> <p>Interested in joining our team? Visit our <a href="pages/careers.html">Careers page</a> to view current openings.</p> </div> <div class="footer-section"> <h3>About Us</h3> <p>Learn more about our company and our mission on our <a href="pages/aboutus.html">About Us page</a>.</p> </div> <div class="footer-section"> <h3>Schedule</h3> <p>View our <a href="pages/schedule.html">Schedule page</a> to see our upcoming events and promotions.</p> </div>
  <div class="footer-section"> <h3>Follow Us</h3> <p>Stay up-to-date with us on social media! Follow us on <a href="https://www.instagram.com/myecommercewebsite/">Instagram</a> </p>
  </div> 
  <div class="footer-section">
  <h3>Join Our Emailing List</h3>
  <p>Sign up for our emailing list to receive exclusive promotions and updates. Enter your email address below:</p> <form action="pages/emailsignup.html" method="post"> <input type="email" name="email" placeholder="Enter your email"> <input type="submit" value="Sign Up"> </form> </div> </div>
  <footer id="footer-content"> <p> &copy;2024 Downtown Delights Website. All rights reserved.</p> </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const faqQuestions = document.querySelectorAll('.faq-question');
        
            faqQuestions.forEach(function(question) {
                question.addEventListener('click', function() {
                    const answer = this.nextElementSibling;
                    answer.classList.toggle('open');
        
                    // Optional: Toggle the class of the question as well, e.g., for changing arrow icon
                    this.classList.toggle('active');
                });
            });
        });
        </script>
        
</body>
</html>