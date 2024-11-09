<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Healthcare Messages</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .admin-response {
            background-color: #d1ecf1; /* Light blue background */
            border-color: #bee5eb; /* Light blue border */
            color: #0c5460; /* Darker text color */
        }
    </style>
</head>
<body>

<div class="container mt-4">
    <h1>Healthcare Messaging</h1>

    <?php if (isset($message)): ?>
        <div class="alert alert-info"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>

    <h2>Messages</h2>
    <div class="messages">
        <?php if ($messages_result->num_rows > 0): ?>
            <?php while ($msg = $messages_result->fetch_assoc()): ?>
                <div class="alert alert-light">
                    <strong><?php echo htmlspecialchars($msg['sender_name']); ?>:</strong> 
                    <?php echo htmlspecialchars($msg['message_content']); ?>
                    <small class="text-muted"><?php echo $msg['sent_at']; ?></small>

                    <!-- Display Responses -->
                    <h4>Responses:</h4>
                    <?php
                    // Fetch responses to this message
                    $responses_sql = "SELECT dm.*, u.firstName AS responder_name FROM direct_messages dm 
                                      JOIN users u ON dm.sender_id = u.id 
                                      WHERE dm.reply_to = ?";
                    $response_stmt = $conn->prepare($responses_sql);
                    $response_stmt->bind_param("i", $msg['message_id']);
                    $response_stmt->execute();
                    $responses_result = $response_stmt->get_result();
                    ?>
                    <div class="responses">
                        <?php if ($responses_result->num_rows > 0): ?>
                            <?php while ($response = $responses_result->fetch_assoc()): ?>
                                <div class="alert <?php echo ($response['sender_id'] === $admin_id) ? 'admin-response' : 'alert-info'; ?>">
                                    <strong><?php echo htmlspecialchars($response['responder_name']); ?>:</strong> 
                                    <?php echo htmlspecialchars($response['message_content']); ?>
                                    <small class="text-muted"><?php echo $response['sent_at']; ?></small>
                                </div>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <p>No responses yet.</p>
                        <?php endif; ?>
                    </div>

                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No messages yet.</p>
        <?php endif; ?>
    </div>

    <h2>Send a Message</h2>
    <form method="POST" action="">
        <div class="form-group">
            <textarea name="message_content" class="form-control" placeholder="Type your message heree..." required></textarea>
        </div>
        <button type="submit" name="send_message" class="btn btn-secondary">Send Message</button>
    </form>
</div>

</body>
</html>
