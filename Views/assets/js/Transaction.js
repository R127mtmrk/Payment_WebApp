document.addEventListener('DOMContentLoaded', function() {

    // --- 1. RECUPERATION DES ELEMENTS ---
    const form = document.getElementById('transactionForm');
    const messageDiv = document.getElementById('message_transact');
    const messageHidden = document.getElementById('message_input');
    const errorContainer = document.getElementById('jsErrorContainer');

    const receiverInput = document.getElementById('receiver');
    const amountInput = document.getElementById('amount');
    const cardInput = document.getElementById('id_card');
    const cvvInput = document.getElementById('cvv');

    document.execCommand('styleWithCSS', false, true);

    // --- 2. GESTION DE LA BARRE D'OUTILS ---
    const buttons = document.querySelectorAll('.btn-format');
    buttons.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            let cmd = btn.getAttribute('data-cmd');
            let val = btn.getAttribute('data-val') || null;

            document.execCommand(cmd, false, val);

            if(messageDiv) messageDiv.focus();
        });
    });

    // --- 3. GESTION DE L'ENVOI DU FORMULAIRE ---
    if (form) {
        form.addEventListener('submit', function(e) {

            let errors = [];

            if (messageDiv && messageHidden) {
                messageHidden.value = messageDiv.innerHTML;
                console.log("Message copié pour l'envoi :", messageHidden.value);
            }

            if (receiverInput && receiverInput.value.trim() === "") {
                errors.push("Le destinataire est requis.");
            }

            if (amountInput) {
                let amountVal = parseFloat(amountInput.value.replace(',', '.'));
                if (isNaN(amountVal) || amountVal <= 0) {
                    errors.push("Le montant doit être valide et supérieur à 0.");
                }
            }

            if (cardInput && cardInput.value === "") {
                errors.push("Veuillez sélectionner une carte.");
            }

            if (cvvInput) {
                const cvvRegex = /^\d{3,4}$/;
                if (!cvvRegex.test(cvvInput.value)) {
                    errors.push("Le CVV est invalide.");
                }
            }

            if (errors.length > 0) {
                e.preventDefault();

                if (errorContainer) {
                    errorContainer.innerHTML = errors.join('<br>');
                    errorContainer.style.display = 'block';
                }
                window.scrollTo(0, 0);
            } else {
                if (errorContainer) {
                    errorContainer.style.display = 'none';
                }
            }
        });
    }
});