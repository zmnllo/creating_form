<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../administrateur/config.php';

// Récupérer tous les adhérents
$query = "SELECT a.id_adherent, a.nom, a.prenom, a.email, a.age, a.poids, a.taille, a.poids_ideal, o.nom_objectif
          FROM adherent a
          LEFT JOIN objectif o ON a.id_objectif = o.id_objectif
          ORDER BY a.id_adherent ASC";

$stmt = $pdo->prepare($query);
$stmt->execute();
$adherents = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Adhérents</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; }
        table { width: 90%; margin: auto; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid black; padding: 10px; text-align: center; }
        th { background-color: #f4f4f4; }
        .actions a { padding: 5px 10px; border-radius: 5px; text-decoration: none; }
        .edit { background-color: #3498db; color: white; }
        .edit:hover { background: #2980b9; }
        .delete { background-color: #e74c3c; color: white; }
        .delete:hover { background: #c0392b; }
        .btn-accueil { background-color: rgb(220, 28, 140); padding: 10px; text-decoration: none; color: white; border-radius: 5px; }
        .btn-accueil:hover { background: rgb(120, 32, 83); }
    </style>
</head>
<body>

    <h1>Gestion des Adhérents</h1>

    <table>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Âge</th>
            <th>Poids (kg)</th>
            <th>Taille (m)</th>
            <th>Poids Idéal (kg)</th>
            <th>Objectif</th>
            <th>Actions</th>
        </tr>

        <?php foreach ($adherents as $adherent) : ?>
            <tr>
                <td><?= htmlspecialchars($adherent['id_adherent']) ?></td>
                <td><?= htmlspecialchars($adherent['nom']) ?></td>
                <td><?= htmlspecialchars($adherent['prenom']) ?></td>
                <td><?= htmlspecialchars($adherent['email']) ?></td>
                <td><?= htmlspecialchars($adherent['age']) ?></td>
                <td><?= htmlspecialchars($adherent['poids']) ?></td>
                <td><?= htmlspecialchars($adherent['taille']) ?></td>
                <td><?= htmlspecialchars($adherent['poids_ideal']) ?></td>
                <td><?= htmlspecialchars($adherent['nom_objectif'] ?? 'Aucun') ?></td>
                <td class="actions">
                    <a class="edit" href="modifier_adherent.php?id_adherent=<?= $adherent['id_adherent'] ?>">Modifier</a>
                    <a class="delete" href="supprimer_adherent.php?id_adherent=<?= $adherent['id_adherent'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet adhérent ?')">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <br>
    <a href="../administrateur/admin.php" class="btn-accueil">Retour</a>

</body>
</html>
