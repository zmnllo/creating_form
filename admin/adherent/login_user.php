<?php
session_start();
include '../administrateur/config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email']); 
    $mot_de_passe = $_POST['mot_de_passe'];
    
    try {
        $requet = "SELECT * FROM adherent WHERE email = :email";
        $stmt = $pdo->prepare($requet);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user && $mot_de_passe === $user['mot_de_passe']) {
            $_SESSION['adherent_id'] = $user['id_adherent'];
            $_SESSION['nom'] = $user['nom'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['mdp_temporaire'] = $user['mdp_temporaire']; 

            if ($user['mdp_temporaire'] == 1) {
                $_SESSION['popup_mdp'] = true; 
                header("Location: change_password.php");
            } else {
                header("Location: ../../index.php");
            }
            exit();
        } else {
            $error = "Identifiants incorrects.";
        }
    } catch (PDOException $e) {
        $error = "Erreur : " . $e->getMessage();
    }
}


require_once '../../layouts/header.php'; 
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

        .password-container {
            position: relative;
            display: flex;
            align-items: center;
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

        .password-container input {
            width: 100%;
            padding-right: 40px;
        }

        .password-container i {
            position: absolute;
            right: 10px;
            cursor: pointer;
            color: gray;
        }

        .login-form .forgot-password {
            font-size: 14px;
            display: block;
            margin-bottom: 20px;
            margin-top: 10px;
            color: #ebebeb;
        }
        .forgot-password:hover {
            color: #3498db;
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

    <form method="post" class="login-form">
        <input type="email" name="email" placeholder="Nom d'utilisateur" required>

        <div class="password-container">
            <input type="password" id="mot_de_passe" name="mot_de_passe" placeholder="Mot de passe" required>
            <i class="bi bi-eye-slash" id="togglePassword"></i>
        </div>

        <a href="change_password.php" class="forgot-password">Pas de mot de passe ? Créez-le ici.</a>

        <button type="submit" class="btn-connexion">Se connecter</button>
    </form>
</div>

<?php require_once '../../layouts/footer.php'; ?> 

<script>
document.getElementById("togglePassword").addEventListener("click", function() {
    let passwordInput = document.getElementById("mot_de_passe");
    let icon = this;

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        icon.classList.remove("bi-eye-slash");
        icon.classList.add("bi-eye");
    } else {
        passwordInput.type = "password";
        icon.classList.remove("bi-eye");
        icon.classList.add("bi-eye-slash");
    }
});
</script>

</body>
</html>
