// Back to top
const upButton = document.getElementById("upButton");

// Show button when scrolling down
window.onscroll = function () {
    if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
        upButton.style.display = "block";
    } else {
        upButton.style.display = "none";
    }
};

// Scroll to top when button is clicked
upButton.onclick = function () {
    window.scrollTo({ top: 0, behavior: "smooth" });
};


document.addEventListener("DOMContentLoaded", function () {
    const toggleFormLink = document.getElementById("toggleForm");
    const loginForm = document.getElementById("loginForm");
    const signupForm = document.getElementById("signupForm");
    const formTitle = document.getElementById("formTitle");
    const formToggleText = document.getElementById("formToggleText");

    function toggleForms() {
        if (signupForm.classList.contains("hidden")) {
            signupForm.classList.remove("hidden");
            loginForm.classList.add("hidden");
            formTitle.textContent = "Sign Up";
            formToggleText.innerHTML = 'Already have an account? <a href="#" id="toggleForm">Log in</a>';
        } else {
            loginForm.classList.remove("hidden");
            signupForm.classList.add("hidden");
            formTitle.textContent = "Log in";
            formToggleText.innerHTML = 'New to site? <a href="#" id="toggleForm">Sign up</a>';
        }
    }

    document.body.addEventListener("click", function (event) {
        if (event.target && event.target.id === "toggleForm") {
            event.preventDefault();
            toggleForms();
        }
    });
});

//aa