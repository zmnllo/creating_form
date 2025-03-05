<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['adherent_id'])) {
    header("Location: login_user.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nouveau_mdp = password_hash($_POST['nouveau_mdp'], PASSWORD_DEFAULT);
    try {
        $stmt = $pdo->prepare("UPDATE adherent SET mot_de_passe = ?, mdp_temporaire = 0 WHERE id = ?");
        $stmt->execute([$nouveau_mdp, $_SESSION['adherent_id']]);

        session_destroy();
        header("Location: login_user.php");
        exit();
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier mon mot de passe</title>
</head>
<body>
    <h2>Modifier votre mot de passe</h2>
    <p>Vous utilisez actuellement un mot de passe temporaire. Veuillez le changer.</p>
    <form action="change_password.php" method="post">
        <label for="nouveau_mdp">Nouveau mot de passe :</label>
        <input type="password" name="nouveau_mdp" required><br>

        <button type="submit">Modifier</button>
    </form>
</body>
</html>

