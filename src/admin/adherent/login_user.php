<?php
session_start();
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email']);
    $mot_de_passe = $_POST['mot_de_passe'];

    try {
        $stmt = $pdo->prepare("SELECT * FROM adherent WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($mot_de_passe, $user['mot_de_passe'])) {
            $_SESSION['adherent_id'] = $user['id'];
            $_SESSION['nom'] = $user['nom'];

            if ($user['mdp_temporaire'] == 1) {
                header("Location: change_password.php");
                exit();
            }
            header("Location: tdb.php");
            exit();
        } else {
            echo "Identifiants incorrects.";
        }
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
    <title>Connexion</title>
</head>
<body>
    <h2>Connexion</h2>
    <form action="login_user.php" method="post">
        <label for="email">Email :</label>
        <input type="email" name="email" required><br>

        <label for="mot_de_passe">Mot de passe :</label>
        <input type="password" name="mot_de_passe" required><br>

        <button type="submit">Se connecter</button>
    </form>
</body>
</html>

