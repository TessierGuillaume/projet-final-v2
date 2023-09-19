document.addEventListener('DOMContentLoaded', (event) => {
    const deleteLinks = document.querySelectorAll('.delete-link');
    const deleteModal = document.getElementById('delete-modal');
    const confirmDeleteBtn = document.getElementById('confirm-delete');
    const cancelDeleteBtn = document.getElementById('cancel-delete');
    let selectedId;

    deleteLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            selectedId = e.target.getAttribute('data-id');
            deleteModal.style.display = 'flex';
        });
    });

    confirmDeleteBtn.addEventListener('click', () => {
        window.location.href = `/projet-final-v2/delete_user?id=${selectedId}`;
    });

    cancelDeleteBtn.addEventListener('click', () => {
        deleteModal.style.display = 'none';
    });
});
