document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('loginForm');
    const errorContainer = document.getElementById('jsErrorContainer');
    const usernameInput = document.getElementById('username');
    const passwordInput = document.getElementById('password');

    form.addEventListener('submit', function(e) {
        let errors = [];

        if (usernameInput.value.trim() === "") {
            errors.push("Veuillez entrer votre nom d'utilisateur ou email.");
        }

        if (passwordInput.value === "") {
            errors.push("Veuillez entrer votre mot de passe.");
        }

        if (errors.length > 0) {
            e.preventDefault();

            errorContainer.innerHTML = errors.join('<br>');
            errorContainer.classList.remove('hidden');
            errorContainer.style.display = 'block';
        } else {
            errorContainer.classList.add('hidden');
            errorContainer.style.display = 'none';
        }
    });
});