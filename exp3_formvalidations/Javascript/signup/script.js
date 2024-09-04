document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');
    const nameInput = document.querySelector('#name-input');
    const emailInput = document.querySelector('#email-input');
    const passwordInput = document.querySelector('#password-input');
    const confirmPasswordInput = document.querySelector('#confirmpassword-input');

    function showError(input, message) {
        const formElement = input.parentElement;
        formElement.classList.add('error');
        let error = formElement.querySelector('.error-message');
        if (!error) {
            error = document.createElement('small');
            error.className = 'error-message';
            formElement.appendChild(error);
        }
        error.innerText = message;
    }

    function clearError(input) {
        const formElement = input.parentElement;
        formElement.classList.remove('error');
        const errorMessage = formElement.querySelector('.error-message');
        if (errorMessage) {
            errorMessage.remove();
        }
    }

    function isValidEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(String(email).toLowerCase());
    }

    function isValidPassword(password) {
        const minLength = 8;
        const maxLength = 20;

        if (password.length < minLength) {
            return `Password must be at least ${minLength} characters long`;
        } else if (password.length > maxLength) {
            return `Password must be no more than ${maxLength} characters long`;
        }
        return true;
    }

    form.addEventListener('submit', function (e) {
        let valid = true;

        clearError(nameInput);
        clearError(emailInput);
        clearError(passwordInput);
        clearError(confirmPasswordInput);

        // Name validation
        if (nameInput.value.trim() === '') {
            showError(nameInput, 'Name is required');
            valid = false;
        }

        // Email validation
        if (emailInput.value.trim() === '') {
            showError(emailInput, 'Email is required');
            valid = false;
        } else if (!isValidEmail(emailInput.value.trim())) {
            showError(emailInput, 'Please enter a valid email address');
            valid = false;
        }

        // Password validation
        const passwordValidation = isValidPassword(passwordInput.value.trim());
        if (passwordValidation !== true) {
            showError(passwordInput, passwordValidation);
            valid = false;
        } else if (passwordInput.value.trim() === '') {
            showError(passwordInput, 'Password is required');
            valid = false;
        }

        // Confirm Password validation
        if (confirmPasswordInput.value.trim() === '') {
            showError(confirmPasswordInput, 'Please confirm your password');
            valid = false;
        } else if (confirmPasswordInput.value.trim() !== passwordInput.value.trim()) {
            showError(confirmPasswordInput, 'Passwords do not match');
            valid = false;
        }

        if (!valid) {
            e.preventDefault();
        }
    });
});
