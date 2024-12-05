<?php
session_start();

$userId = isset($_SESSION['user']) ? $_SESSION['user']['id'] : null;
$name = isset($_SESSION['user']) ? $_SESSION['user']['name'] : null;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.0/css/all.min.css"/>
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
    <style>
        
    .ticket-form-container {
        margin: 40px 100px;
        padding: 15px;
        background: #f9f9f9;
        border: 1px solid #ddd;
        border-radius: 8px;
        
    }

    .ticket-form-container h3 {
        margin-bottom: 10px;
    }

    #ticket-form label {
        display: block;
        margin: 8px 0 4px;
        font-weight: bold;
    }

    #ticket-form input {
        width: 100%;
        padding: 8px;
        margin-bottom: 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    #ticket-form select {
        width: 100%;
        padding: 8px;
        margin-bottom: 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .book-btn {
        background-color: #2a7ce8;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .book-btn:hover {
        background-color: #0056b3;
    }
</style>
</head>
<body>
    <div id="route-details" class="details-container">
        <h2>Loading route details...</h2>
    </div>

    <header>
    <h2 class="logo"><span>F</span>erry <span>B</span>ooking</h2>
    
    <?php if (isset($_SESSION['user'])): ?>
        <a href="logout.php" class="btn-talk">Log out</a>
    <?php else: ?>
        <a href="auth.html?type=Customer" class="btn-talk">Log in</a>
    <?php endif; ?>
</header>
<div class="ticket-form-container">
    <h3>Book This Route</h3>
    <form id="ticket-form" >
        <input type="hidden" name="rid" id="rid" value="">

        <label for="date">Date:</label>
        <input type="text" id="date" name="date" placeholder="Select pick-up date" required>
        <div class="form-group">
                <label for="creditCardNumber">Credit Card Number:</label>
                <input type="text" id="creditCardNumber" required placeholder="1234 5678 1234 5678">
            </div>
            <div class="form-group">
                <label for="creditCardExpiry">Expiry Date:</label>
                <input type="month" id="creditCardExpiry" required>
            </div>
            <div class="form-group">
                <label for="creditCardCVV">CVV:</label>
                <input type="text" id="creditCardCVV" required placeholder="123">
            </div>

        <label for="method">Payment Method:</label>
        <select id="method" name="method" required>
            <option value="" disabled selected>Select payment method</option>
            <option value="Electronic">Electronic</option>
            <option value="Cash">Cash</option>
        </select>
        
        <button type="submit" class="book-btn">Book Now</button>
    </form>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    let route = {};
const userId = <?php echo json_encode($userId); ?>;
const userName = <?php echo json_encode($name); ?>;
    
document.getElementById('ticket-form').addEventListener('submit', async function (e) {
    e.preventDefault();

    const formData = new FormData(this);

    const routeName = route.name;
    const routePrice = route.price; 
    const startDate = document.getElementById('date').value;
    const date = new Date(startDate);
    const method = document.getElementById('method').value;

    formData.append('route', routeName);
    formData.append('name', userName); 
    formData.append('date', date);
    formData.append('amount', routePrice);
    formData.append('method', method);

    if (userId === null || userId === "") {
        alert('Please log in in order to continue');
        window.location.href = 'auth.html?type=Customer';
    } else {
        try {
            const response = await fetch('add_ticket.php', {
                method: 'POST',
                body: formData,
            });

            const text = await response.text();
            console.log('Raw server response:', text); 

            try {
                const result = JSON.parse(text); 
                if (result.success) {
                    alert('Route rented successfully');
                    window.location.href = 'index.php'; 
                } else {
                    alert(`Error: ${result.message}`);
                }
            } catch (jsonError) {
                console.error('Error parsing JSON:', jsonError);
                alert('An error occurred. Please try again.');
            }
        } catch (error) {
            console.error('Error adding route:', error);
            alert('An error occurred. Please try again.');
        }
    }
});



        const urlParams = new URLSearchParams(window.location.search);
        const routeId = urlParams.get('id');

    flatpickr("#date", {
        enableTime: false,
        dateFormat: "Y-m-d",
        minDate: "today",
       
    });


    async function fetchrouteDetails() {
            try {
                const response = await fetch(`get_routes-details.php?id=${routeId}`);
                route = await response.json();
                document.getElementById('route-details').innerHTML = `
                <div class="route-item">
                                <div >
                        <img class="route-image" src="${route.image}" alt="${route.name}">
                    </div>
                    <div class="route-info">
                        <h2>${route.name}</h2>
                         <p><span>Departure</span>: ${route.departure}, <span>Time</span> : ${route.dtime}</p>
                         <p><span>Departure</span>: ${route.destination}, <span>Time</span> : ${route.atime}</p>
                        <div class="price"><strong>Price</strong> $${route.price}</div>
                        <p>Read our <a href="#">TERMS AND CONDITIONS HERE.</a></p>
                    </div>
                </div>

                `;
            } catch (error) {
                console.error('Error fetching route details:', error);
                document.getElementById('route-details').innerHTML = `<p>Error loading details.</p>`;
        }
    }
    fetchrouteDetails();
</script>

<footer class="site-footer">
        <div class="container">
            <div class="row">
            <div class="col-sm-12 col-md-6">
                <h6>About</h6>
                <p class="text-justify"><strong>Ferry Ticket Booking System</strong>  ticket provides affordable and convenient car hire service within Kenya and East Africa. We have a wide range of low-cost routes and applications for rent to suit your each need. <a href="https://studio5ive.org">www.studio5ive.org</a></p>
            </div>

            <div class="col-xs-6 col-md-3">
                <h6>Categories</h6>
                <div class="contact-row">
                    <i class="fa-solid fa-location-dot"></i>
                    <p> Nyayo Estate, Embakasi P.O Box 52196-00100 Nairobi</p>
                </div>
                <div class="contact-row">
                    <i class="fa-solid fa-envelope"></i>
                    <p> info@route.com</p>
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

</body>
</html>
