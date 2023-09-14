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
}, 5000);


document.addEventListener('DOMContentLoaded', () => {
    const promoOctober = document.getElementById('promo-october');
    const closeBtn = document.createElement('button');

    closeBtn.innerText = 'X';
    closeBtn.style.position = 'absolute';
    closeBtn.style.top = '10px';
    closeBtn.style.right = '10px';
    closeBtn.style.backgroundColor = 'transparent';
    closeBtn.style.border = 'none';
    closeBtn.style.fontSize = '1.2em';
    closeBtn.style.cursor = 'pointer';

    closeBtn.addEventListener('click', () => {
        promoOctober.style.display = 'none';
    });

    promoOctober.appendChild(closeBtn);
});
