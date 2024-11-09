<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register & Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css"> <!-- Your custom styles -->
</head>
<body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>  
    <div class="container mt-5" id="signIn">
    <h1 class="form-title">Sign In</h1>
    <form id="loginForm" method="post" action="login.php">
        <div class="form-group">
            <label for="loginEmail">Email</label>
            <input type="email" class="form-control" name="email" id="loginEmail" placeholder="Email" required>
        </div>
        <div class="form-group">
            <label for="loginPassword">Password</label>
            <input type="password" class="form-control" name="password" id="loginPassword" placeholder="Password" required>
        </div>
        <button type="submit" class="btn btn-primary">Sign In</button>
    </form>
    <div id="loginMessage" class="mt-3" style="color: green;"></div>
    <p class="text-center">Don't have an account yet? <button id="signUpButton" class="btn btn-link">Sign Up</button></p>
</div>

<div class="container mt-5" id="signup" style="display: none;">
    <h1 class="form-title">Register</h1>
    <form method="post" action="register.php" id="signupForm">
        <div class="form-group">
            <label for="fName">First Name</label>
            <input type="text" class="form-control" name="fName" id="fName" placeholder="First Name" required>
        </div>
        <div class="form-group">
            <label for="lName">Last Name</label>
            <input type="text" class="form-control" name="lName" id="lName" placeholder="Last Name" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
        </div>
        <button type="submit" class="btn btn-primary">Sign Up</button>
    </form>
    <div id="registrationMessage" class="mt-3" style="color: green;"></div>
    <p class="text-center">Already have an account? <button id="signInButton" class="btn btn-link">Sign In</button></p>
</div>
    <script>
        document.getElementById('signUpButton').addEventListener('click', function() {
            console.log("Sign Up button clicked!"); // Debug: log the button click
            document.getElementById('signIn').style.display = 'none'; // Hide Sign In form
            document.getElementById('signup').style.display = 'block'; // Show Sign Up form
        });

        document.getElementById('signInButton').addEventListener('click', function() {
            console.log("Sign In button clicked!"); // Debug: log the button click
            document.getElementById('signup').style.display = 'none'; // Hide Sign Up form
            document.getElementById('signIn').style.display = 'block'; // Show Sign In form
        });
    </script>
    <script src="script.js"></script>
</body>
</html> 
    