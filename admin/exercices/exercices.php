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
        $successMessage = "Exercice ajouté avec succès.";
        break;
    case 'modification':
        $successMessage = "Exercice modifié avec succès.";
        break;
    case 'suppression':
        $successMessage = "Exercice supprimé avec succès.";
        break;
}

switch ($errorType) {
    case 'suppression':
        $errorMessage = "Erreur lors de la suppression.";
        break;
}

// Récupérer la liste des exercices existants
$query = $pdo->query("SELECT * FROM exercice_type ORDER BY nom_exercice ASC");
$exercices = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Exercices</title>
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

    <h1>Liste des Exercices</h1>

    <?php if (!empty($successMessage)) : ?>
        <p class="success"><?= $successMessage ?></p>
    <?php endif; ?>

    <?php if (!empty($errorMessage)) : ?>
        <p class="error"><?= $errorMessage ?></p>
    <?php endif; ?>

    <table>
        <tr>
            <th>ID</th>
            <th>Nom de l'exercice</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($exercices as $exercice) : ?>
            <tr>
                <td><?= htmlspecialchars($exercice['id_exercice_type']) ?></td>
                <td><?= htmlspecialchars($exercice['nom_exercice']) ?></td>
                <td class="actions">
                    <a class="edit" href="modifier_exercice.php?id_exercice_type=<?= $exercice['id_exercice_type'] ?>">Modifier</a>
                    <a class="delete" href="supprimer_exercice.php?id_exercice_type=<?= $exercice['id_exercice_type'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet exercice ?')">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <br>
    <a href="ajouter_exercice.php" class="add-button">+ Ajouter un Exercice</a>

    <a href="../administrateur/admin.php" class="btn-accueil">Retour</a>

</body>
</html>
