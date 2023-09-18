const form = document.getElementById('form');
const username = document.getElementById('username');
const email = document.getElementById('email');
const password = document.getElementById('password');
const password2 = document.getElementById('password2');

function isStrongPassword(passwordValue) {
    // Declarar expresiones regulares para cada criterio
    const uppercaseRegex = /[A-Z]/;
    const lowercaseRegex = /[a-z]/;
    const numberRegex = /[0-9]/;
    const specialCharRegex = /[!@#$%^&*()_+{}\[\]:;<>,.?~\\-]/;

    // Verificar cada criterio individualmente
    const hasUppercase = uppercaseRegex.test(passwordValue);
    const hasLowercase = lowercaseRegex.test(passwordValue);
    const hasNumber = numberRegex.test(passwordValue);
    const hasSpecialChar = specialCharRegex.test(passwordValue);

    // Comprobar si todos los criterios se cumplen
    return hasUppercase && hasLowercase && hasNumber && hasSpecialChar;
}

form.addEventListener('submit', e => {
    e.preventDefault();

    if (validateInputs()) {
        // Si todos los campos son válidos, redirige a otra página
        window.location.href = 'prueba.html';
    }
});

const setError = (element, message) => {
    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector('.error');

    errorDisplay.innerText = message;
    inputControl.classList.add('error');
    inputControl.classList.remove('success');
};

const setSuccess = element => {
    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector('.error');

    errorDisplay.innerText = '';
    inputControl.classList.add('success');
    inputControl.classList.remove('error');
};

const isValidEmail = email => {
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
};

const validateInputs = () => {
    const usernameValue = username.value.trim();
    const emailValue = email.value.trim();
    const passwordValue = password.value.trim();
    const password2Value = password2.value.trim();

    if (usernameValue === '') {
        setError(username, 'Username is required');
    } else {
        setSuccess(username);
    }

    if (emailValue === '') {
        setError(email, 'Email is required');
    } else if (!isValidEmail(emailValue)) {
        setError(email, 'Provide a valid email address');
    } else {
        setSuccess(email);
    }

    if (passwordValue === '') {
        setError(password, 'Password is required');
    } else if (passwordValue.length < 8) {
        setError(password, 'Password must be at least 8 characters.');
    } else if (!isStrongPassword(passwordValue)) {
        setError(
            password,
            'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.'
        );
    } else {
        setSuccess(password);
    }

    if (password2Value === '') {
        setError(password2, 'Please confirm your password');
    } else if (password2Value !== passwordValue) {
        setError(password2, "Passwords don't match");
    } else {
        setSuccess(password2);
    }

    // Devuelve true si todos los campos son válidos, de lo contrario, devuelve false
    return (
        usernameValue !== '' &&
        emailValue !== '' &&
        isValidEmail(emailValue) &&
        passwordValue !== '' &&
        passwordValue.length >= 8 &&
        isStrongPassword(passwordValue) &&
        password2Value !== '' &&
        password2Value === passwordValue
    );
};
