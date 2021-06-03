import Form from "./Form.js";

const btnLike = document.querySelector(".btn.btn-like");
const btnImg = btnLike.querySelector(".icon-like");
const btnShowForm = document.querySelector(".btn-show-form");
const signInForm = document.querySelector(".popup-login-wrapper");

btnLike.addEventListener("mouseover", () => {
    btnImg.src = "./img/like(white).svg";
    btnLike.classList.toggle("active");
});

btnLike.addEventListener("mouseleave", () => {
    btnImg.src = "./img/like.svg";
    btnLike.classList.toggle("active");
});

btnShowForm.addEventListener("click", () => {
    Form.showHideForm(signInForm);
});