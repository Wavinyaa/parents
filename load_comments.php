<?php
include 'db_connect.php'; // Make sure to include your database connection

if (isset($_POST['story_id'])) {
    $story_id = intval($_POST['story_id']); // Sanitize input
    $stmt = $conn->prepare("SELECT c.comment_content, u.firstName FROM parenting_story_comments c JOIN users u ON c.user_id = u.id WHERE c.story_id = ?");
    $stmt->bind_param("i", $story_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $comments = [];
    while ($row = $result->fetch_assoc()) {
        $comments[] = [
            'comment_content' => $row['comment_content'],
            'username' => $row['firstName'], // Assuming you want to show the user's first name
        ];
    }

    echo json_encode($comments);
} else {
    echo json_encode([]);
}
?>
