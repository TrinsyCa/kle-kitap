window.addEventListener("DOMContentLoaded", function() {
    const first_text = document.querySelector(".first-text");
    if(first_text)
    { first_text.focus(); }
});
function previewImage() {
    const file = document.getElementById("img").files[0];
    const fileContainer = document.getElementById("file-container");
    const imgElement = document.getElementById("preview");
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            imgElement.src = e.target.result;
            fileContainer.classList.remove("deactive");
        };
        reader.readAsDataURL(file);
    }
}