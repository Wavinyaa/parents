<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if required fields are set
    if (empty($_POST['fName']) || empty($_POST['lName']) || empty($_POST['email']) || empty($_POST['password'])) {
        echo "Please fill in all required fields.";
    } else {
        // Use HTML field names from the form
        $firstName = $_POST['fName'];
        $lastName = $_POST['lName'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (firstName, lastName, email, password) VALUES (?, ?, ?, ?)";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ssss", $firstName, $lastName, $email, $password);

            if ($stmt->execute()) {
                echo "User registered successfully!";
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Error preparing statement: " . $conn->error;
        }
    }
}

$conn->close();
