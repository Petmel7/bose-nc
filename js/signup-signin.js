
document.addEventListener('DOMContentLoaded', function () {
    const signupForm = document.getElementById('signupForm');
    const signinForm = document.getElementById('signinForm');

    const validateForm = function(form) {
        const inputs = form.querySelectorAll('input');
        inputs.forEach(function (input) {
            if (input.value.trim() === '') {
                input.style.borderBottom = '2px solid var(--accent-color)';
            }
        });

        const hasEmptyFields = [...inputs].some(function (input) {
            return input.value.trim() === '';
        });

        if (hasEmptyFields) {
            event.preventDefault();
            alert('Заповніть всі поля');
        }
    };

    signupForm.addEventListener('submit', function () {
        validateForm(signupForm);
    });

    signinForm.addEventListener('submit', function () {
        validateForm(signinForm);
    });
});

