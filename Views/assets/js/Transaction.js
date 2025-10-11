const form = document.querySelector('form');
const editor = document.getElementById('message_transact');
const hiddenInput = document.getElementById('message_input');

form.addEventListener('submit', () => {
    hiddenInput.value = editor.innerHTML;
});