function afficherErreur(message) {
    if (message) {
        Swal.fire({
            icon: 'error',
            title: 'Erreur',
            text: message,
        });
    }
}
