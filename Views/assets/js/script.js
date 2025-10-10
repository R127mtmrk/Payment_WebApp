/*
    Pour l'ajout de carte on doit pas pouvoir mettre de lettre
 */

// Test les MDP correspondance et complexité
const password_create = document.getElementById("password_create");
const password_confirm = document.getElementById("password_confirm");
const submitBtn = document.querySelector("button[type='submit']");
const message = document.createElement("p");
message.style.color = "red";
password_create.parentNode.appendChild(message);

const passwordMessage = document.createElement("p");
passwordMessage.style.color = "red";
password_create.parentNode.appendChild(passwordMessage);

const confirmMessage = document.createElement("p");
confirmMessage.style.color = "red";
password_confirm.parentNode.appendChild(confirmMessage);

function validatePassword() {
    const pwd = password_create.value;
    // 8 caractères, au moins une lettre en majuscule, un chiffre et un caractère spécial
    const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]).{8,}$/;

    if (!passwordRegex.test(pwd)) {
        passwordMessage.textContent = "Le mot de passe doit contenir au moins 8 caractères, dont une lettre, un chiffre, et un caractère spécial.";
    } else {
        passwordMessage.textContent = "";
        return true;
    }
}

function validateConfirm() {
    if (password_create.value !== password_confirm.value) {
        confirmMessage.textContent = "Les mots de passe ne sont pas identiques.";
    } else {
        confirmMessage.textContent = "";
        return true;
    }
}

function validateForm() {
    const pwdValid = validatePassword();
    const confirmValid = validateConfirm();
    submitBtn.disabled = !(pwdValid && confirmValid);
}

password_create.addEventListener("input", validateForm);
password_confirm.addEventListener("input", validateForm);

submitBtn.disabled = true;