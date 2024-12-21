function afficherErreur(message) {
    if (message) {
        Swal.fire({
            icon: 'error',
            title: 'Erreur de connexion',
            text: message,
        });
    }
}
