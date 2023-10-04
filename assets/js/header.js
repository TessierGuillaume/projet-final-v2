document.addEventListener("DOMContentLoaded", function() {
    // Gestion du menu mobile
    const icone = document.querySelector('.navbar-mobile i'); 
    const modal = document.querySelector('.modal'); 
    const socialIcons = document.querySelectorAll('.social-icons-mobile i'); 

    // Écouteur d'événement pour le clic sur l'icône du menu
    icone.addEventListener('click', function() {
        // Basculer l'état du modal et de l'icône
        modal.classList.toggle('change-modal');
        icone.classList.toggle('fa-times');

        // Déplacer les icônes sociales
        socialIcons.forEach(icon => {
            icon.classList.toggle('move-icon');
        });
    });

    // Gestion de l'indicateur animé de la barre de navigation
    const links = document.querySelectorAll('.navbar-desktop ul li'); // Liens de la barre de navigation
    const indicator = document.querySelector('.navbar-desktop ul .indicator'); // Indicateur animé

    // Écouteurs d'événement pour le survol des liens
    links.forEach(link => {
        link.addEventListener('mouseover', function() {
            // Position et largeur de l'indicateur basés sur le lien survolé
            const linkBounds = link.getBoundingClientRect();
            const ulBounds = link.parentElement.getBoundingClientRect();
            indicator.style.width = `${linkBounds.width}px`;
            indicator.style.left = `${linkBounds.left - ulBounds.left}px`;
        });

        // Réinitialiser l'indicateur lorsque la souris quitte le lien
        link.addEventListener('mouseout', function() {
            indicator.style.width = 0;
        });
    });
});
