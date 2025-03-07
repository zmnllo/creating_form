<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once '../db.php'; 
require_once '../../layouts/header.php'; 




//if (!isset($_SESSION['adherent_id'])) {
    //header("Location: login_user.php");
    //exit();
//}

// Vérifier si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nouveau_mdp = $_POST['nouveau_mdp'];

    // Vérifier que le nouveau mot de passe n'est pas vide
    if (!empty($nouveau_mdp)) {
        $nouveau_mdp_hash = password_hash($nouveau_mdp, PASSWORD_DEFAULT);
        
        try {
            // Mettre à jour le mot de passe
            $stmt = $pdo->prepare("UPDATE adherent SET mot_de_passe = ?, mdp_temporaire = 0 WHERE id_adherent = ?");
            $stmt->execute([$nouveau_mdp_hash, $_SESSION['adherent_id']]);

            // Déconnection après modif du mdp
            session_destroy();
            header("Location: login_user.php?success=mdp_modifie");
            exit();
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    } else {
        echo "Le champ ne peut pas être vide.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier mon mot de passe</title>
    <link rel="stylesheet" href="../../styles/style.css"> 

    <style>
        .mdp-container {
            max-width: 400px;
            margin: 50px auto;
            text-align: center;
            background: #0d0d0d;
            padding: 20px;
            border-radius: 8px;
        }

        .mdp-form input {
            width: 93%;
            padding: 15px;
            margin: 10px 0px;
            border: none;
            border-radius: 5px;
            background: #1e1e1e;
            color: white;
            font-size: small;
        }

        .mdp-form .forgot-password {
            font-size: 14px;
            text-decoration: none;
            display: block;
            margin-bottom: 20px;
        }

        .btn-modifier {
            background: linear-gradient(45deg, #df3e3f, #e55a1c);
            color: white;
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 10px 0px;
        }

        .btn-modifier:hover {
            background: linear-gradient(45deg,rgb(165, 50, 50),rgb(172, 78, 34));
        }


    </style>
</head>
<body>


<div class="mdp-container">
    <h2>Modifier votre mot de passe</h2>
    <p>Vous utilisez actuellement un mot de passe temporaire. Veuillez le changer.</p>

    <form action="change_password.php" method="post" class="mdp-form">
        <input type="nouveau_mdp" name="nouveau_mdp" placeholder="Nouveau mot de passe :" required>
        <input type="confirmation" name="confirmation" placeholder="Confirmation du nouveau mot de passe" required>
        <button type="submit" class="btn-modifier">Modifier</button>
    </form>
</div>

<?php require_once '../../layouts/footer.php'; ?> 
 
</body>
</html>
