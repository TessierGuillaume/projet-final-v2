function checkFileSize(input) {
    const maxFileSize = 2 * 1024 * 1024; // 2 MB en octets
    const files = input.files;

    for (let i = 0; i < files.length; i++) {
        if (files[i].size > maxFileSize) {
            alert("Le fichier est trop gros.");
            input.value = ""; // Effacer les fichiers sélectionnés
            return;
        }
    }
}