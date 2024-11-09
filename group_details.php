<?php
include 'db_connect.php'; // Database connection
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect to login if not logged in
    exit;
}

// Get the group ID from the URL
if (!isset($_GET['group_id'])) {
    // Redirect if no group ID is specified
    header('Location: support_groups.php');
    exit;
}
$group_id = $_GET['group_id'];

// Fetch group details
$group_sql = "SELECT * FROM support_groups WHERE group_id = ?";
$stmt = $conn->prepare($group_sql);
$stmt->bind_param("i", $group_id);
$stmt->execute();
$group_result = $stmt->get_result();
$group = $group_result->fetch_assoc();
$stmt->close();

// Handle posting a message in a group
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post_message'])) {
    $user_id = $_SESSION['user_id'];
    $message_content = $_POST['message_content'];

    $message_sql = "INSERT INTO support_group_messages (user_id, group_id, message_content) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($message_sql);
    $stmt->bind_param("iis", $user_id, $group_id, $message_content);

    if ($stmt->execute()) {
        $message = "Message posted successfully!";
    } else {
        $message = "Error posting message: " . $stmt->error;
    }
    $stmt->close();
}

// Fetch messages for the group
$message_sql = "SELECT * FROM support_group_messages WHERE group_id = ?";
$stmt = $conn->prepare($message_sql);
$stmt->bind_param("i", $group_id);
$stmt->execute();
$messages_result = $stmt->get_result();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($group['group_name']); ?> - Chat</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('mom and baby.jpg'); /* Replace with your image path */
            background-size: cover;
            background-position: center;
            color: #fff; /* Text color */
            font-family: Arial, sans-serif;
        }
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
    
        }
        .container {
            position: relative;
            z-index: 1; /* Ensure content is above the overlay */
            margin-top: 50px; /* Space from the top */
        }
        .message-box {
            background-color: rgba(255, 255, 255, 0.9); /* Light background for messages */
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
        }
        h1, h2 {
            text-shadow: 1px 1px 2px black; /* Shadow for better readability */
        }
    </style>
</head>
<body>

<div class="overlay"></div> <!-- Black transparent overlay -->
<div class="container mt-4">
    <h1><?php echo htmlspecialchars($group['group_name']); ?> - Chat</h1>

    <?php if (isset($message)): ?>
        <div class="alert alert-info"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>

    <h2>Messages</h2>
    <div class="messages">
        <?php if ($messages_result->num_rows > 0): ?>
            <?php while ($message = $messages_result->fetch_assoc()): ?>
                <div class="message-box">
                    <strong>User <?php echo htmlspecialchars($message['user_id']); ?>:</strong> <?php echo htmlspecialchars($message['message_content']); ?>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No messages yet.</p>
        <?php endif; ?>
    </div>

    <!-- Post Message Form Below the Messages -->
    <h2>Post a Message</h2>
    <form method="POST" action="">
        <div class="form-group">
            <textarea name="message_content" class="form-control" placeholder="Type your message here..." required></textarea>
        </div>
        <button type="submit" name="post_message" class="btn btn-secondary">Post Message</button>
    </form>
</div>

</body>
</html>
