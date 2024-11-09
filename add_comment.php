<?php
session_start(); // Ensure session is started to access user_id
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['story_id'], $_POST['comment_content'])) {
    $story_id = intval($_POST['story_id']);
    $comment_content = $_POST['comment_content'];
    $user_id = $_SESSION['user_id'] ?? null; // Assuming user_id is stored in session

    if ($user_id) {
        $stmt = $conn->prepare("INSERT INTO parenting_story_comments (user_id, story_id, comment_content, created_at) VALUES (?, ?, ?, NOW())");
        $stmt->bind_param("iis", $user_id, $story_id, $comment_content);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Comment added successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error adding comment: ' . $stmt->error]);
        }
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'User not logged in.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
}
?>
