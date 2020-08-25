<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="Robin DE MARCH, Ali SYED & Philippe PERECHODOV">
  <title>GRAP.fr - Games by R, A & P</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <!-- Fontawsome -->
  <script src="https://kit.fontawesome.com/fbdd9c8340.js" crossorigin="anonymous"></script>

  <!-- Style CSS -->
  <link rel="stylesheet" type="text/css" href="style.css">

</head>


<body>
<div class="layer">

<!-- Connection à la base de donnée (Début)-->
  <?php
  try {
    $bdd = new PDO('mysql:host=localhost;dbname=catalogueacs;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  }
    catch(PDOException $e)
  {
    die('Ereur : '.$e->getMessage());
  }
  function debug($var, $style = "")
  {
    echo "<pre style='background-color: white; border: gray 1px solid; -webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px; color: black; width: 95%; padding: 10px; overflow-y: auto;{$style}'>";
    var_dump($var);
    echo "</pre>";
  }
  ?>
<!-- Connection à la base de donnée (Fin)-->

<!-- Pour afficher les informations de l'entrée de la table "jeux" séléctionnée par le bouton "Modifier" de la page "admin.php" (Début)-->
  <?php
  if (isset($_GET['idSelect'])) {
    $select_Ent_Jeux = $bdd->prepare('SELECT id, Titre, Description FROM jeux WHERE id = :idSelect');
    $select_Ent_Jeux->execute(array(':idSelect'=>$_GET['idSelect']));
    $row_idSelect = $select_Ent_Jeux->fetch();
  }
  ?>
<!-- Pour afficher les informations de l'entrée de la table "jeux" séléctionnée par le bouton "Modifier" de la page "admin.php" (Fin)-->

<!-- Fonction de connexion avec login (Début) -->
<?php
// On prolonge la session sauf sur la page admin.php car la vérif de la session se fait avant l'include du header.php
  if (!stripos($_SERVER['PHP_SELF'], 'admin.php')) {
    session_start();
  }

  // On teste si la variable de session existe et contient une valeur
  if(!isset($_SESSION['login']))
  {
    // Si inexistante ou nulle, affiche message de base + lien pour la page de login avec le message "Se connecter"
    $client = " visiteur(euse)";
    $connexion = "<i class=\"fas fa-headset\"></i> Se connecter à mon compte";
    $goLog = "login";
    $admin = "";
  }
  else {
    // Si existante, affiche message personnalisé + lien pour la page de logout avec le message "Se déconnecter"
    $client = $_SESSION['prenom'] . " " . $_SESSION['nom'];
    $connexion = "<i class=\"fas fa-ghost\"></i> Me déconnecter";
    $goLog = "logout";

    if ($_SESSION['admin']) {
      // Affiche le lien vers la page d'administration
      $admin = "<i class=\"fas fa-chess-king\"></i> Administration";
    }
    else {
      $admin = "";
    }
  }
  ?>
<!-- Fonction de connexion avec login (Fin) -->

<!-- Pour le changement de background du "body" à partir des lien d'image dans la base de donnée (Début) -->
  <?php
  if (stripos($_SERVER['PHP_SELF'], 'produit.php')) {
    $produitBG = htmlentities($_GET['idSelect']);

    $imageSelected = $bdd->query('SELECT lien AS lienBG FROM background WHERE id_jeu ="' . $produitBG . '"');
    $imageResultat = $imageSelected->fetch();
    $lienImage = $imageResultat['lienBG'];
  }
  elseif (stripos($_SERVER['PHP_SELF'], '404.php')) {

    $lienImage = "";
  }
  else {
    // Pour avoir le nombre d'entrée dans la table "background"
    $nbrIdBG = $bdd->query("SELECT COUNT(id) AS nbrId FROM background");
    $resultat = $nbrIdBG->fetch();
    $nbMax = $resultat['nbrId'];

    // Le random avec, en nombre max, le nombre d'entrée déterminée
    $numero = rand(1, $nbMax);

    $imageSelected = $bdd->query("SELECT lien AS lienBG FROM background WHERE id='{$numero}'");
    $imageResultat = $imageSelected->fetch();
    $lienImage = $imageResultat['lienBG'];
  }
  ?>

  <style type="text/css">
    body {
     background-image: url("<?php echo $lienImage ?>");
     background-size: cover;
     background-position: center;
    }
  </style>
<!-- Pour le changement de background du "body" à partir des lien d'image dans la base de donnée (Fin) -->

<!-- Pour l'affichage du message de bienvenue sur l'index.php uniquement (Début) -->
  <?php
  if (stripos($_SERVER['PHP_SELF'], 'index.php')) {
    $bienvenue = '<div id="realisation" class="row justify-content-around py-2 align-items-center">
        <p class="mb-0"><i class="far fa-grin-alt"></i> Bienvenue sur GRAP.fr, ' . $client . ' !</p>
      </div>';
  }
  else {
    $bienvenue = null;
  }
  ?>
<!-- Pour l'affichage du message de bienvenue sur l'index.php uniquement (Fin) -->


<!-- Le HTML -->

  <nav id="navBarre" class="container-fluid fixed-top">
    <div class="row justify-content-around py-3 align-items-center">
      <a class="" href="admin.php"><?php echo $admin ?></a>

      <a id="clic" class="font-weight-bold" href="index.php"><img class="logo" src="img/icones/GRAP.fr.png" alt="Logo"><img class="logo" src="img/icones/GRAP.fr_inverse.png" alt="Logo">GRAP.fr</a>

      <form method="post" action="recherche.php">
        <input class="pl-3 search-txt" type="search" name="jeux" placeholder="Indiquez le jeux recherché">
        <button type="submit" class="btn-search"><i id="loupe" class="fas fa-search"></i></button>
      </form>
      <a href="<?php echo $goLog ?>.php"><?php echo $connexion ?></a>
      <a href="panier.php"><i class="fas fa-cart-arrow-down"></i> Mon Panier</a>
    </div>
    <?php
    echo $bienvenue;
    ?>

  </nav>
