document.addEventListener('DOMContentLoaded', function() {

    const form = document.getElementById('inscriptionForm');
    const errorContainer = document.getElementById('jsErrorContainer');

    const usernameInput = document.getElementById('username');
    const emailInput = document.getElementById('usermail');
    const pwdInput = document.getElementById('password_create');
    const confirmInput = document.getElementById('password_confirm');

    const pwdHelper = document.getElementById('pwdHelper');
    const confirmHelper = document.getElementById('confirmHelper');

    const passwordRegex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]).{8,}$/;
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;


    pwdInput.addEventListener('input', () => {
        if (!passwordRegex.test(pwdInput.value)) {
            pwdHelper.style.color = 'red';
            pwdHelper.textContent = "8 car. min, 1 Maj, 1 min, 1 chiffre, 1 spécial.";
        } else {
            pwdHelper.style.color = 'green';
            pwdHelper.textContent = "Mot de passe fort ✔";
        }
    });

    confirmInput.addEventListener('input', () => {
        if (confirmInput.value !== pwdInput.value) {
            confirmHelper.textContent = "Les mots de passe ne correspondent pas.";
        } else {
            confirmHelper.textContent = "";
        }
    });


    form.addEventListener('submit', function(e) {
        let errors = [];

        if (usernameInput.value.trim() === "") errors.push("Le nom d'utilisateur est requis.");
        if (emailInput.value.trim() === "") errors.push("L'adresse email est requise.");
        if (pwdInput.value === "") errors.push("Le mot de passe est requis.");

        if (emailInput.value.trim() !== "" && !emailRegex.test(emailInput.value)) {
            errors.push("L'adresse email n'est pas valide.");
        }

        if (!passwordRegex.test(pwdInput.value)) {
            errors.push("Le mot de passe ne respecte pas les critères de sécurité.");
        }

        if (pwdInput.value !== confirmInput.value) {
            errors.push("Les deux mots de passe ne sont pas identiques.");
        }

        if (errors.length > 0) {
            e.preventDefault();
            errorContainer.innerHTML = errors.join('<br>');
            errorContainer.style.display = 'block';
            window.scrollTo(0, 0);
        } else {
            errorContainer.style.display = 'none';
        }
    });
});