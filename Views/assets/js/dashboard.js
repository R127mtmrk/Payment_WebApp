document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('refundModal');
    const inputId = document.getElementById('refundIdInput');

    window.openRefundModal = function(id) {
        if(modal) {
            if(inputId) inputId.value = id;
            modal.classList.add('active');
        }
    };

    window.closeRefundModal = function() {
        if(modal) modal.classList.remove('active');
    };

    if(modal) {
        modal.addEventListener('click', (e) => {
            if (e.target === modal) window.closeRefundModal();
        });
    }

    document.querySelectorAll('.toast').forEach(t => {
        t.addEventListener('click', () => t.style.display = 'none');
        setTimeout(() => { t.style.opacity = '0'; setTimeout(() => t.style.display = 'none', 500); }, 4000);
    });
});