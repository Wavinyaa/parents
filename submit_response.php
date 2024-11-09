<?php
include 'db_connect.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message_id']) && isset($_POST['response_content'])) {
    $message_id = $_POST['message_id'];
    $response_content = $_POST['response_content'];
    $healthcare_prof_id = $_SESSION['healthcare_prof_id'];

    $sql = "INSERT INTO responses (message_id, healthcare_prof_id, response_content, created_at) VALUES (?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iis", $message_id, $healthcare_prof_id, $response_content);

    if ($stmt->execute()) {
        header("Location: admin_dashboard.php");
        exit;
    } else {
        echo "Error submitting response: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}
?>
