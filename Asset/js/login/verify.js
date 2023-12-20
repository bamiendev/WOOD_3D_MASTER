
const inputs = document.querySelectorAll(".otp-card-inputs input");

inputs.forEach((input, index) => {
    input.addEventListener("input", (e) => {
        input.value = input.value.replace(/\D/g, "");
        if (input.value && index < inputs.length - 1) {
            inputs[index + 1].focus();
        }
    });

    input.addEventListener("keydown", (e) => {
        if (e.key === "Backspace" && index > 0) {
            if (!input.value) {
                inputs[index - 1].focus();
            }
        }
    });
});

inputs.forEach((input, index) => {
    input.addEventListener("paste", (e) => {
        e.preventDefault();
        const clipboardData = e.clipboardData.getData("text");
        if (/^\d+$/.test(clipboardData)) {
            const digits = clipboardData.split("");
            inputs.forEach((input, i) => {
                if (i < digits.length) {
                    input.value = digits[i];
                    if (i < inputs.length - 1) {
                        inputs[i + 1].focus();
                    }
                }
            });
        }
    });
});

