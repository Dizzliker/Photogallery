const inputSearch = document.querySelector(".input-search");
const cardContainer = document.querySelector(".cards");
const formSearch = document.querySelector(".form-search");

formSearch.onsubmit = (e) => {
    e.preventDefault();
}

inputSearch.onkeyup = () => {
    const text = inputSearch.value;

    const xhr = new XMLHttpRequest;
    xhr.open("POST", "../db/search.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            const data = xhr.response;
            cardContainer.innerHTML = data;
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("text=" + text);
}