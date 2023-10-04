
document.addEventListener("DOMContentLoaded", function() {

    // Fonction pour obtenir la valeur d'une cellule donnée dans une ligne de tableau (tr)
    const getCellValue = (tr, idx) => tr.children[idx].innerText || tr.children[idx].textContent;

    // Fonction de comparaison pour trier les cellules d'une colonne
    const comparer = (idx, asc) => (a, b) => ((v1, v2) =>
        // Si les deux valeurs sont des nombres, faire une soustraction, sinon faire une comparaison locale
        v1 !== '' && v2 !== '' && !isNaN(v1) && !isNaN(v2) ? v1 - v2 : v1.toString().localeCompare(v2)
    )(getCellValue(asc ? a : b, idx), getCellValue(asc ? b : a, idx));

    // Attacher un événement 'click' à chaque en-tête de tableau (th)
    document.querySelectorAll('th').forEach(th => th.addEventListener('click', (() => {
        // Trouver le tableau le plus proche de l'en-tête cliqué
        const table = th.closest('table');
        // Trouver le corps du tableau (tbody)
        const tbody = table.querySelector('tbody');
        // Trier les lignes du tableau
        Array.from(tbody.querySelectorAll('tr'))
            .sort(comparer(Array.from(th.parentNode.children).indexOf(th), this.asc = !this.asc))
            // Réorganiser les lignes dans le tbody
            .forEach(tr => tbody.appendChild(tr));
    })));
});
