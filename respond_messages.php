<?php
session_start();
include 'db_connect.php'; // Database connection

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if the user is logged in and is an admin
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit;
    }

    // Get the response details
    $message_id = $_POST['message_id'];
    $response_content = $_POST['response_content'];
    $admin_id = $_SESSION['user_id'];

    // Insert the response into the database (You need a table to store responses)
    $response_sql = "INSERT INTO admin_responses (message_id, admin_id, response_content) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($response_sql);
    $stmt->bind_param("iis", $message_id, $admin_id, $response_content);

    if ($stmt->execute()) {
        // Redirect back to admin dashboard or show a success message
        header('Location: admin_dashboard.php?response=success');
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Invalid request method.";
}

$conn->close();
?>
//
include 'db_connect.php'; // Database connection
session_start();

// Check if the user is logged in as a healthcare professional
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect to login if not logged in
    exit;
}

// Fetch all direct messages
$sql = "SELECT dm.*, u.firstName AS sender_name, r.firstName AS receiver_name 
        FROM direct_messages dm 
        JOIN users u ON dm.sender_id = u.id 
        JOIN users r ON dm.receiver_id = r.id 
        ORDER BY dm.sent_at DESC";
$result = $conn->query($sql);
?>
//
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Direct Messages</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h1>Direct Messages</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Message ID</th>
                <th>Sender</th>
                <th>Receiver</th>
                <th>Message</th>
                <th>Sent At</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['message_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['sender_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['receiver_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['message_content']); ?></td>
                        <td><?php echo htmlspecialchars($row['sent_at']); ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No messages found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
//
