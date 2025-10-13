document.addEventListener('DOMContentLoaded', function() {
    const cardInput = document.getElementById('card_number');
    const dateInput = document.getElementById('expiry_date');
    const submitBtn = document.querySelector('button[type="submit"]');

    function isCardValid() {
        // 16 chiffres sans compter les tirets
        return cardInput.value.replace(/\D/g, '').length === 16;
    }

    function isDateValid() {
        // Doit respecter MM/AA exactement, longueur 5
        return /^\d{2}\/\d{2}$/.test(dateInput.value);
    }

    function checkFormValidity() {
        submitBtn.disabled = !(isCardValid() && isDateValid());
    }

    // Formatage carte bancaire
    cardInput.addEventListener('input', function(e) {
        let onlyDigits = this.value.replace(/\D/g, '').slice(0, 16);
        let formatted = onlyDigits.match(/.{1,4}/g);
        this.value = formatted ? formatted.join('-') : '';
        checkFormValidity();
    });

    cardInput.addEventListener('keypress', function(e) {
        if (e.key && !/\d/.test(e.key)) e.preventDefault();
    });

    // Formatage date d'expiration
    dateInput.addEventListener('input', function(e) {
        let onlyDigits = this.value.replace(/\D/g, '').slice(0, 4);
        if (onlyDigits.length > 2) {
            this.value = onlyDigits.slice(0,2) + '/' + onlyDigits.slice(2,4);
        } else {
            this.value = onlyDigits;
        }
        checkFormValidity();
    });

    dateInput.addEventListener('keypress', function(e) {
        if (e.key && !/\d/.test(e.key)) e.preventDefault();
        if (this.value.length >= 5 && window.getSelection().toString() === '') e.preventDefault();
    });

    // Initialise le bouton désactivé
    submitBtn.disabled = true;
});
