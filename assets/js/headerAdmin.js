document.addEventListener("DOMContentLoaded", function() {
    // Gestion du menu mobile
    const icone = document.querySelector('.navbar-mobile i');
    const modal = document.querySelector('.modal');

    // Écouteur pour l'icône du menu mobile
    icone.addEventListener('click', function() {
// Basculer entre les classes pour ouvrir/fermer le menu
        modal.classList.toggle('change-modal');
        icone.classList.toggle('fa-times');
    });
    const links = document.querySelectorAll('.navbar-desktop ul li');
    const indicator = document.querySelector('.navbar-desktop ul .indicator');

    // Écouteurs d'événements pour les liens de la barre de navigation
    links.forEach(link => {
        link.addEventListener('mouseover', function() {
            // Calculer la position et la taille de l'indicateur en fonction du lien survolé
            const linkBounds = link.getBoundingClientRect();
            const ulBounds = link.parentElement.getBoundingClientRect();

            indicator.style.width = `${linkBounds.width}px`;
            indicator.style.left = `${linkBounds.left - ulBounds.left}px`;
        });

        link.addEventListener('mouseout', function() {
            // Réinitialiser la taille de l'indicateur lorsque la souris quitte le lien
            indicator.style.width = 0;
        });
    });
});
