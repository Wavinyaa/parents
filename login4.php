<?php
session_start();
include 'db_connect.php'; // Database connection

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if email and password fields are set
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Fetch user by email
        $query = "SELECT id, email FROM users WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // Verify password
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id']; // Set session for logged-in user
                $_SESSION['email'] = $user['email']; // Store the email in session

                // Send success response with redirect URL
                echo json_encode(['success' => true, 'redirect' => 'forum.php', 'message' => 'Login successful!']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Incorrect password.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Email not found.']);
        }

        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Please fill in all required fields.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}

$conn->close();
?>
