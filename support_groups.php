<?php
include 'db_connect.php'; // Database connection
session_start();

// Fetch support groups from the database
$sql = "SELECT * FROM support_groups";
$support_groups_result = $conn->query($sql);

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect to login if not logged in
    exit;
}

// Handle joining a group
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['join_group'])) {
    $group_id = $_POST['group_id'];
    $user_id = $_SESSION['user_id'];

    $join_sql = "INSERT INTO support_group_memberships (user_id, group_id) VALUES (?, ?)";
    $stmt = $conn->prepare($join_sql);
    $stmt->bind_param("ii", $user_id, $group_id);
    
    if ($stmt->execute()) {
        header("Location: group_details.php?group_id=" . $group_id);
        exit();
    } else {
        $message = "Error joining the group: " . $stmt->error;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Support Groups</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4">
    <h1>Support Groups</h1>

    <?php if (isset($message)): ?>
        <div class="alert alert-info"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>

    <h2>Available Groups</h2>
    <div class="row">
        <?php if ($support_groups_result->num_rows > 0): ?>
            <?php while ($group = $support_groups_result->fetch_assoc()): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($group['group_name']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($group['description']); ?></p>

                            <!-- Join Group Form -->
                            <form method="POST" action="">
                                <input type="hidden" name="group_id" value="<?php echo $group['group_id']; ?>">
                                <button type="submit" name="join_group" class="btn btn-primary">Join Group</button>
                            </form>

                        
                           
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="col-12">
                <p>No support groups available.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
