
document.addEventListener("DOMContentLoaded", function () {

    // MOBILE NAVIGATION MENU
    const menuBtn = document.getElementById("menuBtn");
    const navLinks = document.querySelector(".nav-links");

    if (menuBtn && navLinks) {
        menuBtn.addEventListener("click", function () {
            navLinks.classList.toggle("active");

            const isOpen = navLinks.classList.contains("active");
            menuBtn.setAttribute("aria-expanded", String(isOpen));
            menuBtn.textContent = isOpen ? "✕" : "☰";
        });

        // Close the menu after selecting a link
        navLinks.querySelectorAll("a").forEach(function (link) {
            link.addEventListener("click", function () {
                navLinks.classList.remove("active");
                menuBtn.setAttribute("aria-expanded", "false");
                menuBtn.textContent = "☰";
            });
        });
    }

    // CONTACT FORM (FRONT-END DEMO ONLY)
    const contactForm = document.getElementById("contactForm");

    if (contactForm) {
        contactForm.addEventListener("submit", function (event) {
            event.preventDefault();
            alert("Thank you for contacting us!");
            contactForm.reset();
        });
    }

    // STUDENT REGISTRATION FORM (FRONT-END DEMO ONLY)
    const registerForm = document.getElementById("registerForm");

    if (registerForm) {
        registerForm.addEventListener("submit", function (event) {
            event.preventDefault();

            if (registerForm.checkValidity()) {
                alert("Registration form validated. Saving registrations requires the backend.");
            } else {
                registerForm.reportValidity();
            }
        });
    }

    // STUDENT LOGIN FORM (FRONT-END DEMO ONLY)
    const loginForm = document.getElementById("loginForm");

    if (loginForm) {
        loginForm.addEventListener("submit", function (event) {
            event.preventDefault();

            if (loginForm.checkValidity()) {
                alert("The login page is ready for backend connection.");
            } else {
                loginForm.reportValidity();
            }
        });
    }

    // SHOW/HIDE PASSWORD
    const passwordToggles = [
        { button: "togglePassword", password: "password" },
        { button: "loginTogglePassword", password: "loginPassword" },
        { button: "adminTogglePassword", password: "adminPassword" }
    ];

    passwordToggles.forEach(function (item) {
        const button = document.getElementById(item.button);
        const password = document.getElementById(item.password);

        if (button && password) {
            button.addEventListener("click", function () {
                const showPassword = password.type === "password";
                password.type = showPassword ? "text" : "password";
                button.textContent = showPassword ? "Hide" : "Show";
            });
        }
    });

    // ADMIN LOGIN FORM (FRONT-END DEMO ONLY)
    const adminLoginForm = document.getElementById("adminLoginForm");

    if (adminLoginForm) {
        adminLoginForm.addEventListener("submit", function (event) {
            event.preventDefault();

            if (adminLoginForm.checkValidity()) {
                alert("Admin login requires backend authentication.");
            } else {
                adminLoginForm.reportValidity();
            }
        });
    }

});