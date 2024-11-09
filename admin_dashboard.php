<?php
session_start();
include 'db_connect.php'; // Database connection

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Fetch direct messages and their responses
$message_sql = "
    SELECT dm.*, u.firstName AS sender_name
    FROM direct_messages dm
    JOIN users u ON dm.sender_id = u.id
    WHERE dm.receiver_id = ? AND dm.reply_to IS NULL
";
$stmt = $conn->prepare($message_sql);
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$messages_result = $stmt->get_result();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4">
    <h1>Admin Dashboard</h1>

    <h2>Direct Messages</h2>
    <div class="messages">
        <?php if ($messages_result->num_rows > 0): ?>
            <?php while ($message = $messages_result->fetch_assoc()): ?>
                <div class="alert alert-light">
                    <strong><?php echo htmlspecialchars($message['sender_name']); ?>:</strong>
                    <?php echo htmlspecialchars($message['message_content']); ?>
                    <small class="text-muted"><?php echo $message['sent_at']; ?></small>

                    <!-- Display responses to the message -->
                    <?php
                    // Fetch responses for the current message
                    $response_sql = "
                        SELECT dm.*, u.firstName AS responder_name
                        FROM direct_messages dm
                        JOIN users u ON dm.sender_id = u.id
                        WHERE dm.reply_to = ?
                    ";
                    $response_stmt = $conn->prepare($response_sql);
                    $response_stmt->bind_param("i", $message['message_id']);
                    $response_stmt->execute();
                    $responses_result = $response_stmt->get_result();
                    ?>

                    <?php if ($responses_result->num_rows > 0): ?>
                        <div class="responses mt-2">
                            <?php while ($response = $responses_result->fetch_assoc()): ?>
                                <div class="alert alert-secondary">
                                    <strong><?php echo htmlspecialchars($response['responder_name']); ?>:</strong>
                                    <?php echo htmlspecialchars($response['message_content']); ?>
                                    <small class="text-muted"><?php echo $response['sent_at']; ?></small>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    <?php endif; ?>

                    <!-- Form to respond to the message -->
                    <form method="POST" action="respond_message.php">
                        <input type="hidden" name="message_id" value="<?php echo $message['message_id']; ?>">
                        <div class="form-group">
                            <textarea name="response_content" class="form-control" placeholder="Type your response here..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-secondary">Respond</button>
                    </form>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No messages yet.</p>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
