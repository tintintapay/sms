document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('coordinatorForm');
    const submitButton = document.getElementById('submitButton');

    const inputs = {
        fullName: document.getElementById('fullName'),
        age: document.getElementById('age'),
        school: document.getElementById('school'),
        sex: document.getElementById('sex'),
        username: document.getElementById('username'),
        contractDate: document.getElementById('contractDate'),
        password: document.getElementById('password'),
        confirmPassword: document.getElementById('confirmPassword'),
    };

    const errorMessages = {
        fullName: document.getElementById('fullNameError'),
        age: document.getElementById('ageError'),
        school: document.getElementById('schoolError'),
        sex: document.getElementById('sexError'),
        username: document.getElementById('usernameError'),
        contractDate: document.getElementById('contractDateError'),
        password: document.getElementById('passwordError'),
        confirmPassword: document.getElementById('confirmPasswordError'),
    };

    // Validation rules
    const validationRules = {
        fullName: value => value.trim() !== '',
        age: value => value > 0 && value < 120,
        school: value => value.trim() !== '',
        sex: value => ['Male', 'Female', 'Other'].includes(value),
        username: value => value.trim() !== '',
        contractDate: value => value !== '',
        password: value => value.length >= 8,
        confirmPassword: value => value === inputs.password.value,
    };

    // Validate input field
    function validateInput(field) {
        const isValid = validationRules[field](inputs[field].value);
        if (isValid) {
            inputs[field].classList.remove('invalid');
            inputs[field].classList.add('valid');
            errorMessages[field].style.display = 'none';
        } else {
            inputs[field].classList.remove('valid');
            inputs[field].classList.add('invalid');
            errorMessages[field].style.display = 'block';
            errorMessages[field].textContent = getErrorMessage(field);
        }
        checkFormValidity();
    }

    // Error messages
    function getErrorMessage(field) {
        switch (field) {
            case 'fullName': return 'Full Name is required.';
            case 'age': return 'Please enter a valid age (1-119).';
            case 'school': return 'School is required.';
            case 'sex': return 'Please enter Male, Female, or Other.';
            case 'username': return 'Username is required.';
            case 'contractDate': return 'Contract Start Date is required.';
            case 'password': return 'Password must be at least 8 characters long.';
            case 'confirmPassword': return 'Passwords do not match.';
            default: return 'This field is required.';
        }
    }

    // Check if the entire form is valid
    function checkFormValidity() {
        const isFormValid = Object.keys(inputs).every(field => validationRules[field](inputs[field].value));
        submitButton.disabled = !isFormValid;
    }

    // Attach event listeners to inputs
    Object.keys(inputs).forEach(field => {
        inputs[field].addEventListener('input', () => validateInput(field));
    });

    // Form submission validation
    form.addEventListener('submit', event => {
        if (!checkFormValidity()) {
            event.preventDefault();
            alert("Please fix the errors in the form before submitting.");
        }
    });
});