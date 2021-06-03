export default class Form {
    static showHideForm(el) {
        if (el.style.display === "none") {
            el.style.display = "flex";
        } else {
            el.style.display = "none";
        }
    }
}