document.addEventListener('DOMContentLoaded', (event) => {
    // Récupération des éléments nécessaires du DOM
    const deleteLinks = document.querySelectorAll('.delete-link');
    const deleteModal = document.getElementById('delete-modal');
    const confirmDeleteBtn = document.getElementById('confirm-delete');
    const cancelDeleteBtn = document.getElementById('cancel-delete');
    let selectedId;

    // Ajout d'écouteurs d'événements pour tous les liens de suppression
    deleteLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault(); // Empêche l'action par défaut du lien
            selectedId = e.target.getAttribute('data-id'); // Stocke l'ID de l'élément à supprimer
            deleteModal.style.display = 'flex'; // Affiche la boîte modale de confirmation de suppression
        });
    });

    // Gestion du clic sur le bouton de confirmation de suppression
    confirmDeleteBtn.addEventListener('click', () => {
        // Redirige vers l'URL de suppression avec l'ID de l'élément à supprimer
        window.location.href = `/projet-final-v2/delete_message?id=${selectedId}`;
    });

    // Gestion du clic sur le bouton d'annulation
    cancelDeleteBtn.addEventListener('click', () => {
        deleteModal.style.display = 'none'; // Ferme la boîte modale de confirmation de suppression
    });
});
