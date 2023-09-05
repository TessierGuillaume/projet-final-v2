document.addEventListener("DOMContentLoaded", function() {
    // Code pour le menu mobile
    const icone = document.querySelector('.navbar-mobile i');
    const modal = document.querySelector('.modal');
    const socialIcons = document.querySelectorAll('.social-icons-mobile i');

    icone.addEventListener('click', function() {
        console.log("icone cliquée");
        modal.classList.toggle('change-modal');
        icone.classList.toggle('fa-times');

        socialIcons.forEach(icon => {
            icon.classList.toggle('move-icon');
        });
    });

    // Code pour l'indicateur animé de la barre de navigation
    const links = document.querySelectorAll('.navbar-desktop ul li');
    const indicator = document.querySelector('.navbar-desktop ul .indicator');

    links.forEach(link => {
        link.addEventListener('mouseover', function() {
            const linkBounds = link.getBoundingClientRect();
            const ulBounds = link.parentElement.getBoundingClientRect();

            indicator.style.width = `${linkBounds.width}px`;
            indicator.style.left = `${linkBounds.left - ulBounds.left}px`;
        });

        link.addEventListener('mouseout', function() {
            indicator.style.width = 0;
        });
    });
});
