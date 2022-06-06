// vim: set sw=4 ts=4 expandtab nu:
const form=document.getElementById('form');

// We prevent the default submit action and call checkInputs()
form.addEventListener('submit', (e) => {
    e.preventDefault();
    checkInputs();
})

function setErrorFor(input, message) {
    // We need to add error class to parent of input
    // formControl is .form-control element
    const formControl = input.parentElement;

    // We need to add the error message inside the small tag
    const small = formControl.querySelector('small');

    // Add error message inside small
    small.innerText = message;

    // Set the form control class
    formControl.className = 'form-control error';
}

function setSuccessFor(input) {
    // We need to set the class to be success in the .form-control 
    // parent of the input element
    const formControl = input.parentElement;

    // Set the form control class
    formControl.className = 'form-control success';
}

function isEmail(email) {
    // We will just use a regex to check if is a valid email
	return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
}

