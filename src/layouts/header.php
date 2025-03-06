<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Creating Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/creating_form/src/styles/style.css"/>
</head>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Roboto+Condensed:wght@400;700&display=swap" rel="stylesheet">
<script src="/creating_form/src/javascript/menu.js"></script>

<style>
    html {
    scroll-behavior: smooth;
}

</style>

<body>
<header>
    <div class="header">
        <div class="logo">
            <img src="/creating_form/src/assets/creatingform.webp" alt="Logo">
        </div>

        <div class="burger-menu">
            <a class="burger-button" aria-label="Menu">
                <i class="bi bi-list"></i>
            </a>
        </div>
    </div>
    <nav class="menu">
        <ul>
            <li><a href="/creating_form/src/pages/index.php">ACCUEIL</a></li>
            <li><a href="../pages/index.php#tarif">TARIFS</a></li>
            <li><a href="../pages/index.php#contact">CONTACT</a></li>

            <?php if (!isset($_SESSION['adherent_id'])): ?>
                <li><a href="/creating_form/src/admin/adherent/login_user.php">ME CONNECTER</a></li>
            <?php else: ?>
                <li><a href="../pages/tdb.php">TABLEAU DE BORD</a></li>
                <li><a href="../pages/entrainement.php">ENTRAÎNEMENTS</a></li>
                <li><a href="../pages/nutrition.php">NUTRITION</a></li>
                <li><a href="../admin/adherent/change_password.php">MODIFIER MES INFORMATIONS</a></li>
                <li><a href="../admin/adherent/logout_user.php">ME DÉCONNECTER</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
<main>
