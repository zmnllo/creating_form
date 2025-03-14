<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../administrateur/config.php';
                                    
$id_objectif = filter_input(INPUT_GET, 'id_objectif', FILTER_VALIDATE_INT);

if (!$id_objectif) {
    header("Location: objectifs.php?error=suppression");
    exit();
}

$query = "DELETE FROM objectif WHERE id_objectif = :id_objectif";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':id_objectif', $id_objectif, PDO::PARAM_INT);

if ($stmt->execute()) {
    header("Location: objectifs.php?success=suppression");
    exit();
} else {
    header("Location: objectifs.php?error=suppression");
    exit();
}
?>
