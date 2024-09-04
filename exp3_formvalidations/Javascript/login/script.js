document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');
    const emailInput = document.querySelector('input[name="email"]');
    const passwordInput = document.querySelector('input[name="password"]');

    function showError(input, message) {
        const formElement = input.parentElement;
        formElement.classList.add('error');
        const error = document.createElement('small');
        error.className = 'error-message';
        error.innerText = message;
        formElement.appendChild(error);
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
        // Set the minimum and maximum length constraints
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

        clearError(emailInput);
        clearError(passwordInput);

        if (emailInput.value.trim() === '') {
            showError(emailInput, 'Email is required');
            valid = false;
        } else if (!isValidEmail(emailInput.value.trim())) {
            showError(emailInput, 'Please enter a valid email address');
            valid = false;
        }

        const passwordValidation = isValidPassword(passwordInput.value.trim());
        if (passwordValidation !== true) {
            showError(passwordInput, passwordValidation);
            valid = false;
        }

        if (passwordInput.value.trim() === '') {
            showError(passwordInput, 'Password is required');
            valid = false;
        }

        if (!valid) {
            e.preventDefault();
        }
    });
});
