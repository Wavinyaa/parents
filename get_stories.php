<?php
include 'db_connect.php';

$sql = "SELECT ps.story_id, ps.title, ps.content, ps.created_at, u.first_name AS author 
        FROM parenting_stories ps 
        JOIN users u ON ps.user_id = u.user_id 
        ORDER BY ps.created_at DESC";
$result = $conn->query($sql);

$stories = [];
while ($row = $result->fetch_assoc()) {
    $stories[] = $row;
}

echo json_encode($stories);
?>
