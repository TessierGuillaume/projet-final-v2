
document.addEventListener('DOMContentLoaded', (event) => {
    // Obtenir tous les éléments de suppression et les boutons du modal
    const deleteLinks = document.querySelectorAll('.delete-link');
    const deleteModal = document.getElementById('delete-modal');
    const confirmDeleteBtn = document.getElementById('confirm-delete');
    const cancelDeleteBtn = document.getElementById('cancel-delete');
    let selectedId;

    // Ajouter un écouteur d'événement à chaque lien de suppression
    deleteLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            // Stocker l'ID de l'élément à supprimer
            selectedId = e.target.getAttribute('data-id');
            // Afficher le modal de suppression
            deleteModal.style.display = 'flex';
        });
    });

    // Confirmer la suppression en redirigeant vers l'URL de suppression appropriée
    confirmDeleteBtn.addEventListener('click', () => {
        window.location.href = `/projet-final-v2/delete_user?id=${selectedId}`;
    });

    // Annuler la suppression et fermer le modal
    cancelDeleteBtn.addEventListener('click', () => {
        deleteModal.style.display = 'none';
    });
});
