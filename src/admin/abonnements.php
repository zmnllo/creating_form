<?php
include '../admin/bdd.php';

$query = $pdo->query("SELECT * FROM abonnement");
$abonnements = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des abonnements</title>
</head>
<body>
    <h1>Liste des abonnements</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prix (€)</th>
            <th>Durée (mois)</th>
        </tr>
        <?php foreach ($abonnements as $abonnement): ?>
        <tr>
            <td><?= $abonnement['id_abonnement'] ?></td>
            <td><?= $abonnement['nom_abonnement'] ?></td>
            <td><?= $abonnement['prix_abonnement'] ?></td>
            <!-- <td><?= $abonnement['duree'] ?></td> -->
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
