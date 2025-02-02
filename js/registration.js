document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('registrationForm');
  const username = document.getElementById('username');
  const email = document.getElementById('email');
  const password = document.getElementById('password');
  const confirmPassword = document.getElementById('confirm_password');

  form.addEventListener('submit', (event) => {
    let valid = true;

    // Username validation
    if (username.value.trim() === '') {
      alert('Username is required');
      valid = false;
    }

    // Email validation
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email.value)) {
      alert('Please enter a valid email address');
      valid = false;
    }

    // Password validation
    if (password.value.length < 6) {
      alert('Password must be at least 6 characters long');
      valid = false;
    }

    // Confirm password validation
    if (password.value !== confirmPassword.value) {
      alert('Passwords do not match');
      valid = false;
    }

    if (!valid) {
      event.preventDefault();
    }
  });
});