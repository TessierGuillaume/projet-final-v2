document.addEventListener('DOMContentLoaded', function() {
    
    const questions = document.querySelectorAll('dt');

    // Itérer sur chaque question
    questions.forEach(function(question) {
        question.addEventListener('click', function() {
            // Obtenir la réponse associée à la question (élément <dd> suivant)
            const answer = this.nextElementSibling;
            // Basculer la visibilité de la réponse
            answer.classList.toggle('hidden');

            // Obtenir l'icône dans la question
            const icon = this.querySelector('.fa-solid');
            // Basculer l'icône entre (+) et (-)
            if (icon.classList.contains('fa-plus')) {
                icon.classList.remove('fa-plus');
                icon.classList.add('fa-minus');
            }
            else {
                icon.classList.remove('fa-minus');
                icon.classList.add('fa-plus');
            }
        });
    });
});
