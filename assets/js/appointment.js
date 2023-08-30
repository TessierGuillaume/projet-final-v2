document.addEventListener('DOMContentLoaded', function () {
    const appointmentDateInput = document.getElementById('appointmentDate');

    // Fonction pour vérifier si la date est un jour de semaine
    function isWeekday(date) {
        const day = date.getDay();
        return day >= 1 && day <= 5; // 1 pour lundi, 5 pour vendredi
    }

    // Empêcher la soumission du formulaire si la date sélectionnée n'est pas un jour de semaine
    document.querySelector('form').addEventListener('submit', function (event) {
        const selectedDate = new Date(appointmentDateInput.value);

        if (!isWeekday(selectedDate)) {
            alert("Veuillez sélectionner un jour de la semaine (du lundi au vendredi).");
            event.preventDefault(); // Empêcher la soumission du formulaire
        }
    });
});
