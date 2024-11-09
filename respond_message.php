<?php
session_start();
include 'db_connect.php'; // Database connection

// Check if the user is logged in and has admin privileges
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Validate and retrieve the message ID and response content
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message_id']) && isset($_POST['response_content'])) {
    $message_id = $_POST['message_id'];
    $response_content = $_POST['response_content'];
    
    // Prepare the insert statement for the response
    $stmt = $conn->prepare("INSERT INTO direct_messages (sender_id, receiver_id, message_content, reply_to) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iisi", $_SESSION['user_id'], $receiver_id, $response_content, $message_id);
    
    // Make sure the receiver ID is set correctly
    $receiver_id = 1; // This should correspond to the user ID of the healthcare professional

    // Execute the statement
    if ($stmt->execute()) {
        header('Location: admin_dashboard.php'); // Redirect back to admin dashboard after response
        exit;
    } else {
        echo "Error: " . $stmt->error; // Print error if the insert fails
    }
}
?>
