<?php
include '../layouts/header.php';
?>

<section class="dashboard">
    <h1>Panneau d'Administration</h1>
    <p>Bienvenue dans l'interface d'administration de Creating Form.</p>

    <div class="dashboard_links">
        <a href="abonnements/abonnements.php" class="dashboard_button">📋 Gérer les Abonnements</a>
        <a href="objectifs/objectifs.php" class="dashboard_button">🎯 Gérer les Objectifs</a>
        <a href="../pages/index.php" class="dashboard_button">🏠 Retour au Site</a>
    </div>
</section>

<style>
    body { font-family: Arial, sans-serif; text-align: center; margin-top: 50px; }
    .dashboard h1 { font-size: 2em; margin-bottom: 10px; }
    .dashboard p { font-size: 1.2em; margin-bottom: 20px; }
    .dashboard_links { display: flex; justify-content: center; gap: 20px; margin-top: 20px; flex-wrap: wrap; }
    .dashboard_button {
        display: inline-block;
        padding: 15px 20px;
        background-color: #3498db;
        color: white;
        text-decoration: none;
        border-radius: 8px;
        font-size: 1.2em;
        font-weight: bold;
        transition: 0.3s;
    }
    .dashboard_button:hover {
        background-color: #2980b9;
    }
</style>

<?php include '../layouts/footer.php'; ?>
