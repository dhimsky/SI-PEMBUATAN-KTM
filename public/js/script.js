const form = document.querySelector("form");
const nextBtn = form.querySelector(".nextBtn");
const backBtn = form.querySelector(".backBtn");
const allInput = form.querySelectorAll(".first input");

nextBtn.addEventListener("click", (e) => {
    e.preventDefault(); // Mencegah tindakan default dari tombol "Next"

    let isAnyInputFilled = false;

    allInput.forEach((input) => {
        if (input.value !== "") {
            isAnyInputFilled = true;
        }
    });

    if (isAnyInputFilled) {
        form.classList.add("secActive");
    } else {
        form.classList.remove("secActive");
    }
});

backBtn.addEventListener("click", () => {
    form.classList.remove("secActive");
});
