<?php
  // On prolonge la session
  session_start();
  // On teste si la variable de session existe et contient une valeur
  if(!isset($_SESSION['login']))
  {
  // Si inexistante ou nulle, on redirige vers la page d'accueil
  header('Location: index.php');
  exit();
  }
  elseif (!$_SESSION['admin']) {
    header('Location: index.php');
    exit();
  }
  else {
    include "header.php";
?>

<!-- Le HTML -->

<main class="container-fluid py-5">

  <h1 class="text-center">Page d'administration du site</h1>
  <hr>

  <!-- Afficher le message de bienvenu -->
  <?php
    echo "<div class='alert alert-info text-center' role='alert'>Bonjour, " . $_SESSION['prenom'] . " " . $_SESSION['nom'] . " !</div>";
  ?>

  <!-- Liens pour retourner au site et pour se déconnecter de la session -->
  <hr>
  <div class="px-5 row justify-content-between">
    <a id="retour" href="index.php">Revenir au site</a>
    <a href="logout.php" class="text-danger">Déconnexion</a>
  </div>
  <hr>

  <!-- Pour faire une entrée dans la base donnée ou en modifier déjà une -->
  <h3 class="font-weight-bold text-center">Effectuer une nouvelle entrée dans la table "jeux" ou modifier une entrée existante :</h3>

  <?php
    // Pour faire une entrée dans la base donnée
    if (!isset($_GET['idSelect']) && !isset($row_idSelect) && !isset($_POST['Annuler']) && !empty($_POST['Titre'])) {
      try {
        $nvl_Ent_Jeux = $bdd->prepare('INSERT INTO jeux (Titre, Description, Prix, LienCover, Plateforme, DateSortie, BestSeller, NbrJoueur, Categorie, Special) VALUES (:Titre, :Description, :Prix, :LienCover, :Plateforme, :DateSortie, :BestSeller, :NbrJoueur, :Categorie, :Special)');
        $nvl_Ent_Jeux->execute(array(
          ':Titre' => $_POST['Titre'],
          ':Description' => nl2br($_POST['Description']),
          ':Prix' => $_POST['Prix'],
          ':LienCover' => $_POST['LienCover'],
          ':Plateforme' => $_POST['Plateforme'],
          ':DateSortie' => $_POST['DateSortie'],
          ':BestSeller' => $_POST['BestSeller'],
          ':NbrJoueur' => $_POST['NbrJoueur'],
          ':Categorie' => $_POST['Categorie'],
          ':Special' => $_POST['Special']
        ));
        header('Location: admin.php');
        exit();
      } catch (\Exception $e) {
        echo $e->getMessage();
      }
    }
    // Pour valider la modification dans la base de donnée de l'entrée sélectionnée
    elseif (isset($_GET['idSelect']) && isset($row_idSelect) && !isset($_POST['Annuler']) && !empty($_POST['Titre'])) {
      try {
        // $modif_Ent_Jeux = $bdd->prepare('UPDATE jeux SET Titre = :Titre, Description = :Description WHERE id = :idSelect');
        $modif_Ent_Jeux = $bdd->prepare('UPDATE jeux SET Titre = :Titre, Description = :Description, Prix = :Prix, LienCover = :LienCover, Plateforme = :Plateforme, DateSortie = :DateSortie, BestSeller = :BestSeller, NbrJoueur = :NbrJoueur, Categorie = :Categorie, Special = :Special WHERE id = :idSelect');
        $modif_Ent_Jeux->execute(array(
          ':Titre' => $_POST['Titre'],
          ':Description' => nl2br($_POST['Description']),
          ':Prix' => $_POST['Prix'],
          ':LienCover' => $_POST['LienCover'],
          ':Plateforme' => $_POST['Plateforme'],
          ':DateSortie' => $_POST['DateSortie'],
          ':BestSeller' => $_POST['BestSeller'],
          ':NbrJoueur' => $_POST['NbrJoueur'],
          ':Categorie' => $_POST['Categorie'],
          ':Special' => $_POST['Special'],          
          ':idSelect'=>$_GET['idSelect']
        ));
        header('Location: admin.php');
        exit();
      } catch (\Exception $e) {
        echo $e->getMessage();
      }
    }
    else {
      $echo_nvl_Ent_Jeux = "<p>Compléter tous les champs suivants pour créer une nouvelle entrée :</p>";
    }
  ?>

  <!-- Formulaire de saisie d'une ... -->
  <form action="" method="post">
    <?php

      $miseEnPage = '';

      // ... nouvelle entrée
      if (!isset($row_idSelect) || isset($_POST['Annuler'])) {
        echo $echo_nvl_Ent_Jeux;
        echo '<label for="Titre" class="col-sm-6 col-xl-2 text-xl-right">Titre :</label>
            <input type="text" name="Titre" value="" class="col-sm-12 col-xl-9 align-top border border-info mb-3" required>

            <label for="Description" class="col-sm-6 col-xl-2 text-xl-right">Description :</label>
            <textarea name="Description" rows="10" class="col-sm-12 col-xl-9 align-top border border-info mb-3"></textarea>

            <label for="Prix" class="col-sm-6 col-xl-2 text-xl-right">Prix :</label>
            <input type="text" name="Prix" value="" class="col-sm-12 col-xl-9 align-top border border-info mb-3">

            <label for="LienCover" class="col-sm-6 col-xl-2 text-xl-right">LienCover :</label>
            <input type="text" name="LienCover" value="" class="col-sm-12 col-xl-9 align-top border border-info mb-3">

            <label for="Plateforme" class="col-sm-6 col-xl-2 text-xl-right">Plateforme :</label>
            <input type="text" name="Plateforme" value="" class="col-sm-12 col-xl-9 align-top border border-info mb-3">

            <label for="DateSortie" class="col-sm-6 col-xl-2 text-xl-right">DateSortie :</label>
            <input type="text" name="DateSortie" value="" class="col-sm-12 col-xl-9 align-top border border-info mb-3">

            <label for="BestSeller" class="col-sm-6 col-xl-2 text-xl-right">BestSeller :</label>
            <input type="text" name="BestSeller" placeholder="0 = NON (par défaut) & 1 = OUI" value="" class="col-sm-12 col-xl-9 align-top border border-info mb-3">

            <label for="NbrJoueur" class="col-sm-6 col-xl-2 text-xl-right">NbrJoueur :</label>
            <input type="text" name="NbrJoueur" value="" class="col-sm-12 col-xl-9 align-top border border-info mb-3">

            <label for="Categorie" class="col-sm-6 col-xl-2 text-xl-right">Categorie :</label>
            <input type="text" name="Categorie" value="" class="col-sm-12 col-xl-9 align-top border border-info mb-3">

            <label for="Special" class="col-sm-6 col-xl-2 text-xl-right">Special :</label>
            <input type="text" name="Special" value="" class="col-sm-12 col-xl-9 align-top border border-info mb-3">

            <input type="submit" name="Creer" value="Créer la nouvelle entrée" class="offset-xl-2 col-sm-3 btn btn-info mt-2">';
      }
      else {
        // ... modification
        if (isset($row_idSelect)) {
        echo "<p>Compléter tous les champs suivants pour modifier l'entrée selectionnée :</p>";
        echo '<label for="Titre" class="col-sm-6 col-xl-2 text-xl-right">Titre :</label>
            <input type="text" name="Titre" value="' . $row_idSelect["Titre"] . '" class="col-sm-12 col-xl-9 align-top border border-info mb-3">

            <label for="Description" class="col-sm-6 col-xl-2 text-xl-right">Description :</label>
            <textarea name="Description" rows="10" class="col-sm-12 col-xl-9 align-top border border-info mb-3">' . $row_idSelect["Description"] . '</textarea>

            <label for="Prix" class="col-sm-6 col-xl-2 text-xl-right">Prix :</label>
            <input type="text" name="Prix" value="' . $row_idSelect["Prix"] . '" class="col-sm-12 col-xl-9 align-top border border-info mb-3">

            <label for="LienCover" class="col-sm-6 col-xl-2 text-xl-right">LienCover :</label>
            <input type="text" name="LienCover" value="' . $row_idSelect["LienCover"] . '" class="col-sm-12 col-xl-9 align-top border border-info mb-3">

            <label for="Plateforme" class="col-sm-6 col-xl-2 text-xl-right">Plateforme :</label>
            <input type="text" name="Plateforme" value="' . $row_idSelect["Plateforme"] . '" class="col-sm-12 col-xl-9 align-top border border-info mb-3">

            <label for="DateSortie" class="col-sm-6 col-xl-2 text-xl-right">DateSortie :</label>
            <input type="text" name="DateSortie" value="' . $row_idSelect["DateSortie"] . '" class="col-sm-12 col-xl-9 align-top border border-info mb-3">

            <label for="BestSeller" class="col-sm-6 col-xl-2 text-xl-right">BestSeller :</label>
            <input type="text" name="BestSeller" placeholder="0 = NON (par défaut) & 1 = OUI" value="' . $row_idSelect["BestSeller"] . '" class="col-sm-12 col-xl-9 align-top border border-info mb-3">

            <label for="NbrJoueur" class="col-sm-6 col-xl-2 text-xl-right">NbrJoueur :</label>
            <input type="text" name="NbrJoueur" value="' . $row_idSelect["NbrJoueur"] . '" class="col-sm-12 col-xl-9 align-top border border-info mb-3">

            <label for="Categorie" class="col-sm-6 col-xl-2 text-xl-right">Categorie :</label>
            <input type="text" name="Categorie" value="' . $row_idSelect["Categorie"] . '" class="col-sm-12 col-xl-9 align-top border border-info mb-3">

            <label for="Special" class="col-sm-6 col-xl-2 text-xl-right">Special :</label>
            <input type="text" name="Special" value="' . $row_idSelect["Special"] . '" class="col-sm-12 col-xl-9 align-top border border-info mb-3">

            <input type="submit" name="Modifier" value="Valider la modification" class="offset-lg-1 col-sm-2 btn btn-success mt-1">

            <input type="submit" name="Annuler" value="Annuler la modification" class="offset-lg-1 col-sm-2 btn btn-danger mt-1" >';
        } else {
          header('Location: admin.php');
          exit();
        }
      }
    ?>
  </form>
  <hr>

  <!-- Pour afficher toutes les entrées et les champs de la base de données -->
  <h3 class="font-weight-bold text-center">Contenu de la table "jeux" non archivé :</h3>
  <?php
    $sql = "SELECT * FROM jeux WHERE Archivage='0' ORDER BY id ASC";
    echo "<table class='table table-hover table-striped'>
            <thead>
              <tr>
                <th>id.</th>
                <th>Titre</th>
                <th>Prix</th>
                <th>Plateforme</th>
                <th>DateSortie</th>
                <th>BestSeller</th>
                <th>Categorie</th>
                <th>Special</th>
                <th>Modifier</th>
                <th>Archiver</th>
                <th>Supprimer</th>
              </tr>
            </thead>
            <tbody>";
    foreach ($bdd -> query($sql) as $row) {
      // Permet d'afficher "Non" au lieu de "0" et Oui au lieu de "1"
      if ($row['BestSeller']) {
        $bestSeller = "Oui";
      }
      else {
        $bestSeller = "Non";
      }

      echo "<tr id='adminDescription'>";
      echo "<td>" . $row['id'] . "</td>";
      echo "<td>" . $row['Titre'] . "</td>";
      echo "<td>" . $row['Prix'] . " €</td>";
      echo "<td>" . $row['Plateforme'] . "</td>";
      echo "<td>" . $row['DateSortie'] . "</td>";
      echo "<td>" . $bestSeller . "</td>";
      echo "<td>" . $row['Categorie'] . "</td>";
      echo "<td>" . $row['Special'] . "</td>";

      // Bouton pour modifier une entrée de la table "jeux"
      echo "<td><a href='admin.php?idSelect=" . $row['id'] . "' class='btn btn-info'>Détail / Modifier</a></td>";
      // Bouton "Archiver", voir la page "archive.php"
      echo "<td><a href='archive.php?idArchive=" . $row['id'] . "' class='btn btn-warning'>Archiver</a></td>";
      // Bouton "Supprimer", voir la page "suppr.php"
      echo "<td><a href='suppr.php?idSuppr=" . $row['id'] . "' class='btn btn-danger'>Supprimer</a></td>";
    }
    echo "</tr></tbody></table><hr>";
  ?>

  <!-- Pour afficher toutes les entrées de la base de données archivées -->
  <h3 class="font-weight-bold text-center">Contenu de la table "jeux" archivé :</h3>
  <?php
    $sql = "SELECT * FROM jeux WHERE Archivage='1' ORDER BY id ASC";
    echo "<table class='table table-hover table-striped'>
            <thead>
              <tr>
                <th>id.</th>
                <th>Titre</th>
                <th>LienCover</th>
                <th>Plateforme</th>
                <th>Categorie</th>
                <th>Désarchiver</th>
              </tr>
            </thead>
            <tbody>";
    foreach ($bdd -> query($sql) as $row) {
      echo "<tr id='adminDescription'>";
      echo "<td>" . $row['id'] . "</td>";
      echo "<td>" . $row['Titre'] . "</td>";
      echo "<td>" . $row['LienCover'] . "</td>";
      echo "<td>" . $row['Plateforme'] . "</td>";
      echo "<td>" . $row['Categorie'] . "</td>";
      // Bouton "Désarchiver", voir la page "archive.php"
      echo "<td><a href='desarchive.php?idDesarchive=" . $row['id'] . "' class='btn btn-dark'>Désarchiver</a></td></tr>";
    }
    echo "</tbody></table><hr>";
  ?>

</main>

<?php
} // fermeture du "else" en haut de page
  include "footer.php";
?>
