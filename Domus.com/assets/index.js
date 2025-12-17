// ===========================
// Sign In Page JavaScript
// ===========================

document.addEventListener('DOMContentLoaded', function() {
    const signinForm = document.getElementById('signinForm');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');

    // Form validation and submission
    if (signinForm) {
        signinForm.addEventListener('submit', function(e) {
            e.preventDefault();

            // Clear previous errors
            clearErrors();

            // Validate form
            if (validateForm()) {
                // Disable submit button to prevent double submission
                const submitBtn = signinForm.querySelector('.btn-signin');
                submitBtn.disabled = true;
                submitBtn.textContent = 'Signing In...';

                // Submit the form
                signinForm.submit();
            }
        });
    }

    // Real-time validation
    if (emailInput) {
        emailInput.addEventListener('blur', function() {
            validateEmail(this);
        });

        emailInput.addEventListener('input', function() {
            if (this.parentElement.classList.contains('error')) {
                validateEmail(this);
            }
        });
    }

    if (passwordInput) {
        passwordInput.addEventListener('blur', function() {
            validatePassword(this);
        });

        passwordInput.addEventListener('input', function() {
            if (this.parentElement.classList.contains('error')) {
                validatePassword(this);
            }
        });
    }
});

/**
 * Validate entire form
 */
function validateForm() {
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');

    let isValid = true;

    // Validate email
    if (!validateEmail(emailInput)) {
        isValid = false;
    }

    // Validate password
    if (!validatePassword(passwordInput)) {
        isValid = false;
    }

    return isValid;
}

/**
 * Validate email field
 */
function validateEmail(emailField) {
    const email = emailField.value.trim();
    const formGroup = emailField.parentElement;

    // Email regex pattern
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!email) {
        showError(formGroup, 'Email address is required');
        return false;
    }

    if (!emailRegex.test(email)) {
        showError(formGroup, 'Please enter a valid email address');
        return false;
    }

    clearFieldError(formGroup);
    return true;
}

/**
 * Validate password field
 */
function validatePassword(passwordField) {
    const password = passwordField.value;
    const formGroup = passwordField.parentElement;

    if (!password) {
        showError(formGroup, 'Password is required');
        return false;
    }

    if (password.length < 6) {
        showError(formGroup, 'Password must be at least 6 characters');
        return false;
    }

    clearFieldError(formGroup);
    return true;
}

/**
 * Show error message
 */
function showError(formGroup, message) {
    formGroup.classList.add('error');

    // Remove existing error message if any
    const existingError = formGroup.querySelector('.error-message');
    if (existingError) {
        existingError.remove();
    }

    // Create and append error message
    const errorMsg = document.createElement('span');
    errorMsg.className = 'error-message';
    errorMsg.textContent = message;
    formGroup.appendChild(errorMsg);
}

/**
 * Clear error from field
 */
function clearFieldError(formGroup) {
    formGroup.classList.remove('error');
    const errorMsg = formGroup.querySelector('.error-message');
    if (errorMsg) {
        errorMsg.remove();
    }
}

/**
 * Clear all errors
 */
function clearErrors() {
    const formGroups = document.querySelectorAll('.form-group');
    formGroups.forEach(function(group) {
        group.classList.remove('error');
        const errorMsg = group.querySelector('.error-message');
        if (errorMsg) {
            errorMsg.remove();
        }
    });
}

/**
 * Handle Enter key to submit form
 */
document.addEventListener('keypress', function(e) {
    const signinForm = document.getElementById('signinForm');
    if (e.key === 'Enter' && signinForm) {
        const activeElement = document.activeElement;
        // Allow Enter key in form inputs to submit the form
        if (activeElement.tagName === 'INPUT' && activeElement.form === signinForm) {
            e.preventDefault();
            signinForm.dispatchEvent(new Event('submit'));
        }
    }
});
