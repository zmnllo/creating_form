<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../administrateur/config.php';

// Vérifier si un ID d'abonnement est passé dans l'URL et le sécuriser
$id_abonnement = filter_input(INPUT_GET, 'id_abonnement', FILTER_VALIDATE_INT);

// Si l'ID n'est pas valide ou absent, rediriger vers la liste avec un message d'erreur
if (!$id_abonnement) {
    header("Location: abonnements.php?error=suppression");
    exit();
}

// Préparer la requête SQL pour supprimer l'abonnement correspondant
$query = "DELETE FROM abonnement WHERE id_abonnement = :id_abonnement";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':id_abonnement', $id_abonnement, PDO::PARAM_INT);

// Exécuter la requête et gérer la redirection en fonction du succès ou de l'échec
if ($stmt->execute()) {
    // Si la suppression réussit, rediriger vers `abonnements.php` avec un message de succès
    header("Location: abonnements.php?success=suppression");
    exit();
} else {
    // Si la suppression échoue, rediriger vers `abonnements.php` avec un message d'erreur
    header("Location: abonnements.php?error=suppression");
    exit();
}
?>
