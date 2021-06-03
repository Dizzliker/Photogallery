const regForm = document.querySelector(".reg-form"),
infoBox = regForm.querySelector(".info-box");

regForm.addEventListener("submit", e => {
    e.preventDefault();

    const xhr = new XMLHttpRequest();
    xhr.open('POST', "../db/register.php", true);
    xhr.onload = () => {
        if (xhr.status === 200 && xhr.readyState === XMLHttpRequest.DONE) {
            const data = xhr.response;
            if (data === "Успешно") {
                infoBox.textContent = data;
                location.reload();
            } else {
                infoBox.style.display = "flex";
                infoBox.textContent = data;
            }
        }
    }
    const formData = new FormData(regForm);
    xhr.send(formData);
})