<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if required fields are set
    if (empty($_POST['firstName']) || empty($_POST['lastName']) || empty($_POST['email']) || empty($_POST['password'])) {
        echo "Please fill in all required fields.";
    } else {
        // ... rest of your code
    }
}

$conn->close();
if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("ssss", $firstName, $lastName, $email, $password);

    try {
        $stmt->execute();
        echo "User registered successfully!";
    } catch (mysqli_sql_exception $e) {
        echo "Error: " . $e->getMessage();
    }

    $stmt->close();
} else {
    echo "Error preparing statement: " . $conn->error;
}
} else {
echo "Please fill in all required fields.";
}
}