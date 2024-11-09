<?php
include 'db_connect.php'; // Database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comment_id'])) {
    $comment_id = intval($_POST['comment_id']);

    $stmt = $conn->prepare("DELETE FROM parenting_story_comments WHERE comment_id = ?");
    $stmt->bind_param("i", $comment_id);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Comment deleted successfully!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error deleting comment: ' . $stmt->error]);
    }

    $stmt->close();
}
?>
