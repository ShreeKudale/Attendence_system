
document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector("form");

    form.addEventListener("submit", function(event) {
        let email = form.querySelector("input[name='email']").value;
        let password = form.querySelector("input[name='password']").value;

        if (email.trim() === "" || password.trim() === "") {
            alert("All fields are required!");
            event.preventDefault();
        }
    });
});
