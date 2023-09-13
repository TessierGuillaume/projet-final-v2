document.addEventListener("DOMContentLoaded", function() {
    // Code pour le menu mobile
    const icone = document.querySelector('.navbar-mobile i');
    const modal = document.querySelector('.modal');

    icone.addEventListener('click', function() {
        console.log("icone cliquée");
        modal.classList.toggle('change-modal');
        icone.classList.toggle('fa-times');
    });

    // Code pour l'indicateur animé de la barre de navigation
    // (Note: Cette partie du code ne sera pas utilisée pour l'instant puisque 
    // votre menu admin n'a pas d'indicateur, mais je l'ai laissé au cas où vous 
    // voudriez l'ajouter plus tard)
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
