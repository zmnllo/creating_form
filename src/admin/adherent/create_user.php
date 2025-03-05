<?php
require_once 'db.php';

function genererMotDePasse($length = 10) {
    return substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, $length);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = trim($_POST['nom']);
    $email = trim($_POST['email']);
    $mdp_temp = genererMotDePasse(8);
    $mdp_hash = password_hash($mdp_temp, PASSWORD_DEFAULT);

    try {
        $stmt = $pdo->prepare("INSERT INTO adherent (nom, email, mot_de_passe, mdp_temporaire) VALUES (?, ?, ?, 1)");
        $stmt->execute([$nom, $email, $mdp_hash]);

        $sujet = "Votre compte Creating Form";
        $message = "Bonjour $nom,\n\nVotre compte a été créé. Voici vos identifiants temporaires :\nEmail : $email\nMot de passe : $mdp_temp\n\nMerci de vous connecter et de modifier votre mot de passe.";
        mail($email, $sujet, $message, "From: no-reply@creatingform.com");

        echo "Compte créé et email envoyé.";
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
    <title>Inscription Adhérent</title>
</head>
<body>
    <h2>Inscrire un nouvel adhérent</h2>
    <form action="create_user.php" method="post">
        <label for="nom">Nom :</label>
        <input type="text" name="nom" required><br>

        <label for="email">Email :</label>
        <input type="email" name="email" required><br>

        <button type="submit">Créer le compte</button>
    </form>
</body>
</html>
