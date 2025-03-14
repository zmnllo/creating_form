<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../administrateur/config.php';


// Initialisation des messages
$successMessage = "";
$errorMessage = "";

// Vérifier les messages passés via GET
$successType = filter_input(INPUT_GET, 'success', FILTER_DEFAULT);
$errorType = filter_input(INPUT_GET, 'error', FILTER_DEFAULT);

switch ($successType) {
    case 'ajout':
        $successMessage = "Abonnement ajouté avec succès.";
        break;
    case 'modification':
        $successMessage = "Abonnement modifié avec succès.";
        break;
    case 'suppression':
        $successMessage = "Abonnement supprimé avec succès.";
        break;
}

switch ($errorType) {
    case 'suppression':
        $errorMessage = "Erreur lors de la suppression.";
        break;
}

// Récupérer tous les abonnements
$query = $pdo->query("SELECT * FROM abonnement");
$abonnements = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Abonnements</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap');
        body { font-family: Montserrat; text-align: center; background:#0D0D0D; color: #ebebeb;}
        table { width: 80%; margin: auto; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #232323; padding: 10px; text-align: center; }
        th { background-color: #232323; }
        .success { color: green; font-weight: bold; }
        .error { color: red; font-weight: bold; }
        .actions a { margin: 0 5px; padding: 5px 10px; border-radius: 5px; text-decoration: none; }
        .edit { background-color:rgb(107, 125, 207); color: white; }
        .edit:hover {
            background:rgb(71, 84, 142);
        }
        .delete { background-color:rgb(181, 74, 74); color: white; }
        .delete:hover {
            background:rgb(121, 48, 48);
        }
        .add-button { display: inline-block; margin-top: 20px; padding: 10px 15px; background-color:rgb(46, 169, 70); color: white; text-decoration: none; border-radius: 5px; }
        .add-button:hover {
            background-color:rgb(38, 113, 53);
        }
        .btn-accueil { 
            display: block;
            margin-top: 15px;
            color: #3498db;
            text-decoration: none;
            font-weight: bold; 
        }
        .btn-accueil:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <h1>Liste des Abonnements</h1>

    <!-- Affichage des messages -->
    <?php if (!empty($successMessage)) : ?>
        <p class="success"><?= $successMessage ?></p>
    <?php endif; ?>

    <?php if (!empty($errorMessage)) : ?>
        <p class="error"><?= $errorMessage ?></p>
    <?php endif; ?>

    <table>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prix (€)</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($abonnements as $abonnement) : ?>
            <tr>
                <td><?= htmlspecialchars($abonnement['id_abonnement']) ?></td>
                <td><?= htmlspecialchars($abonnement['nom_abonnement']) ?></td>
                <td><?= number_format($abonnement['prix_abonnement'], 0, ',', ' ') ?> €</td>
                <td class="actions">
                    <a class="edit" href="modifier_abonnement.php?id_abonnement=<?= $abonnement['id_abonnement'] ?>">Modifier</a>
                    <a class="delete" href="supprimer_abonnement.php?id_abonnement=<?= $abonnement['id_abonnement'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet abonnement ?')">Supprimer</a>
                </td>
            </tr>

        <?php endforeach; ?>
    </table>

    <br>
    <a href="ajouter_abonnement.php" class="add-button">+ Ajouter un Abonnement</a>


    <a href="../administrateur/admin.php" class="btn-accueil">Retour</a>


</body>
</html>
