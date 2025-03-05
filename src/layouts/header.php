<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Creating Form</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="../styles/style.css"/>
</head>
<link
  href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Roboto+Condensed:wght@400;700&display=swap"
  rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<script src="../javascript/menu.js"></script>

<body>
  <header>
    <div class="header">
      <div class="logo">
        <img src="../assets/creatingform.webp" alt="Logo">
      </div>

      <div class="burger-menu">
        <a class="burger-button" aria-label="Menu">
          <i class="bi bi-list"></i>
        </a>
      </div>
    </div>
    <nav class="menu">
      <ul>
        <li><a href="../pages/index.php">ACCUEIL</a></li>
        <li><a href="#tarif">TARIFS</a></li>
        <li><a href="#contact">CONTACT</a></li>

        <?php if (!isset($_SESSION['adherent_id'])): ?>
            <li><a href="../admin/administrateur/login_user.php">ME CONNECTER</a></li>
        <?php else: ?>
            <li><a href="../pages/tdb.php">TABLEAU DE BORD</a></li>
            <li><a href="entrainement.php">ENTRAÎNEMENTS</a></li>
            <li><a href="nutrition.php">NUTRITION</a></li>
            <li><a href="modifier_infos.php">MODIFIER MES INFORMATIONS</a></li>
            <li><a href="logout_user.php">ME DÉCONNECTER</a></li>
        <?php endif; ?>
      </ul>

 

    </nav>



  </header>
  <main>