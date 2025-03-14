<?php
session_start();

// Vérifier si l'admin est connecté
if (!isset($_SESSION['admin'])) {
    header("Location: login.php"); 
    exit();
}

$adminUsername = $_SESSION['admin']; 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap');
        body {
            font-family: Montserrat;
            text-align: center;
            margin-top: 50px;
            background:#0D0D0D;
        }
        .dashboard-container {
            width: 500px;
            margin: auto;
            padding: 20px;
            padding-bottom: 30px;
            border-radius: 10px;
            background: radial-gradient(circle, #2B3C43, #1E2A2F);
        }
        h2 {
            margin-bottom: 10px;
        }
        .welcome {
            font-size: 20px;
            margin-bottom: 20px;
            color: #ebebeb;
        }
        .button-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
            font-family: 'Roboto Condensed', sans-serif;

        }


        .button-in {
            padding: 12px;
            width: 80%;
            background: linear-gradient(180deg, #df3e3f, #e55a1c);
            color: #ebebeb;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
            font-size: 16px;
            font-weight: 500;
            transition: 0.3s;
        }
        .button-in:hover {
            background: linear-gradient(180deg,rgb(173, 53, 53),rgb(182, 75, 26));
        }
        .logout-button {
            padding: 12px;
            background:rgb(113, 14, 14);
            color: white;
            text-decoration: none;
            border-radius: 5px;
            width: 80%;
            font-weight: 500;
        }
        .logout-button:hover {
            background:rgb(78, 17, 17);
        }
        
    </style>
</head>
<body>

<div class="dashboard-container">
    <h2 class="welcome">Tableau de bord</h2>
    <p class="welcome">Bienvenue, <strong><?= htmlspecialchars($adminUsername) ?></strong> !</p>

    <div class="button-container">
        <a href="../abonnements/abonnements.php" class="button-in">GÉRER LES ABONNEMENTS</a>
        <a href="../objectifs/objectifs.php" class="button-in">GÉRER LES OBJECTIFS</a>
        <a href="../programmes/programmes.php" class="button-in">GÉRER LES PROGRAMMES</a>
        <a href="../exercices/exercices.php" class="button-in">GÉRER LES EXERCICES</a>
        <a href="add_admin.php" class="button-in">GÉRER LES ADMINS</a> 
        <a href="../adherent/create_user.php" class="button-in">CRÉER UN USER</a>

        <a href="logout.php" class="logout-button">ME DÉCONNECTER</a>
    </div>

</div>

</body>
</html>
