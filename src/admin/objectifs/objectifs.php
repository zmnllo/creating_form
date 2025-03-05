<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../administrateur/config.php';

$successMessage = "";
$errorMessage = "";

$successType = filter_input(INPUT_GET, 'success', FILTER_DEFAULT);
$errorType = filter_input(INPUT_GET, 'error', FILTER_DEFAULT);

switch ($successType) {
    case 'ajout':
        $successMessage = "Objectif ajouté avec succès.";
        break;
    case 'modification':
        $successMessage = "Objectif modifié avec succès.";
        break;
    case 'suppression':
        $successMessage = "Objectif supprimé avec succès.";
        break;
}

switch ($errorType) {
    case 'suppression':
        $errorMessage = "Erreur lors de la suppression.";
        break;
}

$query = $pdo->query("SELECT * FROM objectif");
$objectifs = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Objectifs</title>
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
        }
        .btn-accueil:hover {
            background: rgb(120, 32, 83);
        }
    </style>
</head>
<body>

    <h1>Liste des Objectifs</h1>

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
            <th>Actions</th>
        </tr>
        <?php foreach ($objectifs as $objectif) : ?>
            <tr>
                <td><?= htmlspecialchars($objectif['id_objectif']) ?></td>
                <td><?= htmlspecialchars($objectif['nom_objectif']) ?></td>
                <td class="actions">
                    <a class="edit" href="modifier_objectif.php?id_objectif=<?= $objectif['id_objectif'] ?>">Modifier</a>
                    <a class="delete" href="supprimer_objectif.php?id_objectif=<?= $objectif['id_objectif'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet objectif ?')">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <br>
    <a href="ajouter_objectif.php" class="add-button">Ajouter un Objectif</a>

    <a href="../administrateur/admin.php" class="btn-accueil">Retour au Tableau de bord</a>

</body>
</html>
