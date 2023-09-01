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
