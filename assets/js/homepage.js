// Obtenir les éléments du carrousel d'images
let img_slider = document.getElementsByClassName('img_slider');
let etape = 0;
let nbr_img = img_slider.length;
let precedent = document.querySelector('.precedent');
let suivant = document.querySelector('.suivant');

// Fonction pour enlever la classe 'active' de toutes les images
function enleverActiveImages() {
    for (let i = 0; i < nbr_img; i++) {
        img_slider[i].classList.remove('active');
    }
}
// ce code est garder pour une utilisation future mais ne s'ctivera pas car j'ai retirer les boutons pour un meilleur rendu visuel!
// Gestion du clic sur le bouton 'Suivant'
suivant.addEventListener('click', function() {
    etape++;
    if (etape >= nbr_img) {
        etape = 0;
    }
    enleverActiveImages();
    img_slider[etape].classList.add('active');
});

// Gestion du clic sur le bouton 'Précédent'
precedent.addEventListener('click', function() {
    etape--;
    if (etape < 0) {
        etape = nbr_img - 1;
    }
    enleverActiveImages();
    img_slider[etape].classList.add('active');
});

// Rotation automatique des images toutes les 9000 ms (9 secondes)
setInterval(function() {
    etape++;
    if (etape >= nbr_img) {
        etape = 0;
    }
    enleverActiveImages();
    img_slider[etape].classList.add('active');
}, 9000);

document.addEventListener('DOMContentLoaded', () => {
    // Gestion du bouton de fermeture de la promotion d'octobre
    const promoOctober = document.getElementById('promo-october');
    const closeBtn = document.createElement('button');

    closeBtn.innerHTML = '<i class="fa-solid fa-circle-xmark"></i>';
    closeBtn.classList.add('close-button');

    closeBtn.addEventListener('click', () => {
        promoOctober.style.display = 'none';
    });

    promoOctober.appendChild(closeBtn);

    // Gestion de la fin de l'animation du titre du carrousel
    const sliderTitle = document.querySelector('.slider-title');

    sliderTitle.addEventListener('animationend', (e) => {
        if (e.animationName === 'typing') {
            sliderTitle.style.animation = 'hide-cursor 0.5s forwards';
        }
    });
});
