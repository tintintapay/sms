document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('login-form');
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');

    form.addEventListener('submit', (event) => {
        event.preventDefault(); // Prevent the default form submission behavior

        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;

        fetch('coor_admin login.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams({
                'email': email,
                'password': password
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                alert(data.message); // Show the welcome message
                window.location.href = data.redirect; // Redirect based on user role
            } else {
                alert(data.message); // Show error message
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An unexpected error occurred. Please try again later.');
        });
    });

    togglePassword.addEventListener('click', () => {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            togglePassword.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            togglePassword.classList.replace('fa-eye-slash', 'fa-eye');
        }
    });
});
