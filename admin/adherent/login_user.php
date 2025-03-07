<?php
session_start();
include('../administrateur/config.php');

require_once '../db.php'; 
require_once '../../layouts/header.php'; 


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
                header("Location: ../admin/adherent/change_password.php");
                exit();
                
            }
            header("Location: ../../pages/tdb.php");
            exit();
        } else {
            $error = "Identifiants incorrects.";
        }
    } catch (PDOException $e) {
        $error = "Erreur : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion à votre espace personnel</title>
    <link rel="stylesheet" href="../../styles/style.css"> 
    <style>


        .login-container {
            max-width: 400px;
            margin: 50px auto;
            text-align: center;
            background: #0d0d0d;
            padding: 20px;
            border-radius: 8px;
        }

        .login-form input {
            width: 93%;
            padding: 15px;
            margin: 10px 0px;
            border: none;
            border-radius: 5px;
            background: #1e1e1e;
            color: white;
            font-size: small;
        }

        .login-form .forgot-password {
            font-size: 14px;
            text-decoration: none;
            display: block;
            margin-bottom: 20px;
        }

        .btn-connexion {
            background: linear-gradient(45deg, #df3e3f, #e55a1c);
            color: white;
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 10px 0px;
        }

        .btn-connexion:hover {
            background: linear-gradient(45deg,rgb(165, 50, 50),rgb(172, 78, 34));
        }

    </style>
</head>
<body>

<div class="login-container">
    <h2>Connexion à votre espace personnel</h2>

    <?php if (isset($error)) : ?>
        <p class="error-message"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form action="login_user.php" method="post" class="login-form">
       
        <input type="email" name="email" placeholder="Nom d'utilisateur" required>
        <input type="password" name="mot_de_passe" placeholder="Mot de passe" required>

        <a href="/creating_form/src/admin/adherent/change_password.php" class="forgot-password">Pas de mot de passe ? Créez-le ici.</a>

        <button type="submit" class="btn-connexion">Se connecter</button>
    </form>
</div>

<?php require_once '../../layouts/footer.php'; ?> 

</body>
</html>
