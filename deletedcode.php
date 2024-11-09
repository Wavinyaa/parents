<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Newborn Care Tips</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('mom and baby.jpg'), rgba(255, 255, 255, 0.5);
            background-size: cover;
            background-repeat: no-repeat;
            line-height: 1.6;
            color: #555;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin: 20px 0;
            color: #5f9ea0;
        }

        .card {
            background-color: #ffffff;
            border: 1px solid #d1e7dd;
            border-radius: 5px;
            padding: 15px;
            margin: 20px auto;
            width: 90%;
            max-width: 800px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .card h2 {
            color: #5f9ea0;
            margin-bottom: 10px;
        }

        .card ul {
            list-style-type: disc;
            margin-left: 20px;
        }

        .card ul li {
            margin-bottom: 8px;
        }

        /* Comment Section Styles */
        .comment-section {
            background-color: #ffffff;
            border: 1px solid #d1e7dd;
            border-radius: 5px;
            padding: 15px;
            margin: 20px auto;
            width: 90%;
            max-width: 800px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .comment-section h2 {
            color: #5f9ea0;
            margin-bottom: 10px;
        }

        .comment-section ul {
            list-style-type: none;
            padding: 0;
        }

        .comment-section li {
            margin-bottom: 10px;
            padding: 10px;
            background-color: #f0f8ff;
            border: 1px solid #d1e7dd;
            border-radius: 5px;
        }

        .comment-section strong {
            color: #5f9ea0;
        }

        form {
            margin-top: 20px;
        }

        textarea {
            width: 100%;
            height: 80px;
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #d1e7dd;
            border-radius: 5px;
        }

        button {
            background-color: #5f9ea0;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #4b8c7a; /* Darker shade on hover */
        }
    </style>
</head>
<body>
    <h1>Newborn Care Tips</h1>

    <section class="card">
        <h2>Feeding</h2>
        <ul>
            <li><strong>Breastfeeding:</strong> Recommended for the first 6 months; provides essential nutrients and antibodies.</li>
            <li><strong>Formula Feeding:</strong> Choose iron-fortified formulas if breastfeeding isn’t possible.</li>
            <li><strong>Burping:</strong> Hold your baby upright for 10-15 minutes after feeding to help them burp.</li>
        </ul>
    </section>

    <section class="card">
        <h2>Sleeping</h2>
        <ul>
            <li><strong>Sleep Patterns:</strong> Newborns sleep 16-17 hours a day but wake every 2-3 hours to eat.</li>
            <li><strong>Safe Sleep Practices:</strong> Always place your baby on their back to sleep and keep the crib free of toys and blankets.</li>
            <li><strong>Establishing Routines:</strong> Create a calming bedtime routine to help your baby sleep better.</li>
        </ul>
    </section>

    <section class="card">
        <h2>Diapering</h2>
        <ul>
            <li><strong>Choosing Diapers:</strong> Cloth diapers are eco-friendly, while disposables are convenient.</li>
            <li><strong>Diaper Changing Tips:</strong> Always have everything ready before you start changing.</li>
            <li><strong>Preventing Diaper Rash:</strong> Change diapers frequently and use barrier creams to protect the skin.</li>
        </ul>
    </section>

    <section class="card">
        <h2>Bathing</h2>
        <ul>
            <li><strong>Bathing Techniques:</strong> Until the umbilical cord falls off, give sponge baths only.</li>
            <li><strong>Bathing Frequency:</strong> Bathing 2-3 times a week is sufficient for newborns.</li>
            <li><strong>Skin Care:</strong> Use mild, fragrance-free soap to protect delicate skin.</li>
        </ul>
    </section>

    <section class="card">
        <h2>Soothing Techniques</h2>
        <ul>
            <li><strong>Swaddling:</strong> Wrap your baby snugly in a soft blanket to help them feel secure.</li>
            <li><strong>Calming Methods:</strong> Try rocking your baby gently or playing white noise to soothe them.</li>
            <li><strong>Recognizing Needs:</strong> Learn to differentiate between cries for hunger, discomfort, or tiredness.</li>
        </ul>
    </section>

    <section class="card">
        <h2>Tummy Time</h2>
        <ul>
            <li><strong>Importance:</strong> Helps strengthen neck and shoulder muscles; essential for development.</li>
            <li><strong>How to Introduce:</strong> Start with short sessions and gradually increase the duration as your baby gets stronger.</li>
        </ul>
    </section>

    <section class="card">
        <h2>Skin Care</h2>
        <ul>
            <li><strong>Moisturizing:</strong> Apply baby lotion after baths to keep skin hydrated.</li>
            <li><strong>Rashes and Irritations:</strong> Consult a pediatrician if your baby develops rashes or skin irritations.</li>
        </ul>
    </section>

    <section class="card">
        <h2>Health and Immunizations</h2>
        <ul>
            <li><strong>Regular Check-ups:</strong> Schedule pediatric visits to monitor your baby's growth and development.</li>
            <li><strong>Vaccination Schedule:</strong> Follow the recommended vaccination schedule to protect your newborn from diseases.</li>
        </ul>
    </section>

    <?php
// Include database connection
include 'db_connect.php';

// Define the subtopic_id (make sure this is set correctly)
$subtopic_id = 1; // Replace with the appropriate value or logic

// Fetch all comments for the specific subtopic (Newborn Care)
$comments_sql = "SELECT * FROM comments WHERE subtopic_id = ? ORDER BY created_at DESC";
$stmt = $conn->prepare($comments_sql);
$stmt->bind_param("i", $subtopic_id); // Assuming $subtopic_id is defined
$stmt->execute();
$comments_result = $stmt->get_result();
?>

<section style="background-color: #ffffff; border: 1px solid #d1e7dd; border-radius: 5px; padding: 15px; margin: 20px 0; width: 90%; max-width: 800px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); margin-left: auto; margin-right: auto;">
    <h2 style="color: #5f9ea0; margin-bottom: 10px;">Comments on Newborn Care Tips</h2>

    <ul style="list-style-type: none; padding: 0;">
        <?php if ($comments_result && $comments_result->num_rows > 0): ?>
            <?php while ($comment = $comments_result->fetch_assoc()): ?>
                <li style="margin-bottom: 10px; padding: 10px; background-color: #f0f8ff; border: 1px solid #d1e7dd; border-radius: 5px;">
                    <strong style="color: #5f9ea0;"><?php echo htmlspecialchars($comment['username']); ?>:</strong>
                    <p style="margin: 5px 0;"><?php echo htmlspecialchars($comment['comment_content']); ?></p>
                </li>
            <?php endwhile; ?>
        <?php else: ?>
            <li style="margin-bottom: 10px;">No comments yet. Be the first to comment!</li>
        <?php endif; ?>
    </ul>

    <!-- Add a Comment Form -->
    <form action="add_comment.php" method="POST" style="margin-top: 20px;">
        <input type="hidden" name="subtopic_id" value="<?php echo $subtopic_id; ?>"> <!-- Ensure this is set properly -->
        <textarea name="comment_content" required placeholder="Add your comment here..." style="width: 100%; height: 80px; margin-bottom: 10px; padding: 10px; border: 1px solid #d1e7dd; border-radius: 5px;"></textarea>
        <button type="submit" style="background-color: #5f9ea0; color: white; padding: 10px 15px; border: none; border-radius: 5px; cursor: pointer;">Add Comment</button>
    </form>
</section>
<ul style="list-style-type: none; padding: 0;">
    <?php
    // Fetch all comments for the entire subtopic (Newborn Care)
    $comments_sql = "SELECT * FROM comments WHERE subtopic_id = $subtopic_id ORDER BY created_at DESC";
    $comments_result = $conn->query($comments_sql);

    if ($comments_result && $comments_result->num_rows > 0):
        while ($comment = $comments_result->fetch_assoc()):
    ?>
        <li style="margin-bottom: 10px; padding: 10px; background-color: #f0f8ff; border: 1px solid #d1e7dd; border-radius: 5px;">
            <strong style="color: #5f9ea0;"><?php echo htmlspecialchars($comment['username']); ?>:</strong>
            <p style="margin: 5px 0;"><?php echo htmlspecialchars($comment['comment_content']); ?></p>
            <!-- Delete Button -->
            <form action="delete_comment.php" method="POST" style="display:inline;">
                <input type="hidden" name="comment_id" value="<?php echo $comment['id']; ?>">
                <button type="submit" style="background-color: #e74c3c; color: white; border: none; border-radius: 5px; cursor: pointer;">Delete</button>
            </form>
        </li>
    <?php
        endwhile;
    else:
    ?>
        <li style="margin-bottom: 10px;">No comments yet. Be the first to comment!</li>
    <?php endif; ?>
</ul>


<?php
$stmt->close(); // Close the prepared statement
$conn->close(); // Close the database connection
?>
const signUpButton = document.getElementById('signUpButton');
const signInButton = document.getElementById('signInButton');
const signInForm = document.getElementById('signIn');
const signUpForm = document.getElementById('signup');

document.getElementById('loginForm').addEventListener('submit', function(e) {
    e.preventDefault(); // Prevent default form submission

    // Capture form values
    const email = document.getElementById('email').value; // Corrected ID for email input
    const password = document.getElementById('password').value; // Corrected ID for password input

    // Debug: Log values to ensure they are being captured
    console.log("Email:", email);
    console.log("Password:", password);

    if (email === "" || password === "") {
        document.getElementById('loginMessage').innerText = "Please fill in all required fields.";
        return;
    }

    // AJAX request to the PHP login script
    fetch('login.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `email=${encodeURIComponent(email)}&password=${encodeURIComponent(password)}`
    })
    .then(response => response.json())
    .then(data => {
        console.log("Response from server:", data); // Debug: Log server response
        if (data.success) {
            // Create a clickable link for the redirect
            const link = `<a href="${data.redirect}" style="text-decoration: underline; color: blue;">Go to Forum</a>`;
            
            // Display the message and link in the loginMessage div
            document.getElementById('loginMessage').innerHTML = `${data.message}<br>${link}`;
        } else {
            document.getElementById('loginMessage').innerText = data.message; // Display error message
        }
    })
    .catch(error => console.error('Error:', error));
});
