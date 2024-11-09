document.getElementById('loginForm').addEventListener('submit', function(e) {
    e.preventDefault(); // Prevent form from submitting the usual way

    // Get email and password values
    const email = document.getElementById('loginEmail').value;
    const password = document.getElementById('loginPassword').value;

    // Check if fields are filled
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
        if (data.success) {
            window.location.href = 'forum.php'; // Redirect on success
        } else {
            document.getElementById('loginMessage').innerText = data.message;
        }
    })
    .catch(error => console.error('Error:', error));
});

