<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
    <link rel="stylesheet" href="css/dash.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.0/css/all.min.css"/>
</head>
<body>
    <div class="sidebar">
        <div>
            <a href="#" class="nav-link active" data-section="routes"><i class="fa-solid fa-route"></i> Routes</a>
            <a href="#" class="nav-link" data-section="tickets"><i class="fa-solid fa-ticket"></i> Tickets</a>
            <a href="#" class="nav-link" data-section="payments"><i class="fa-solid fa-money-bill"></i> Payments</a>
        </div>
        
        <div class="user-profile">
            <i class="fa-regular fa-user profile-icon"></i>
            <div class="user-column">
                
            <?php   
          
                $isLoggedIn = isset($_SESSION['user']);

                if ($isLoggedIn) {
                    $user = $_SESSION['user'];
                    echo "<h4>" . htmlspecialchars($user['name']) . "</h4>";
                } else {
                    echo "<p>You are not logged in.</p>";
                }
            ?>
            </div>
        </div>
    </div>

    <div class="main-content">
        <section id="routes" class="content-section">
        <div class="row"> 
            <h2>Routes</h2>
            <div class="add-button" onclick="openModal()">Add</div>
        </div>
        <table id="routes-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Departure</th>
                    <th>destination</th>
                    <th>Departure Time</th>
                    <th>Arrival Time</th>
                    <th>Ticket Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody ></tbody>
        </table>
    </section>

        <section id="tickets" class="content-section" style="display: none;">
            <h2>Tickets</h2>
            <table id="tickets-table">
                <thead>
                    <tr>
                        <th>Ticket ID</th>
                        <th>Route</th>
                        <th>Customer</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </section>

        <section id="payments" class="content-section" style="display: none;">
            <h2>Payments</h2>
            <table id="payments-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Route</th>
                        <th>Customer</th>
                        <th>Amount</th>
                        <th>Method</th>
                        <th>Payment Date</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </section>
    </div>

    <div id="addRouteModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h3>Add Route</h3>
            <form id="addRouteForm">
                <label for="image">Image:</label>
                <input type="file" id="image" name="image" accept="image/*" required>
                
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" placeholder="Enter route name" required>
                
                <label for="departure">Departure:</label>
                <input type="text" id="departure" name="departure" placeholder="Enter departure" required>
                
                <label for="destination">Destination:</label>
                <input type="text" id="destination" name="destination" placeholder="Enter destination" required>
                
                <label for="dtime">Departure Time:</label>
                <input type="time" id="dtime" name="dtime" required>
                
                <label for="atime">Arrival Time:</label>
                <input type="time" id="atime" name="atime" required>

                <label for="price">Route Price:</label>
                <input type="number" id="price" name="price" placeholder="Enter route price" required>

                <button type="submit">Submit</button>
            </form>
        </div>
    </div>

    <div id="editRouteModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeEditModal()">&times;</span>
            <h3>Add Route</h3>
            <form id="editRouteForm">
                <input type="hidden" id="edit-id" name="id">

                <label for="image">Image (Optional):</label>
                <input type="file" id="edit-image" name="image" accept="image/*">
                
                <label for="name">Name:</label>
                <input type="text" id="edit-name" name="name" placeholder="Enter route name" required>
                
                <label for="departure">Departure:</label>
                <input type="text" id="edit-departure" name="departure" placeholder="Enter departure" required>
                
                <label for="destination">Destination:</label>
                <input type="text" id="edit-destination" name="destination" placeholder="Enter destination" required>
                
                <label for="dtime">Departure Time:</label>
                <input type="time" id="edit-dtime" name="dtime" required>
                
                <label for="atime">Arrival Time:</label>
                <input type="time" id="edit-atime" name="atime" required>

                <label for="price">Route Price:</label>
                <input type="number" id="edit-price" name="price" placeholder="Enter route price" required>

                <button type="submit">Save Changes</button>
            </form>
        </div>
    </div>

    <script src="js/api.js"></script>
    <script>
        const navLinks = document.querySelectorAll('.nav-link');
        const sections = document.querySelectorAll('.content-section');

        navLinks.forEach(link => {
            link.addEventListener('click', event => {
                event.preventDefault();
                navLinks.forEach(link => link.classList.remove('active'));
                sections.forEach(section => section.style.display = 'none');
                link.classList.add('active');
                const sectionId = link.getAttribute('data-section');
                document.getElementById(sectionId).style.display = 'block';
            });
        });
    </script>
    
</body>
</html>
