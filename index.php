<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elite Car Rental</title>
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.0/css/all.min.css"/>
    
</head>
<body>

    <header>
        <h2 class="logo"><span>F</span>erry <span>B</span>ooking</h2>
        <nav class="navigation">
            <a href="#">Home</a>
            <a href="#">About</a>
            <a href="#services">Services</a>
            <a href="#">Reviews</a>
            <a href="#">Contact</a>
            <?php if (isset($_SESSION['user']) && $_SESSION['user']['type'] === 'Admin'): ?>
                <a href="dashboard.php">Dashboard</a>
            <?php endif; ?>

        </nav>
        <?php if (isset($_SESSION['user'])): ?>
            <a href="logout.php" class="btn-talk">Log out</a>
        <?php else: ?>
            <a href="auth.html" class="btn-talk">Log in</a>
        <?php endif; ?>
    </header>

    <section class="home">
        <div class="content">
            <h2>Need to travel <span class="auto-type"></span></h2>
            
            <p>Secure a spot on your preferred sailing. Book for yourself, your business, or for a travel client.</p>
            <div class="btn-group">
                <a href="vehicle.php">Online Booking</a>
            </div>
        </div>
        <div class="home-image">
            
        </div>
    </section>

    <section id="ferry" class="ferry-section">
        <div class="position-relative d-flex align-items-center justify-content-center">
            <h1 class="reveal display-1 text-uppercase text-white" style="-webkit-text-stroke: 1px #dee2e6;">Ferries</h1>
            <h1 class="reveal position-absolute text-uppercase text-primary color:#7d2ae8">Our Ferries</h1>
        </div>
        <div class="ferry-grid">
        </div>
        <br>
        <a href="vehicle.php">View All</a>
    </section>

    <div class="container-fluid pt-5" id="service">
            <div class="container">
                <div class="position-relative d-flex align-items-center justify-content-center">
                    <h1 class="reveal display-1 text-uppercase text-white" style="-webkit-text-stroke: 1px #dee2e6;">Service</h1>
                    <h1 class="reveal position-absolute text-uppercase text-primary color:#7d2ae8">Our Services</h1>
                </div>
                <div class="row pb-3">
                    <div class="reveal col-lg-4 col-md-6 text-center mb-5">
                        <div class="d-flex align-items-center justify-content-center mb-4">
                            <i class="fa-solid fa-ticket service-icon bg-primary text-white mr-3"></i>
                            <h4 class="font-weight-bold m-0">Ferry Ticket Booking</h4>
                            
                        </div>
                        <p>Simplify travel plans by allowing customers to book ferry tickets online for various routes, dates, and times, with instant confirmation.</p>
                        <a class="border-bottom border-primary text-decoration-none" href="">Read More</a>
                    </div>
                    <div class="reveal col-lg-4 col-md-6 text-center mb-5">
                        <div class="d-flex align-items-center justify-content-center mb-4">
                            <i class="fa-solid fa-clock service-icon bg-primary text-white mr-3"></i>
                            <h4 class="font-weight-bold m-0">Real-Time Schedule Updates</h4>
                           
                        </div>
                        <p>Provide up-to-date ferry schedules, including delays or cancellations, to ensure travelers can plan their journeys seamlessly.</p>
                        <a class="border-bottom border-primary text-decoration-none" href="">Read More</a>
                    </div>
                    <div class="reveal col-lg-4 col-md-6 text-center mb-5">
                        <div class="d-flex align-items-center justify-content-center mb-4">
                            <i class="fa-solid fa-tag service-icon bg-primary text-white mr-3"></i>
                            <h4 class="font-weight-bold m-0"> Exclusive Deals and Discounts</h4>
                            
                        
                        </div>
                        <p>Offer promotions such as early bird discounts or group packages to attract budget-conscious travelers.</p>
                        <a class="border-bottom border-primary text-decoration-none" href="">Read More</a>
                    </div>
                    <div class="reveal col-lg-4 col-md-6 text-center mb-5">
                        <div class="d-flex align-items-center justify-content-center mb-4">
                            <i class="fa-solid fa-route service-icon bg-primary text-white mr-3"></i>
                            <h4 class="font-weight-bold m-0">Multi-Route Itinerary Planning</h4>
                          
                        </div>
                        <p>Allow users to create customized travel plans that include multiple ferry routes and destinations in one booking.</p>
                        <a class="border-bottom border-primary text-decoration-none" href="">Read More</a>
                    </div>
                    <div class="reveal col-lg-4 col-md-6 text-center mb-5">
                        <div class="d-flex align-items-center justify-content-center mb-4">
                            <i class="fa-solid fa-truck service-icon bg-primary text-white mr-3"></i>
                            <h4 class="font-weight-bold m-0">Cargo and Vehicle Transport Booking</h4>
                            
                        </div>
                        <p>Facilitate reservations for transporting ferry or cargo, catering to individuals and businesses with logistical needs.</p>
                        <a class="border-bottom border-primary text-decoration-none" href="">Read More</a>
                    </div>
                    <div class="reveal col-lg-4 col-md-6 text-center mb-5">
                        <div class="d-flex align-items-center justify-content-center mb-4">
                            <i class="fa-solid fa-file service-icon bg-primary text-white mr-3"></i>
                            <h4 class="font-weight-bold m-0">Travel Insurance and Add-Ons</h4>
                           
                        
                        </div>
                        <p>Provide optional travel insurance and extras like meal plans, priority boarding, or cabin upgrades for a premium experience.</p>
                        <a class="border-bottom border-primary text-decoration-none" href="">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    

    <section class="contact-us">
        <div class="cotact-us-container">
            <h4 class="reveal">Book Online Today And Travel</h4>
            <h4 class="reveal">In Comfort On Your Next Trip</h4>
            <p class="reveal">Contact us today and book your next trip using our secure online booking system.</p>
            <a href="#" class="btn-talk reveal">Talk to us</a>
        </div>
    </section>

    <div class="container-fluid py-5" id="testimonial">
        <div class="container">
            <div class="position-relative d-flex align-items-center justify-content-center">
                <h1 class="reveal display-1 text-uppercase text-white" style="-webkit-text-stroke: 1px #dee2e6;">Review</h1>
                <h1 class="reveal position-absolute text-uppercase text-primary">Clients Say</h1>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="owl-carousel testimonial-carousel">
                        <div class="text-center">
                            <i class="fa fa-3x fa-quote-left text-primary mb-4 reveal"></i>
                            <h4 class="reveal font-weight-light mb-4">Dolor eirmod diam stet kasd sed. Aliqu rebum est eos. Rebum elitr dolore et eos labore, stet justo sed est sed. Diam sed sed dolor stet accusam amet eirmod eos, labore diam clita</h4>
                            <img class="reveal img-fluid rounded-circle mx-auto mb-3" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQNBs1Mg71nW8adit7yHWWokb25jXLe1ATFpTWhpl2VZXqnZt6yg52pkslyGQQ5pSYWyvw&usqp=CAU" style="width: 80px; height: 80px;">
                            <h5 class="font-weight-bold m-0">Mellisa Fumero</h5>
                            <span class="reveal">Profession</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="faq" id="faq">
                <div class="column">
                    <div class="column reveal">
                        <h1>Frequently Asked Questions</h1> 
                        <h2>Here are some of Frequently Asked Questions from Registered customer’s</h2>
                    </div>
                    <div class="accd-grid">
                        <div class="first-acc"> 
                            <ul class="accordion reveal">
                                <li>
                                    <input type="radio" name="accordion" id="first">
                                    <label for="first">How can I book a ferry ticket?</label>
                                    <div class="content">
                                        <p>
                                        You can book a ferry ticket by selecting your departure and destination ports, travel date, and the number of passengers. Add the trip to your cart, fill in your details, and complete the payment process.
                                        </p>
                                    </div>
                                </li>
                            </ul>
                
                            <ul class="accordion reveal">
                                <li>
                                    <input type="radio" name="accordion" id="second">
                                    <label for="second">Can I modify or cancel my booking?</label>
                                    <div class="content">
                                        <p>
                                        Yes, modifications or cancellations are possible, but they are subject to the ferry operator’s policies. Please check the terms and conditions during booking or contact customer support for assistance.
                                        </p>
                                    </div>
                                </li>
                            </ul>
                
                            <ul class="accordion reveal">
                                <li>
                                    <input type="radio" name="accordion" id="third">
                                    <label for="third">What payment methods do you accept?</label>
                                    <div class="content">
                                        <p>
                                        We accept major credit/debit cards, PayPal, and other secure payment options. Some routes may also support local payment methods.
                                        </p>
                                    </div>
                                </li>
                            </ul>
                
                            <ul class="accordion reveal">
                                <li>
                                    <input type="radio" name="accordion" id="fourth">
                                    <label for="fourth">Can I book tickets for vehicles or cargo?</label>
                                    <div class="content">
                                        <p>
                                        Yes, our platform allows you to book space for vehicles or cargo. Simply choose the appropriate options during the booking process, including vehicle type and dimensions.
                                        </p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="second-acc">
                            <ul class="accordion reveal">
                                <li>
                                    <input type="radio" name="accordion" id="fifth">
                                    <label for="fifth"> Do I need to print my ticket?</label>
                                    <div class="content">
                                        <p>
                                        Not necessarily. Many ferry operators accept digital tickets, which can be shown on your mobile device. However, please check the specific requirements of your ferry operator.
                                        </p>
                                    </div>
                                </li>
                            </ul>
                
                            <ul class="accordion reveal">
                                <li>
                                    <input type="radio" name="accordion" id="sixth">
                                    <label for="sixth">Are there discounts for children or groups?</label>
                                    <div class="content">
                                        <p>
                                        Yes, discounts for children, seniors, and group bookings may be available, depending on the ferry operator. These will be automatically applied during the booking process if applicable.
                                        </p>
                                    </div>
                                </li>
                            </ul>
                
                            <ul class="accordion reveal">
                                <li>
                                    <input type="radio" name="accordion" id="seventh">
                                    <label for="seventh">What happens if my ferry is delayed or canceled?</label>
                                    <div class="content">
                                        <p>
                                        In case of delays or cancellations, you will be notified via email or SMS. You may be eligible for a refund or a seat on the next available ferry, depending on the operator’s policy.
                                        </p>
                                    </div>
                                </li>
                            </ul>
                
                            <ul class="accordion reveal">
                                <li>
                                    <input type="radio" name="accordion" id="eigth">
                                    <label for="eigth">How can I contact customer support?</label>
                                    <div class="content">
                                        <p>
                                        You can reach our customer support team via email, live chat, or phone for any inquiries or assistance. Visit the "Contact Us" section of our website for details.
                                        </p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
    </section>


    <footer class="site-footer">
        <div class="container">
            <div class="row">
            <div class="col-sm-12 col-md-6">
                <h6>About</h6>
                <p class="text-justify"><strong>Elite Car Rental Hire Payment System</strong>  Rental provides affordable and convenient car hire service within Kenya and East Africa. We have a wide range of low-cost vehicles and applications for rent to suit your each need. <a href="https://studio5ive.org">www.studio5ive.org</a></p>
            </div>

            <div class="col-xs-6 col-md-3">
                <h6>Categories</h6>
                <div class="contact-row">
                    <i class="fa-solid fa-location-dot"></i>
                    <p> Nyayo Estate, Embakasi P.O Box 52196-00100 Nairobi</p>
                </div>
                <div class="contact-row">
                    <i class="fa-solid fa-envelope"></i>
                    <p> info@elite.com</p>
                </div>
                <div class="contact-row">
                <i class="fa-solid fa-phone"></i>
                    <p> +254712345678</p>
                </div>
            </div>

            <div class="col-xs-6 col-md-3">
                <h6>Quick Links</h6>
                <ul class="footer-links">
                <li><a href="http://scanfcode.com/about/">About Us</a></li>
                <li><a href="http://scanfcode.com/contact/">Contact Us</a></li>
                <li><a href="http://scanfcode.com/contribute-at-scanfcode/">Contribute</a></li>
                <li><a href="http://scanfcode.com/privacy-policy/">Privacy Policy</a></li>
                <li><a href="http://scanfcode.com/sitemap/">Sitemap</a></li>
                </ul>
            </div>
            </div>
            <hr>
        </div>
        <div class="container">
            <div class="row">
            <div class="col-md-8 col-sm-6 col-xs-12">
                <p class="copyright-text">Copyright &copy; 2024 All Rights Reserved by 
                <a href="https://studio5ive.org">studio5ive.org</a>
                </p>
            </div>

            <div class="col-md-4 col-sm-6 col-xs-12">
                <ul class="social-icons">
                <li><a class="facebook" href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                <li><a class="twitter" href="#"><i class="fa-brands fa-x-twitter"></i></a></li>
                <li><a class="dribbble" href="#"><i class="fa-brands fa-instagram"></i></a></li>
                <li><a class="linkedin" href="#"><i class="fa-brands fa-linkedin-in"></i></a></li>   
                </ul>
            </div>
            </div>
        </div>

    </footer>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/main.js"></script>
    <script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>
        <script>
            var typed = new Typed(".auto-type",{
                strings : ["in Luxury?", "urgently?", "abroad?"],
                typeSpeed: 100,
                backSpeed: 100,
                looped: true
            })
        </script>
</body>
</html>
