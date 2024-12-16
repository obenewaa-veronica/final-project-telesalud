<?php 
include '../settings/configuration.php';

//fetch medications from database
$query = "SELECT * FROM medications";
$result = mysqli_query($conn, $query);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Virtual Pharmacy</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />


    <link rel="stylesheet" href="../assets/css/virtualpharmacy.css">
    <script src="https://kit.fontawesome.com/dad03e859c.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Alkatra&family=Berkshire+Swash&family=Comic+Neue:wght@700&family=Gentium+Book+Plus:wght@400;700&family=Lato:ital,wght@0,400;0,700;0,900;1,700&family=Lexend+Deca:wght@500&family=Lexend:wght@500&family=Montserrat:wght@500&family=Open+Sans:wght@500;800&family=Roboto:wght@100;400&family=Sue+Ellen+Francisco&family=Work+Sans:wght@400;700;900&display=swap"
        rel="stylesheet">

    <link
        href="https://fonts.googleapis.com/css2?family=Spartan:wght@100;200;300;400;500;600;700;800;900;&display:swap">
   
</head>

<body>
    <section id="header">
        <a href="#"><img src="../assets/images/tele.png"></a>
        <div>
            <ul id="navbar">
                <li><a href="index.html" class="active">Home</a></li>
                <li><a href="shop.html">Shop</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="contact.html">Contact</a></li>
                <li><a href="display.html" id="lg-bag"><i class="fal fa-shopping-bag"></i></a>
                    <!--<span class="quantity">0</span>-->
                </li>
                <li><a href="#" id="close"<i class="far fa-times"></i></a></li>
            </ul>
        </div>
        <div id="mobile">
            <a href="display.html"><i class="fal fa-shopping-bag"></i>
                <!--<span class="quantity">0</span>-->
            </a>
            <i id="bar" class="fas fa-outdent"></i>
        </div>
    </section>

    <section id="hero">
        <h4>Trade-fairly</h4>
        <h2>Super value deals</h2>
        <h1>On all Medications</h1>
        <p>Save more with up to 70% off!</p>
        <button>Shop Now</button>

    </section>

    <!--Displaying medications-->
    <section id="product1" class="section-p1">
        <h2>Featured Medications</h2>
        <p>Medication Collections</p>
        <div class="pro-container">
            <?php 
            //fetch medications from database
            while($medication = mysqli_fetch_assoc($result)) {
                echo "
                    <div class='pro'>
                        <img src='{$medication['pictureURL']}' alt='{$medication['name']}'>
                        
                        <div class='des'>
                            <span>{$medication['manufacturer']}</span>
                            <h5>{$medication['name']}</h5>
                            <p>{$medication['description']}</p>
                            <h4>\${$medication['price']}</h4>

                            <!-- Add to Cart button with corrected function call -->
                            <button class='add-to-cart' onclick='addToCart(\"{$medication['medicationID']}\", \"{$medication['name']}\", \"{$medication['description']}\", \"{$medication['pictureURL']}\", {$medication['price']})' 
                            window.location.href='display.html';
                            '>
                                <i class='fal fa-shopping-cart cart'></i>
                            </button>

                            <!-- Buy Now button, with dynamic data -->
                            <button class='btn btn-primary mt-3' id='buy-now-btn' data-product-id='{$medication['medicationID']}' 
                                    data-name='{$medication['name']}' 
                                    data-price='{$medication['price']}'
                                    data-description='{$medication['description']}'
                                    data-picture='{$medication['pictureURL']}'>
                                Order Now
                            </button>


                        </div>
                    </div>
                ";

            }
            ?>
        </div>
    </section>
            
    <!--EXPLORE BANNER-->
    <section id="banner" class="section-m1">
        <h4> Drugs Order</h4>
        <h2>Up to <span>30% off </span> - Medications</h2>
        <button class="btn normal">Explore more</button>
    </section>
    
    <!--BANNER-->
    <section id="banner3" class="section-p1">
        <div class="banner-box">

            <h2>FOOD SUPPLEMENTS ORDER</h2>
            <h3>All-Round Supplements -50% OFF</h3>

        </div>

        <div class="banner-box banner-img2">

            <h2>PAIN RELIEF ORDER</h2>
            <h3>Pain reliefs -10% OFF</h3>

        </div>

        <div class="banner-box banner-img3">

            <h2>DIGESTIVE HEALTH</h2>
            <h3>Digestive Medication -30% OFF</h3>

        </div>

    </section>

    <section id="newsletter" class="section-p1">
        <div class="newstext">
            <h4>Sign Up for Newsletters</h4>
            <p>Get Email updates about our latest Medications and <span> special offers.</span> </p>
        </div>
        <div class="form">
            <input type="text" placeholder="Your email address">
            <button class="btn normal">Sign Up</button>
        </div>

        </div>

    </section>

    <!--Footer-->
    <footer class="section-p1">

        <div class="col">
            <a href="#"><img class="logo" src="../assets/images/tele.png"></a>
            <h4>Contact</h4>
            <p><strong>Address:<strong>1 University Avenue, Berekuso, Ghana</p>
            <p><strong>Phone:</strong>+233268376848, +233548714598</p>
            <!--<p><strong>Hours:</strong>10.00 - 18.00, Mon - Sat</p>-->
            <div class="follow">
                <h4>Follow Us</h4>
                <div class="icon">
                    <i class="fab fa-facebook-f"></i>
                    <i class="fab fa-instagram"></i>
                    <i class="fab fa-youtube"></i>
                    <i class="fab fa-tiktok"></i>
                    <i class="fa fa-linkedin" aria-hidden="true"></i>
                </div>
            </div>
        </div>

        <div class="sec">
            <div class="col">
                <h4>About</h4>
                <a href="#">About Us</a>
                <a href="#">Delivery Information</a>
                <a href="#">Privacy Policy</a>
                <a href="#">Terms and Condition</a>
                <a href="#">Contact Us</a>
            </div>


            <div class="col install">
                <h4>Install App</h4>
                <p>From App Store or Google Play</p>

                <div class="row">
                    <img src="https://i.postimg.cc/Y2s5mLdR/app.jpg" alt="">
                    <img src="https://i.postimg.cc/7YvyWTS6/play.jpg" alt="">
                </div>
                <p>Secured Payment Gateways</p>
                <img src="https://i.postimg.cc/kgfzqVRW/pay.png" alt="">
            </div>
        </div>

        <div class="coypright">
            <p> © 2024 All rights reserved! made by Telesalud </p>
        </div>

    </footer>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="../assets/js/checkout.js"></script>
    <script src="../assets/js/add_cart.js"></script>
    <script src="../assets/js/virtualpharmacy.js"></script>
</body>

</html>