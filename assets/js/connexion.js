document.querySelectorAll('#login .input-box input, #register .input-box input').forEach(input => {
    input.addEventListener('focus', () => {
        hideLabel(input);
    });
    input.addEventListener('input', () => {
        hideLabel(input);
    });
});

function hideLabel(input) {
    const inputBox = input.parentElement;
    const label = inputBox.querySelector('label');

    if (label) {
        label.classList.add('hidden');
    }
}
