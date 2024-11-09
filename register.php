<?php
session_start(); // Start the session
include 'db_connect.php'; // Include your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture form data
    $fName = $_POST['fName'];
    $lName = $_POST['lName'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password for security

    // Prepare an SQL statement with the correct column names
    $stmt = $conn->prepare("INSERT INTO users (firstName, lastName, email, password) VALUES (?, ?, ?, ?)");

    // Check if preparation was successful
    if (!$stmt) {
        die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("ssss", $fName, $lName, $email, $password);

    // Execute the statement
    if ($stmt->execute()) {
        // Send a success response with a message and the redirect URL
        echo json_encode([
            "success" => true,
            "message" => "Registration successful! Click the link below to go to the forum:",
            "redirect" => "forum.php" // Link to the forum
        ]);
    } else {
        // Handle error
        echo json_encode(["success" => false, "message" => "Error executing statement: " . $stmt->error]);
    }
    if ($stmt->execute()) {
        $_SESSION['user_id'] = $conn->insert_id; // Set session for logged-in user
        $_SESSION['first_name'] = $firstName; // Store first name in session
        echo json_encode(['success' => true, 'message' => 'Registration successful! Click the link below to go to the forum:', 'redirect' => 'forum.php']);
    }
    

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
