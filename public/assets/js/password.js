document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("register-form");
    const submitBtn = document.getElementById("submit-btn");
    form.addEventListener("input", function () {
        const allFilled = Array.from(form.querySelectorAll("[required]")).every(
            (input) => input.value.trim() !== ""
        );
        submitBtn.disabled = !allFilled;
    });
});
(function () {
    const inputs = Array.from(document.querySelectorAll(".otp-input"));
    const hidden = document.getElementById("passwordHidden");
    const form = document.getElementById("myForm");

    inputs[0].focus();

    inputs.forEach((input, idx) => {
        input.addEventListener("input", (e) => {
            const value = e.target.value;
            const digit = value.replace(/\D/g, "").slice(0, 1);
            e.target.value = digit;

            if (digit && idx < inputs.length - 1) {
                inputs[idx + 1].focus();
                inputs[idx + 1].select();
            }
            updateHidden();
        });

        input.addEventListener("keydown", (e) => {
            if (e.key === "Backspace" && !e.target.value && idx > 0) {
                inputs[idx - 1].focus();
            } else if (e.key === "ArrowLeft" && idx > 0) {
                inputs[idx - 1].focus();
            } else if (e.key === "ArrowRight" && idx < inputs.length - 1) {
                inputs[idx + 1].focus();
            }
        });

        input.addEventListener("paste", (e) => {
            e.preventDefault();
            const paste = (e.clipboardData || window.clipboardData).getData(
                "text"
            );
            const digits = paste
                .replace(/\D/g, "")
                .slice(0, inputs.length - idx)
                .split("");
            digits.forEach((d, i) => {
                inputs[idx + i].value = d;
            });
            const nextIndex = Math.min(idx + digits.length, inputs.length - 1);
            inputs[nextIndex].focus();
            updateHidden();
        });

        input.addEventListener("keypress", (e) => {
            if (!/[0-9]/.test(e.key)) {
                e.preventDefault();
            }
        });
    });

    function updateHidden() {
        hidden.value = inputs.map((i) => i.value || "").join("");
    }

    form.addEventListener("submit", (e) => {
        updateHidden();
        if (hidden.value.length < inputs.length) {
            e.preventDefault();
            alert("من فضلك املأ جميع خانات كلمة المرور.");
            const firstEmpty = inputs.find((i) => !i.value);
            if (firstEmpty) firstEmpty.focus();
        }
    });
})();
