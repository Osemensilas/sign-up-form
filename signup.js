const eyeOpens = document.querySelectorAll(".eye-open");
const eyeCloses = document.querySelectorAll(".eye-close");

for (let i = 0; i < eyeOpens.length; i++) {
    let eyeOpen = eyeOpens[i];

    eyeOpen.addEventListener("click", function() {
        eyeOpen.classList.remove("active");
        eyeOpen.parentElement.children[3].classList.remove("active");
        eyeOpen.parentElement.children[1].type = "text";
    });
}

for (let i = 0; i < eyeCloses.length; i++) {
    let eyeClose = eyeCloses[i];

    eyeClose.addEventListener("click", function() {
        eyeClose.classList.add("active");
        eyeClose.parentElement.children[2].classList.add("active");
        eyeClose.parentElement.children[1].type = "password";
    });
}