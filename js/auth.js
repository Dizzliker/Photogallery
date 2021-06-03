import Form from "./Form.js";

const btnSignIn = document.querySelector(".sign-in"),
signInForm = document.querySelector(".popup-login-wrapper"),
btnCloseForm = document.querySelector(".login-form .close-form img"),
btnCloseRegForm = document.querySelector(".reg-form .close-form img"),
signUpForm = document.querySelector(".popup-register-wrapper"),
btnShowSignUpForm = document.querySelector(".btn-show-sign-up-form"),
btnShowSignInForm = document.querySelector(".btn-show-sign-ing-form");

btnSignIn.addEventListener("click", () => {
    Form.showHideForm(signInForm);
});

btnCloseForm.addEventListener("click", () => {
    Form.showHideForm(signInForm);
});

btnShowSignUpForm.addEventListener("click", () => {
    Form.showHideForm(signInForm);
    Form.showHideForm(signUpForm);
});

btnCloseRegForm.addEventListener("click", () => {
    Form.showHideForm(signUpForm);
});

btnShowSignInForm.addEventListener("click", () => {
    Form.showHideForm(signInForm);
    Form.showHideForm(signUpForm);
})