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
        body { font-family: Arial, sans-serif; text-align: center; }
        table { width: 80%; margin: auto; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid black; padding: 10px; text-align: center; }
        th { background-color: #f4f4f4; }
        .success { color: green; font-weight: bold; }
        .error { color: red; font-weight: bold; }
        .actions a { margin: 0 5px; padding: 5px 10px; border-radius: 5px; text-decoration: none; }
        .edit { background-color: #3498db; color: white; }
        .edit:hover {
            background: #2980b9;
        }
        .delete { background-color: #e74c3c; color: white; }
        .delete:hover {
            background: #c0392b;
        }
        .add-button { display: inline-block; margin-top: 20px; padding: 10px 15px; background-color: #2ecc71; color: white; text-decoration: none; border-radius: 5px; }
        .add-button:hover {
            background-color:rgb(48, 146, 89);
        }
        .btn-accueil { 
            background-color:rgb(220, 28, 140); 
            padding : 10px; 
            text-decoration: none; 
            color: white;
            border-radius: 5px;
            font-w
        }
        .btn-accueil:hover {
            background: rgb(120, 32, 83);
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
    <a href="ajouter_abonnement.php" class="add-button">Ajouter un Abonnement</a>


    <a href="../administrateur/admin.php" class="btn-accueil">Retour au Tableau de bord</a>


</body>
</html>
