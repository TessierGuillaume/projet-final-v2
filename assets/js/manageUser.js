function openModal(action, userId) {
    document.getElementById("modalTitle").textContent = `Are you sure you want to ${action} this user?`;
    document.getElementById("confirmButton").textContent = action;
    document.getElementById("actionForm").action = `index.php?route=admin/${action.toLowerCase()}_user&id=${userId}`;
    document.getElementById("modal").style.display = "block";
  }
  
  function closeModal() {
    document.getElementById("modal").style.display = "none";
  }
  