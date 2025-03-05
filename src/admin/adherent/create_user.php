<?php

require_once '../db.php'; // Essaye ce chemin si ton db.php est à la racine de /admin

if (!isset($pdo)) {
    die("Erreur : La connexion à la base de données n'est pas établie.");
}


// Fonction pour générer un mot de passe temporaire
function genererMotDePasse($length = 10) {
    return substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, $length);
}

$successMessage = "";
$errorMessage = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = trim($_POST['nom']);
    $email = trim($_POST['email']);
    
    // Vérifier si l'email est déjà utilisé
    $checkStmt = $pdo->prepare("SELECT id_adherent FROM adherent WHERE email = ?");
    $checkStmt->execute([$email]);

    if ($checkStmt->rowCount() > 0) {
        $errorMessage = "Cet email est déjà utilisé.";
    } else {
        $mdp_temp = genererMotDePasse(8);
        $mdp_hash = password_hash($mdp_temp, PASSWORD_DEFAULT);

        try {
            // Insérer l'adhérent dans la base de données
            $stmt = $pdo->prepare("INSERT INTO adherent (nom, email, mot_de_passe, mdp_temporaire) VALUES (?, ?, ?, 1)");
            $stmt->execute([$nom, $email, $mdp_hash]);

            // Envoi de l'email
            $sujet = "Votre compte Creating Form";
            $message = "Bonjour $nom,\n\nVotre compte a été créé.\n\n📌 **Identifiants temporaires** :\n📧 Email : $email\n🔑 Mot de passe : $mdp_temp\n\n✅ Merci de vous connecter et de modifier votre mot de passe.\n\nCreating Form";
            $headers = "From: no-reply@creatingform.com\r\n" .
                       "Reply-To: no-reply@creatingform.com\r\n" .
                       "Content-Type: text/plain; charset=UTF-8\r\n";

            if (mail($email, $sujet, $message, $headers)) {
                $successMessage = "Compte créé et email envoyé.";
            } else {
                $errorMessage = "Compte créé, mais l'email n'a pas pu être envoyé.";
            }
        } catch (PDOException $e) {
            $errorMessage = "Erreur : " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription Adhérent</title>
    <link rel="stylesheet" href="../style.css"> <!-- Ajoute ton CSS ici -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form-container {
            width: 350px;
            background: white;
            padding: 20px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            font-size: 22px;
            color: #333;
        }

        input {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            width: 90%;
            padding: 12px;
            background: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
            margin: 20px;
        }

        button:hover {
            background: #2980b9;
        }

        .back-link {
            display: block;
            margin-top: 15px;
            color: #3498db;
            text-decoration: none;
            font-weight: bold;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        .success {
            color: green;
            font-weight: bold;
            margin-top: 10px;
        }

        .error {
            color: red;
            font-weight: bold;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Inscrire un nouvel adhérent</h2>

    <?php if (!empty($successMessage)) { echo "<p class='success'>$successMessage</p>"; } ?>
    <?php if (!empty($errorMessage)) { echo "<p class='error'>$errorMessage</p>"; } ?>

    <form action="create_user.php" method="post">
        <input type="text" name="nom" placeholder="Nom" required>
        <input type="email" name="email" placeholder="Email" required>
        <button type="submit">Créer le compte</button>
    </form>

    <a href="../administrateur/admin.php" class="back-link">Retour au tableau de bord</a>
</div>

</body>
</html>
