<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['adherent_id'])) {
    header("Location: login_user.php"); // Rediriger vers la connexion si non connecté
    exit();
}
?>
