<?php
session_start();
include 'db_connect.php'; // Ensure to include your database connection

$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_username = $_POST['new_username'];
    $new_password = $_POST['new_password'];

    // Insert the new user into the database
    $sql = "INSERT INTO users (username, password) VALUES ('$new_username', '$new_password')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['username'] = $new_username; // Log the user in
        $response['success'] = true; // Indicate success
    } else {
        $response['success'] = false; // Indicate failure
        $response['message'] = "Error: " . $conn->error; // Return error message
    }
}

echo json_encode($response); // Return JSON response
$conn->close();
?>
