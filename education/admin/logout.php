<?php
    // Démarre la session
    session_start();

    // Supprime la variable de session pour l'utilisateur
    unset($_SESSION['idA']);

    // Redirige l'utilisateur vers la page de connexion
    header('Location: index.php');
    exit;
?>
