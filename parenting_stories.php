<?php
include 'db_connect.php'; // Database connection
session_start();

// Ensure the user is logged in and has a valid `user_id` in the session
if (!isset($_SESSION['user_id'])) {
    echo "<p style='color: red;'>Please log in to add a story.</p>";
    exit;
}

// Handle adding a new story
if (isset($_POST['new_story'])) {
    // Retrieve the `user_id` from the session
    $user_id = $_SESSION['user_id'];

    // Sanitize inputs
    $title = $conn->real_escape_string($_POST['title']);
    $content = $conn->real_escape_string($_POST['content']);
    
    // Insert new story with `user_id` into the database
    $insertSql = "INSERT INTO parenting_stories (user_id, title, content) VALUES ('$user_id', '$title', '$content')";
    if ($conn->query($insertSql) === true) {
        // Redirect to refresh and display the new story
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    } else {
        echo "<p style='color: red;'>Error adding story: " . $conn->error . "</p>";
    }
}

// Fetch stories from the database
$sql = "SELECT * FROM parenting_stories ORDER BY created_at DESC";
$stories_result = $conn->query($sql);

// Check if there are stories
if ($stories_result === false) {
    die('Database query error: ' . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Parenting Stories</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        body {
            background-image: url('mom and baby.jpg'); /* Set your background image here */
            background-size: cover; /* Cover the entire screen */
            background-position: center; /* Center the image */
            height: 100vh; /* Full height */
            color: white; /* Text color */
        }

        .container {
            background-color: rgba(0, 0, 0, 0.7); /* Transparent black overlay */
            padding: 20px; /* Add some padding */
            border-radius: 10px; /* Optional: round corners */
            margin-top: 20px; /* Optional: space from top */
        }

        .story-content {
            max-height: 100px; /* Set a maximum height */
            overflow: hidden; /* Hide overflow */
            text-overflow: ellipsis; /* Show ellipsis */
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 3; /* Number of lines to show */
        }
    </style>
</head>
<body>

<div class="container mt-4">
    <h1>Parenting Stories</h1>

    <!-- Add a New Story Form -->
    <form method="POST" action="" class="mb-4">
        <h2>Add a New Story</h2>
        <div class="form-group">
            <input type="text" name="title" class="form-control" placeholder="Story Title" required>
        </div>
        <div class="form-group">
            <textarea name="content" class="form-control" placeholder="Story Content" required></textarea>
        </div>
        <button type="submit" name="new_story" class="btn btn-primary">Add Story</button>
    </form>

    <div class="row">
        <!-- Display Existing Stories -->
        <?php if ($stories_result->num_rows > 0): ?>
            <?php while ($story = $stories_result->fetch_assoc()): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title"><?php echo htmlspecialchars($story['title']); ?></h3>
                            <p class="card-text story-content" id="content-<?php echo $story['story_id']; ?>">
                                <?php echo htmlspecialchars($story['content']); ?>
                            </p>
                            <button onclick="viewComments(<?php echo $story['story_id']; ?>)" class="btn btn-secondary">View Comments</button>

                            <!-- Read More Button -->
                            <button class="btn btn-link" onclick="toggleContent(<?php echo $story['story_id']; ?>)">Read More</button>

                            <!-- Comments Section -->
                            <div id="comments-<?php echo $story['story_id']; ?>" class="comments" style="display:none;"></div>

                            <!-- Add Comment Form -->
                            <form id="commentForm-<?php echo $story['story_id']; ?>" data-story-id="<?php echo $story['story_id']; ?>" style="display:none;" class="mt-2">
                                <div class="form-group">
                                    <textarea name="comment_content" required class="form-control" placeholder="Add your comment here..."></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Add Comment</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="col-12">
                <p>No stories found.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
// Function to toggle content visibility
function toggleContent(storyId) {
    const content = $('#content-' + storyId);
    const readMoreButton = content.next('button');

    if (content.hasClass('story-content')) {
        content.removeClass('story-content').css('max-height', 'none'); // Show full content
        readMoreButton.text('Read Less'); // Change button text
    } else {
        content.addClass('story-content').css('max-height', '100px'); // Truncate content
        readMoreButton.text('Read More'); // Change button text
    }
}

// Function to view comments for a story
function viewComments(storyId) {
    const commentsDiv = $('#comments-' + storyId);
    const commentForm = $('#commentForm-' + storyId);

    if (commentsDiv.is(':visible')) {
        commentsDiv.hide();
        commentForm.hide();
    } else {
        // Load comments with AJAX
        $.post('load_comments.php', { story_id: storyId }, function(comments) {
            commentsDiv.empty();
            if (comments.length > 0) {
                comments.forEach(function(comment) {
                    commentsDiv.append(`<p><strong>${comment.username}:</strong> ${comment.comment_content}</p>`);
                });
            } else {
                commentsDiv.append('<p>No comments yet.</p>');
            }
            commentsDiv.show();
            commentForm.show();
        }, 'json');
    }
}

// Handle form submission for adding a comment
$(document).on('submit', '[id^="commentForm-"]', function(e) {
    e.preventDefault();

    const storyId = $(this).data('story-id');
    const commentContent = $(this).find('textarea[name="comment_content"]').val();

    $.post('add_comment.php', { story_id: storyId, comment_content: commentContent }, function(response) {
        if (response.success) {
            alert(response.message); // Optional: confirmation alert
            viewComments(storyId); // Reload comments to include the new one
            $('#commentForm-' + storyId).find('textarea[name="comment_content"]').val(''); // Clear textarea
        } else {
            alert(response.message); // Show error message
        }
    }, 'json');
});
</script>

</body>
</html>
