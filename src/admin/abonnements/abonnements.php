<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../bdd.php';

// Vérifier s'il y a un message après une action
$successMessage = "";
$errorMessage = "";

if (isset($_GET['success']) && $_GET['success'] == 'suppression') {
    $successMessage = "Abonnement supprimé avec succès.";
} elseif (isset($_GET['error']) && $_GET['error'] == 'suppression') {
    $errorMessage = "Erreur lors de la suppression.";
}

$query = $pdo->query("SELECT * FROM abonnement");
$abonnements = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des abonnements</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; }
        table { width: 80%; margin: auto; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid black; padding: 10px; text-align: center; }
        th { background-color: #f4f4f4; }
        .success { color: green; font-weight: bold; }
        .error { color: red; font-weight: bold; }
        .actions a { margin: 0 5px; padding: 5px 10px; border-radius: 5px; text-decoration: none; }
        .edit { background-color: #3498db; color: white; }
        .delete { background-color: #e74c3c; color: white; }
        .add-button { display: inline-block; margin-top: 20px; padding: 10px 15px; background-color: #2ecc71; color: white; text-decoration: none; border-radius: 5px; }
    </style>
</head>
<body>
<?php
if (isset($_GET['success']) && $_GET['success'] == 'ajout') {
    echo "<p class='success'>Abonnement ajouté avec succès.</p>";
}
?>

    <h1>Liste des abonnements</h1>

    <!-- Affichage des messages de confirmation -->
    <?php if (!empty($successMessage)) { echo "<p class='success'>$successMessage</p>"; } ?>
    <?php if (!empty($errorMessage)) { echo "<p class='error'>$errorMessage</p>"; } ?>

    <table>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prix (€)</th>
            <th>Durée</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($abonnements as $abonnement) { ?>
            <tr>
                <td><?= htmlspecialchars($abonnement['id_abonnement']) ?></td>
                <td><?= htmlspecialchars($abonnement['nom_abonnement']) ?></td>
                <td><?= number_format($abonnement['prix_abonnement']) ?> €</td>
                <td>1 an</td>
                <td class="actions">
                    <a class="edit" href="modifier_abonnement.php?id_abonnement=<?= $abonnement['id_abonnement'] ?>">Modifier</a>
                    <a class="delete" href="supprimer_abonnement.php?id_abonnement=<?= $abonnement['id_abonnement'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet abonnement ?')">Supprimer</a>
                </td>
            </tr>
        <?php } ?>
    </table>

    <br>
    <a href="ajouter_abonnement.php" class="add-button">+ Ajouter un abonnement</a>

</body>
</html>
