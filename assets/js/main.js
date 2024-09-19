class InputRestrictor {
    constructor() {
        this.attachListeners();
    }

    attachListeners() {
        document.querySelectorAll('.num-only').forEach(input => {
            input.addEventListener('input', this.restrictNumber);
        });

        document.querySelectorAll('.text-only').forEach(input => {
            input.addEventListener('input', this.restrictText);
        });

        document.querySelectorAll('.char-limit').forEach(input => {
            input.addEventListener('input', this.restrictCharLimit);
        });

        document.querySelectorAll('.file-input').forEach(input => {
            input.addEventListener('change', this.checkFile);
        });

        document.querySelectorAll('.no-special-chars').forEach(input => {
            input.addEventListener('input', this.restrictNoSpecialChars);
        });
    }

    restrictNoSpecialChars(event) {
        event.target.value = event.target.value.replace(/[^a-zA-Z0-9\s]/g, '');
    }

    restrictNumber(event) {
        event.target.value = event.target.value.replace(/[^0-9]/g, '');
    }

    restrictText(event) {
        event.target.value = event.target.value.replace(/[^a-zA-Z\s]/g, '');
    }

    restrictCharLimit(event) {
        const maxLength = 20;
        if (event.target.value.length > maxLength) {
            event.target.value = event.target.value.slice(0, maxLength);
        }
    }

    checkFile(event) {
        const file = event.target.files[0];
        const allowedTypes = ['application/pdf', 'image/png', 'image/jpeg'];

        if (file) {
            if (file.size === 0) {
                alert('File size is 0. Please select a valid file.');
                event.target.value = '';
            } else if (!allowedTypes.includes(file.type)) {
                alert('Invalid file type. Only PDF, PNG, and JPG are allowed.');
                event.target.value = '';
            }
        }
    }
}

// Instantiate the class to attach listeners
new InputRestrictor();
