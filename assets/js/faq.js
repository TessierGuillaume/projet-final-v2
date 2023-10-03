document.addEventListener('DOMContentLoaded', function() {
    const questions = document.querySelectorAll('dt');

    questions.forEach(function(question) {
        question.addEventListener('click', function() {
            const answer = this.nextElementSibling;
            answer.classList.toggle('hidden');

            const icon = this.querySelector('.fa-solid');
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
