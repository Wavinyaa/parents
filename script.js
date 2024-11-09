const signUpButton = document.getElementById('signUpButton');
const signInButton = document.getElementById('signInButton');
const signInForm = document.getElementById('signIn');
const signUpForm = document.getElementById('signup');

document.getElementById('loginForm').addEventListener('submit', function(e) {
    e.preventDefault(); // Prevent default form submission

    // Capture form values
    const email = document.getElementById('loginEmail').value; // Get email input value
    const password = document.getElementById('loginPassword').value; // Get password input value

    // Debug: Log values to ensure they are being captured
    console.log("Email:", email);
    console.log("Password:", password);

    // Check if email and password are provided
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
            
            // Display the success message and link in the loginMessage div
            document.getElementById('loginMessage').innerHTML = `${data.message}<br>${link}`;
        } else {
            // Display error message
            document.getElementById('loginMessage').innerText = data.message;
        }
    })
    .catch(error => console.error('Error:', error));
});
document.getElementById('signupForm').addEventListener('submit', function(e) {
    e.preventDefault(); // Prevent default form submission

    // Capture form values
    const fName = document.getElementById('fName').value;
    const lName = document.getElementById('lName').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    // AJAX request to the PHP register script
    fetch('register.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `fName=${encodeURIComponent(fName)}&lName=${encodeURIComponent(lName)}&email=${encodeURIComponent(email)}&password=${encodeURIComponent(password)}`
    })
    .then(response => response.json())
    .then(data => {
        console.log("Response from server:", data); // Debug: Log server response
        const registrationMessage = document.getElementById('registrationMessage');
        if (data.success) {
            // Create a clickable link for the redirect
            const link = `<a href="${data.redirect}" style="text-decoration: underline; color: blue;">Go to Forum</a>`;
            registrationMessage.innerHTML = `${data.message}<br>${link}`; // Display success message and link
        } else {
            registrationMessage.innerText = data.message; // Display error message
        }
    })
    .catch(error => console.error('Error:', error));
});

