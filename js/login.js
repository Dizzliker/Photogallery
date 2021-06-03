const loginForm = document.querySelector(".login-form"),
errorBox = loginForm.querySelector(".info-box");

loginForm.addEventListener("submit", e => {
    e.preventDefault();

    const xhr = new XMLHttpRequest();
    xhr.open('POST', "../db/login.php", true);
    xhr.onload = () => {
        if (xhr.status === 200 && xhr.readyState === XMLHttpRequest.DONE) {
            const data = xhr.response;
            if (data === "Успешно") {
                errorBox.textContent = data;
                errorBox.style.display = "flex";
                location.reload();
            } else {
                errorBox.style.display = "flex";
                errorBox.textContent = data;
            }
        }
    }
    const formData = new FormData(loginForm);
    xhr.send(formData);
})