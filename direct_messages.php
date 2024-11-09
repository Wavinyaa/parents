<?php
include 'db_connect.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$healthcare_professional_id = 1; // Replace with the healthcare professional's user ID.

// Handle sending a message
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send_message'])) {
    $message_content = $_POST['message_content'];

    $sql = "INSERT INTO direct_messages (sender_id, receiver_id, message_content) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iis", $user_id, $healthcare_professional_id, $message_content);

    if ($stmt->execute()) {
        $status_message = "Message sent!";
    } else {
        $status_message = "Failed to send message: " . $stmt->error;
    }
    $stmt->close();
}

// Fetch chat history including any responses
$sql = "SELECT dm.*, u.firstName AS sender_name, r.message_content AS response_content 
        FROM direct_messages dm
        LEFT JOIN users u ON dm.sender_id = u.id
        LEFT JOIN direct_messages r ON dm.message_id = r.reply_to
        WHERE (dm.sender_id = ? AND dm.receiver_id = ?) 
        OR (dm.sender_id = ? AND dm.receiver_id = ?) 
        ORDER BY dm.sent_at ASC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iiii", $user_id, $healthcare_professional_id, $healthcare_professional_id, $user_id);
$stmt->execute();
$messages_result = $stmt->get_result();
$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Healthcare Professional Chat</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background: url('background.jpg');
            background-size: cover;
        }
        .chat-container {
            background-color: rgba(0, 0, 0, 0.8); 
            padding: 20px; 
            border-radius: 8px; 
            color: white;
        }
        .messages {
            max-height: 400px; 
            overflow-y: auto; 
            margin-bottom: 20px;
        }
        .message-user {
            background-color: #d1ecf1; /* Light blue background for user messages */
            border-color: #bee5eb;
        }
        .message-professional {
            background-color: #f8d7da; /* Light red for healthcare professional messages */
            border-color: #f5c6cb;
        }
        .response-message {
            background-color: #f1f1f1; /* Grey background for responses */
            border-left: 3px solid #007bff;
            margin-left: 20px;
            padding: 10px;
        }
    </style>
</head>
<body>

<div class="container mt-4 chat-container">
    <h1>Chat with Healthcare Professional</h1>
    
    <?php if (isset($status_message)): ?>
        <div class="alert alert-info"><?php echo htmlspecialchars($status_message); ?></div>
    <?php endif; ?>

    <div class="messages">
        <?php if ($messages_result->num_rows > 0): ?>
            <?php while ($message = $messages_result->fetch_assoc()): ?>
                <!-- Display the original message -->
                <div class="alert <?php echo $message['sender_id'] === $user_id ? 'message-user' : 'message-professional'; ?>">
                    <strong><?php echo $message['sender_id'] === $user_id ? 'You' : 'Healthcare Professional'; ?>:</strong>
                    <?php echo htmlspecialchars($message['message_content']); ?>
                    <small class="d-block text-muted"><?php echo date("Y-m-d H:i:s", strtotime($message['sent_at'])); ?></small>
                </div>

                <!-- Display the response, if exists -->
                <?php if (!empty($message['response_content'])): ?>
                    <div class="response-message">
                        <strong>Response:</strong>
                        <?php echo htmlspecialchars($message['response_content']); ?>
                        <small class="d-block text-muted"><?php echo date("Y-m-d H:i:s", strtotime($message['sent_at'])); ?></small>
                    </div>
                <?php endif; ?>

            <?php endwhile; ?>
        <?php else: ?>
            <p>No messages yet.</p>
        <?php endif; ?>
    </div>

    <!-- Message Form -->
    <form method="POST" action="">
        <div class="form-group">
            <textarea name="message_content" class="form-control" placeholder="Type your message heree..." required></textarea>
        </div>
        <button type="submit" name="send_message" class="btn btn-primary">Send</button>
    </form>
</div>

</body>
</html>
