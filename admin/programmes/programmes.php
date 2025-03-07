<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../administrateur/config.php';

// Requête pour récupérer tous les programmes avec leur objectif, niveau et exercices
$query = "SELECT 
    p.id_programme, p.nom_programme, 
    o.nom_objectif, 
    n.nom_niveau,
    e.id_exercice, e.repetitions, e.temps, 
    et.nom_exercice
FROM programme p
LEFT JOIN objectif o ON p.id_objectif = o.id_objectif
LEFT JOIN niveau n ON p.id_niveau = n.id_niveau
LEFT JOIN exercice e ON p.id_programme = e.id_programme
LEFT JOIN exercice_type et ON e.id_exercice_type = et.id_exercice_type
ORDER BY p.id_programme, e.id_exercice";

$stmt = $pdo->prepare($query);
$stmt->execute();
$programmes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Organisation des programmes pour affichage
$programmeData = [];

foreach ($programmes as $prog) {
    $id_programme = $prog['id_programme'];

    if (!isset($programmeData[$id_programme])) {
        $programmeData[$id_programme] = [
            'nom_programme' => $prog['nom_programme'],
            'nom_objectif' => $prog['nom_objectif'],
            'nom_niveau' => $prog['nom_niveau'],
            'exercices' => []
        ];
    }

    if (!empty($prog['nom_exercice'])) {
        $programmeData[$id_programme]['exercices'][] = [
            'id_exercice' => $prog['id_exercice'],
            'nom_exercice' => $prog['nom_exercice'],
            'repetitions' => $prog['repetitions'] ?? '-',
            'temps' => $prog['temps'] ?? '-'
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Programmes</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; }
        table { width: 80%; margin: auto; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid black; padding: 10px; text-align: center; }
        th { background-color: #f4f4f4; }
        .edit-btn { 
            background-color: #3498db; 
            color: white; 
            padding: 5px 10px; 
            text-decoration: none; 
            border-radius: 5px;
        }
        .edit-btn:hover { background-color: #2980b9; }
    </style>
</head>
<body>

<h1>Liste des Programmes</h1>

<table>
    <tr>
        <th>Nom du Programme</th>
        <th>Objectif</th>
        <th>Niveau</th>
        <th>Exercices</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($programmeData as $id_programme => $programme) : ?>
        <tr>
            <td><?= htmlspecialchars($programme['nom_programme']) ?></td>
            <td><?= htmlspecialchars($programme['nom_objectif']) ?></td>
            <td><?= htmlspecialchars($programme['nom_niveau']) ?></td>
            <td>
                <?php if (!empty($programme['exercices'])) : ?>
                    <ul>
                        <?php foreach ($programme['exercices'] as $exercice) : ?>
                            <li>
                                <?= htmlspecialchars($exercice['nom_exercice']) ?> 
                                (<?= htmlspecialchars($exercice['repetitions']) ?> répétitions / <?= htmlspecialchars($exercice['temps']) ?> sec)
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else : ?>
                    Aucun exercice
                <?php endif; ?>
            </td>
            <td>
                <a href="modifier_programme.php?id_programme=<?= $id_programme ?>" class="edit-btn">Modifier</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
