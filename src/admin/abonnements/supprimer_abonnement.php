<?php
require_once '../bdd.php'; // Connexion à la base de données

// Vérifier si un ID est passé dans l'URL
if (!isset($_GET['id_abonnement']) || empty($_GET['id_abonnement'])) {
    die("Aucun abonnement sélectionné.");
}

$id_abonnement = intval($_GET['id_abonnement']); // Sécurisation de l'ID

// Supprimer l'abonnement
$query = "DELETE FROM abonnement WHERE id_abonnement = :id_abonnement";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':id_abonnement', $id_abonnement, PDO::PARAM_INT);

if ($stmt->execute()) {
    echo "Abonnement supprimé avec succès ! <a href='abonnements.php'>Retour</a>";
} else {
    echo "Erreur lors de la suppression.";
}
?>
