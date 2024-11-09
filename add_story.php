<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'You must be logged in to post a story.']);
    exit;
}

$user_id = $_SESSION['user_id'];
$title = $_POST['title'];
$content = $_POST['content'];

$sql = "INSERT INTO parenting_stories (user_id, title, content) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iss", $user_id, $title, $content);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Story added successfully!']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error adding story. Please try again.']);
}
?>
