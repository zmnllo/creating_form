<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../bdd.php'; // Connexion à la base de données

$pdo = require '../bdd.php';

// Vérifier si un ID est passé dans l'URL
if (!isset($_GET['id_abonnement']) || empty($_GET['id_abonnement'])) {
    die("Erreur : Aucun ID d'abonnement reçu.");
}

$id_abonnement = intval($_GET['id_abonnement']); // Sécuriser l'ID

// Récupérer les infos de l'abonnement sélectionné
$query = "SELECT * FROM abonnement WHERE id_abonnement = :id_abonnement";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':id_abonnement', $id_abonnement, PDO::PARAM_INT);
$stmt->execute();
$abonnement = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$abonnement) {
    die("Erreur : Abonnement introuvable.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Le formulaire a été soumis !<br>";

    // Vérifier si les champs sont bien remplis
    if (!empty($_POST['nom_abonnement']) && !empty($_POST['prix_abonnement'])) {
        $nom_abonnement = $_POST['nom_abonnement'];
        $prix_abonnement = $_POST['prix_abonnement'];

        // Mettre à jour l'abonnement en base de données
        $updateQuery = "UPDATE abonnement SET nom_abonnement = :nom_abonnement, prix_abonnement = :prix_abonnement WHERE id_abonnement = :id_abonnement";
        $stmt = $pdo->prepare($updateQuery);
        $stmt->bindParam(':nom_abonnement', $nom_abonnement, PDO::PARAM_STR);
        $stmt->bindParam(':prix_abonnement', $prix_abonnement, PDO::PARAM_STR);
        $stmt->bindParam(':id_abonnement', $id_abonnement, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo "Abonnement mis à jour avec succès ! <a href='abonnements.php'>Retour</a>";
        } else {
            echo "Erreur lors de la mise à jour.";
        }
    } else {
        echo "Tous les champs doivent être remplis.";
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un abonnement</title>
</head>
<body>

    <h2>Modifier l'abonnement</h2>

    <form method="post">
        <label>Nom :</label>
        <input type="text" name="nom_abonnement" value="<?= isset($abonnement['nom_abonnement']) ? htmlspecialchars($abonnement['nom_abonnement']) : '' ?>" required><br><br>

        <label>Prix (€) :</label>
        <input type="number" name="prix_abonnement" step="1" value="<?= isset($abonnement['prix_abonnement']) ? htmlspecialchars($abonnement['prix_abonnement']) : '' ?>" required><br><br>

        <input type="submit" value="Mettre à jour">
    </form>

    <br>
    <a href="abonnements.php">Annuler</a>

</body>
</html>


