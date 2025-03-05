<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../administrateur/config.php';

$successMessage = "";
$errorMessage = "";

if (isset($_GET['success']) && $_GET['success'] == 'ajout') {
    $successMessage = "Exercice ajouté avec succès.";
} elseif (isset($_GET['success']) && $_GET['success'] == 'modification') {
    $successMessage = "Exercice modifié avec succès.";
} elseif (isset($_GET['success']) && $_GET['success'] == 'suppression') {
    $successMessage = "Exercice supprimé avec succès.";
}

$query = "SELECT e.id_exercice, et.nom_exercice, e.repetitions, e.temps 
          FROM exercice e 
          JOIN exercice_type et ON e.id_exercice_type = et.id_exercice_type";
$stmt = $pdo->query($query);
$exercices = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des exercices</title>
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
        }
        .btn-accueil:hover {
            background: rgb(120, 32, 83);
        }
    </style>
</head>
<body>

<h1>Liste des exercices</h1>

<?php if (!empty($successMessage)) { echo "<p class='success'>$successMessage</p>"; } ?>
<?php if (!empty($errorMessage)) { echo "<p class='error'>$errorMessage</p>"; } ?>

<table>
    <tr>
        <th>Exercice</th>
        <th>Répétitions</th>
        <th>Temps</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($exercices as $exercice) { ?>
        <tr>
            <td><?= htmlspecialchars($exercice['nom_exercice']) ?></td>
            <td><?= htmlspecialchars($exercice['repetitions'] ?? '-') ?></td>
            <td><?= htmlspecialchars($exercice['temps'] ?? '-') ?></td>
            <td class="actions">
                <a class="edit" href="modifier_exercice.php?id_exercice=<?= $exercice['id_exercice'] ?>">Modifier</a>
                <a class="delete" href="supprimer_exercice.php?id_exercice=<?= $exercice['id_exercice'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet exercice ?')">Supprimer</a>
            </td>
        </tr>
    <?php } ?>
</table>

<br>
<a href="ajouter_exercice.php" class="add-button">+ Ajouter un exercice</a>

<a href="../administrateur/admin.php" class="btn-accueil">Retour au Tableau de bord</a>

</body>
</html>
