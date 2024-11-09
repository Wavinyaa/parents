<?php
session_start();
include("db_connect.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css"> <!-- Your custom styles -->


    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Parents in Sync</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link" href="home.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="aboutus.php">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="forum.php">Forum</a></li>
                    <li class="nav-item"><a class="nav-link" href="resources.php">Resources</a></li>
                </ul>
            </div>
        </div>
    </nav>
    
    <title>Forum Categories - Parents in Sync</title>


    <style>
        body {
            background: url('mom and baby.jpg') no-repeat center center fixed; /* Full-page background image */
            background-size: cover; /* Cover the entire page */
            color: #333; /
        }
        .card {
            background: url('path/to/your/background-image.jpg') no-repeat center center; /* Add your image path */
            background-size: cover; /* Cover the entire card */
            border: none; /* Remove border for a cleaner look */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
            display: flex; /* Enable flexbox */
            flex-direction: column; /* Stack items vertically */
            justify-content: space-between; /* Distribute space evenly */
            min-height: 300px; /* Set a minimum height for cards */
            margin: 15px 0; /* Margin between cards */
            color: #ffffff; /* White text for better contrast against background */
        }
        .card-title {
            color: #ffffff; /* White color for card titles */
            font-size: 1.75rem; /* Increased title size */
            margin-bottom: 10px; /* Space below title */
        }
        .list-group-item {
            background-color: rgba(255, 255, 255, 0.9); /* Slightly transparent white for list items */
        }
        .list-group-item a {
            text-decoration: none; /* Remove underline from links */
            color: #495057; /* Dark text color */
        }
        .list-group-item a:hover {
            text-decoration: underline; /* Underline on hover for better UX */
            color: #007bff; /* Change color on hover */
        }
        .explore-btn {
            background-color: #007bff; /* Bootstrap primary color */
            color: #ffffff; /* White text for buttons */
            margin-top: auto; /* Push the button to the bottom */
        }
        .explore-btn:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }
        /* Equal height for columns */
        .row {
            display: flex; /* Use flexbox for the row */
        }
        .col-md-4 {
            flex: 1; /* Equal width for columns */
            display: flex; /* Enable flexbox for column items */
            margin-bottom: 20px; /* Add margin below each column */
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <h2 class="text-center mb-4">Forum Categories</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h3 class="card-title">Parenting Basics</h3>
                        <a href="parenting.php" class="btn explore-btn">Explore</a>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><a href="newborn-care.php">Newborn Care</a></li>
                        <li class="list-group-item"><a href="infantdevelopment.php">Infant Development</a></li>
                        <li class="list-group-item"><a href="toddlerdevelopment.php">Toddler Development</a></li>
                        <li class="list-group-item"><a href="childdevelopment.php">Child Development</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h3 class="card-title">Health and Safety</h3>
                        <a href="health-and-safety.php" class="btn explore-btn">Explore</a>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><a href="child-health.php">Child Health</a></li>
                        <li class="list-group-item"><a href="first-aid.php">First Aid</a></li>
                        <li class="list-group-item"><a href="safety-tips.php">Safety Tips</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h3 class="card-title">Community and Support</h3>
                        <a href="community-and-support.php" class="btn explore-btn">Explore</a>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><a href="parenting_stories.php">Parenting Stories</a></li>
                        <li class="list-group-item"><a href="support_groups.php">Support Groups</a></li>
                        <li class="list-group-item"><a href="direct_messages.php">Talk to a Health Care Prpfessional</a></li>
                        <!-- Link to Admin Dashboard in the Community Section -->
<div class="community-support">
    <h2>Community Support</h2>
    <p>As a healthcare professional, you can manage messages from your dashboard.</p>
    <a href="admin_dashboard.php" class="btn btn-info">Go to Admin Dashboard</a>
</div>

                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
<!-- Footer -->
<footer class="footer mt-auto py-3 bg-light footer">
    <div class="container">
        <div class="text-center">
            <p class="text-muted mb-0">&copy; 2024 Parents in Sync. All rights reserved.</p>
        </div>
    </div>
</footer>
</html>
