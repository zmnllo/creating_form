<?php
session_start();

require_once '../db.php'; 

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
    $nom = $_POST['nom'];
    $email = $_POST['email'];

    if (!$nom || !$email) {
        $errorMessage = "Veuillez remplir tous les champs correctement.";
    } else {
        // Vérifier si l'email est déjà utilisé
        $checkStmt = $pdo->prepare("SELECT id_adherent FROM adherent WHERE email = ?");
        $checkStmt->execute([$email]);

        if ($checkStmt->rowCount() > 0) {
            $errorMessage = "Cet email est déjà utilisé.";
        } else {
            $mdp_temp = genererMotDePasse(8); // Stocké en clair ⚠

            try {
                // Insérer l'adhérent dans la base de données
                $stmt = $pdo->prepare("INSERT INTO adherent (nom, email, mot_de_passe, mdp_temporaire) VALUES (?, ?, ?, 1)");
                $stmt->execute([$nom, $email, $mdp_temp]);

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
        @import url('https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap');
        body {
            font-family: Montserrat;
            background:#0D0D0D;            
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            width: 350px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            background: radial-gradient(circle, #2B3C43, #1E2A2F);  

        }

        h2 {
            margin-bottom: 20px;
            font-size: 22px;
            color: #ebebeb;
        }

        input {
            width: 90%;
            padding: 15px;
            margin: 10px 0;
            border-radius: 5px;
            border: 0px;
            background:rgba(13, 13, 13, 0.4);
            color: #ebebeb;
        }

        button {
            padding: 12px 50px;
            background: linear-gradient(180deg, #df3e3f, #e55a1c);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
            margin: 20px;
            font-family: Roboto Condensed;
            font-weight: 500;

        }

        button:hover {
            background: linear-gradient(180deg,rgb(173, 53, 53),rgb(182, 75, 26));
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

<div class="container">
    <h2>Inscrire un nouvel adhérent</h2>

    <?php if (!empty($successMessage)) { echo "<p class='success'>$successMessage</p>"; } ?>
    <?php if (!empty($errorMessage)) { echo "<p class='error'>$errorMessage</p>"; } ?>

    <form action="create_user.php" method="post">
        <input type="text" name="nom" placeholder="Nom" required>
        <input type="email" name="email" placeholder="Email" required>
        <button type="submit">CRÉER LE COMPTE</button>
    </form>

    <a href="../administrateur/admin.php" class="back-link">Retour</a>
</div>

</body>
</html>
