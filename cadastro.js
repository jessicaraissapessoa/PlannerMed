const form = document.getElementById('form_login');
const email = document.getElementById('email'); 
const password = document.getElementById('password');

email.addEventListener('input', checkEmail);
password.addEventListener('input', checkPassword);


function checkEmail() {
    const emailValue = email.value.trim();

    if (emailValue === '') {
        setErrorFor(email, 'Preencha esse campo');
    } else if (!isEmail(emailValue)) {
        setErrorFor(email, 'Email inválido');
    } else {
        setSuccessFor(email);
    }
}

function checkPassword() {
    const passwordValue = password.value.trim();

    if (passwordValue === '') {
        setErrorFor(password, 'Preencha esse campo');
    } else if (passwordValue.length < 4) {
        setErrorFor(password, 'Preencha esse campo');
    } else {
        setSuccessFor(password);
    }
}

function setErrorFor(input, message) {
    const formControl = input.parentElement;
    const small = formControl.querySelector('small');

    small.innerText = message;
    formControl.className = 'form_control_login error';
}

function setSuccessFor(input) {
    const formControl = input.parentElement;
    formControl.className = 'form_control_login success';
}

function isEmail(email) {
    return /^(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/.test(email);
}
