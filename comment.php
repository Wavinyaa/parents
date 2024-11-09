<?php
session_start();
include 'db_connect.php'; // Database connection

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'You must be logged in to comment.']);
    exit;
}

// Handle comment submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $comment = $_POST['comment'];
    $email = $_SESSION['email']; // Get the email from the session

    // Validate the comment input
    if (empty($comment)) {
        echo json_encode(['success' => false, 'message' => 'Comment cannot be empty.']);
        exit;
    }

    // Insert comment into the database
    $query = "INSERT INTO comments (user_id, email, comment) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param("iss", $_SESSION['user_id'], $email, $comment);
        $stmt->execute();
        echo json_encode(['success' => true, 'message' => 'Comment added successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to add comment.']);
    }
    $stmt->close();
}

// Fetch comments to display
$query = "SELECT * FROM comments ORDER BY created_at DESC";
$result = $conn->query($query);
$comments = [];
while ($row = $result->fetch_assoc()) {
    $comments[] = $row;
}

$conn->close();

// Display comments
foreach ($comments as $comment) {
    echo "<div class='comment'>";
    echo "<p><strong>" . htmlspecialchars($comment['email']) . ":</strong> " . htmlspecialchars($comment['comment']) . "</p>";
    echo "</div>";
}
?>
