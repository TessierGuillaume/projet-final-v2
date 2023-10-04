// Sélection de tous les éléments input dans les sections #login et #register
document.querySelectorAll('#login .input-box input, #register .input-box input').forEach(input => {

    // Ajout d'un écouteur d'événement 'focus' pour chaque input
    input.addEventListener('focus', () => {
        hideLabel(input); // Appel de la fonction hideLabel
    });


    input.addEventListener('input', () => {
        hideLabel(input);
    });
});

// Fonction pour cacher le label associé à un input
function hideLabel(input) {
    const inputBox = input.parentElement; // Obtenir le parent direct de l'input (input-box)
    const label = inputBox.querySelector('label'); // Trouver le label dans input-box

    if (label) { // Si un label existe
        label.classList.add('hidden'); // Ajouter la classe 'hidden' pour cacher le label
    }
}
