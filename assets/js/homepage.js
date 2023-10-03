let img_slider = document.getElementsByClassName('img_slider');
let etape = 0;
let nbr_img = img_slider.length;
let precedent = document.querySelector('.precedent');
let suivant = document.querySelector('.suivant');

function enleverActiveImages() {
    for (let i = 0; i < nbr_img; i++) {
        img_slider[i].classList.remove('active');
    }
}

suivant.addEventListener('click', function() {
    etape++;
    if (etape >= nbr_img) {
        etape = 0;
    }
    enleverActiveImages();
    img_slider[etape].classList.add('active');
});

precedent.addEventListener('click', function() {
    etape--;
    if (etape < 0) {
        etape = nbr_img - 1;
    }
    enleverActiveImages();
    img_slider[etape].classList.add('active');
});

setInterval(function() {
    etape++;
    if (etape >= nbr_img) {
        etape = 0;
    }
    enleverActiveImages();
    img_slider[etape].classList.add('active');
}, 9000);

document.addEventListener('DOMContentLoaded', () => {
    const promoOctober = document.getElementById('promo-october');
    const closeBtn = document.createElement('button');

    closeBtn.innerHTML = '<i class="fa-solid fa-circle-xmark"></i>';
    closeBtn.classList.add('close-button');

    closeBtn.addEventListener('click', () => {
        promoOctober.style.display = 'none';
    });

    promoOctober.appendChild(closeBtn);
    
    // Le code pour faire disparaître le curseur à la fin de l'animation de frappe
    const sliderTitle = document.querySelector('.slider-title');

    sliderTitle.addEventListener('animationend', (e) => {
        if (e.animationName === 'typing') {
            sliderTitle.style.animation = 'hide-cursor 0.5s forwards';
        }
    });
});
