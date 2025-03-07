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
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 50px;
            background: #f4f4f4;
        }
        .dashboard-container {
            width: 500px;
            margin: auto;
            padding: 20px;
            padding-bottom: 30px;
            border-radius: 10px;
            background: white;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            margin-bottom: 10px;
        }
        .welcome {
            font-size: 20px;
            margin-bottom: 20px;
        }
        .button-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
        }


        .button-in {
            padding: 12px;
            width: 80%;
            background: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
            font-size: 16px;
            font-weight: 500;
            transition: 0.3s;
        }
        .button-in:hover {
            background: #2980b9;
        }
        .logout-button {
            padding: 12px;
            background: #e74c3c;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            width: 80%;
            font-weight: 500;
        }
        .logout-button:hover {
            background: #c0392b;
        }
    </style>
</head>
<body>

<div class="dashboard-container">
    <h2>Tableau de bord</h2>
    <p class="welcome">Bienvenue, <strong><?= htmlspecialchars($adminUsername) ?></strong> !</p>

    <div class="button-container">
        <a href="../abonnements/abonnements.php" class="button-in">📌 Gérer les abonnements</a>
        <a href="../objectifs/objectifs.php" class="button-in">🎯 Gérer les objectifs</a>
        <a href="../programmes/programmes.php" class="button-in">📋 Gérer les programmes</a>
        <a href="../exercices/exercices.php" class="button-in">💪 Gérer les exercices</a>
        <a href="add_admin.php" class="button-in">🛠️ Gérer les admins</a> 
        <a href="../adherent/create_user.php" class="button-in">Créer un user</a>

        <a href="logout.php" class="logout-button">🚪 ME DÉCONNECTER</a>
    </div>

</div>

</body>
</html>
