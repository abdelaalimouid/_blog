document.addEventListener("DOMContentLoaded", function () {
    const passwordInput = document.getElementById("form2Example2");
    const confirmPasswordInput = document.getElementById("confirmPassword");
    const submitButton = document.getElementById("submitButton");

    confirmPasswordInput.addEventListener("input", function () {
        if (confirmPasswordInput.value === passwordInput.value) {
            confirmPasswordInput.setCustomValidity("");
        } else {
            confirmPasswordInput.setCustomValidity("Passwords do not match");
        }
    });

    submitButton.addEventListener("click", function (event) {
        if (!confirmPasswordInput.checkValidity()) {
            event.preventDefault();
            alert("Passwords do not match. Please try again.");
        }
    });
});
