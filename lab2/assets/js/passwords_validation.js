let pass1 = document.getElementById('password');
let pass2 = document.getElementById('password2');

function validate_passwords(final) {
    if (pass1.value != pass2.value) {
        if (final) {
            pass2.setCustomValidity('Passwords do not match.');
            pass2.classList.add('invalid');
            pass2.reportValidity();
        }
        return false;
    }
    if (pass1.value.length < 6) {
        if (final) {
            pass2.setCustomValidity('Minimal password length is 6 characters.');
            pass2.classList.add('invalid');
            pass2.reportValidity();
        }
        return false;
    }
    
    if (pass2.value != '') {
        pass2.setCustomValidity('');
        pass2.classList.add('valid');
    }
}

pass1.onchange = pass1.onkeyup = pass2.onkeyup = () => validate_passwords(false);
pass2.onchange = () => validate_passwords(true);
