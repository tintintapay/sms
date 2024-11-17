$(function () {
    // Restrict input to numbers only
    $('.num-only').on('input', function () {
        $(this).val($(this).val().replace(/[^0-9]/g, ''));
    });

    // Restrict input to text only
    $('.text-only').on('input', function () {
        $(this).val($(this).val().replace(/[^a-zA-Z\s]/g, ''));
    });

    // Restrict input to character limit
    $('.char-limit').on('input', function () {
        const maxLength = 20;
        if ($(this).val().length > maxLength) {
            $(this).val($(this).val().slice(0, maxLength));
        }
    });

    // Character limit
    $('[data-limit]').on('input', function () {
        const maxLength = $(this).data('limit');
        if ($(this).val().length > maxLength) {
            $(this).val($(this).val().slice(0, maxLength));
        }
    });

    // Restrict input to no special characters
    $('.no-special-chars').on('input', function () {
        $(this).val($(this).val().replace(/[^a-zA-Z0-9\s]/g, ''));
    });

    // Check file type
    $('.file-input').on('change', function () {
        const file = $(this)[0].files[0];
        const allowedTypes = ['application/pdf', 'image/png', 'image/jpeg'];

        if (file) {
            if (file.size === 0) {
                alert('File size is 0. Please select a valid file.');
                $(this).val('');
            } else if (!allowedTypes.includes(file.type)) {
                alert('Invalid file type. Only PDF, PNG, and JPG are allowed.');
                $(this).val('');
            }
        }
    });

    function isStrongPassword(password) {
        const hasUppercase = /[A-Z]/.test(password);
        const hasLowercase = /[a-z]/.test(password);
        const hasNumbers = /[0-9]/.test(password);
        const hasMinLength = password.length >= 8;

        return {
            isValid: hasUppercase && hasLowercase && hasNumbers && hasMinLength,
            errors: {
                uppercase: !hasUppercase,
                lowercase: !hasLowercase,
                numbers: !hasNumbers,
                minLength: !hasMinLength
            }
        };
    }

    $('.password-input').on('input', function () {
        const password = $(this).val();
        const errorMessageHolder = $('#passwordError');
        const validation = isStrongPassword(password);

        $(this).toggleClass('invalid', !validation.isValid);
        $(this).toggleClass('valid', validation.isValid);

        if (!validation.isValid) {
            let errorMessages = [];

            if (validation.errors.uppercase) {
                errorMessages.push('Include at least one uppercase letter.');
            }
            if (validation.errors.lowercase) {
                errorMessages.push('Include at least one lowercase letter.');
            }
            if (validation.errors.numbers) {
                errorMessages.push('Include at least one number.');
            }
            if (validation.errors.minLength) {
                errorMessages.push('Must be at least 8 characters long.');
            }

            errorMessageHolder.html('<ul><li>' + errorMessages.join('</li><li>') + '</li></ul>');
            errorMessageHolder.show(); // Show the error message
            console.log('invalid');
        } else {
            errorMessageHolder.hide(); // Hide the error message
            console.log('valid');
        }
    });

    // Logout
    $('.logout').on('click', function () {
        Swal.fire({
            title: "Logout",
            text: "Are you sure to Logout?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            confirmButtonText: "Yes! Logout",
            confirmButtonColor: "#ff2c2c",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '../logout';
            }
        });
    });
});