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
  <p class="font-weight-bold">Effectuer une nouvelle entrée dans la table "jeux" ou modifier une entrée existante :</p>

  <?php
    // Pour faire une entrée dans la base donnée
    if (!isset($_GET['idSelect']) && !isset($row_idSelect) && !isset($_POST['Annuler']) && !empty($_POST['Titre']) && !empty($_POST['Description']) && !isset($_POST['Prix']) && !isset($_POST['LienCover'])) {
      try {
        $nvl_Ent_Jeux = $bdd->prepare('INSERT INTO jeux (Titre, Description) VALUES (:Titre, :Description)');
        $nvl_Ent_Jeux->execute(array(
          ':Titre' => $_POST['Titre'],
          ':Description' => nl2br($_POST['Description'])
        ));
        header('Location: admin.php');
        exit();
      } catch (\Exception $e) {
        echo $e->getMessage();
      }
    }
    // Pour valider la modification dans la base de donnée de l'entrée sélectionnée
    elseif (isset($_GET['idSelect']) && isset($row_idSelect) && !empty($_POST['titre']) && !empty($_POST['contenu']) && !isset($_POST['Annuler'])) {
      try {
        $modif_Ent_Prop = $bdd->prepare('UPDATE propos SET titre = :titre, contenu = :contenu WHERE id = :idSelect');
        $modif_Ent_Prop->execute(array(
          ':titre' => $_POST['titre'],
          ':contenu' => nl2br($_POST['contenu']),
          ':idSelect'=>$_GET['idSelect']
        ));
        header('Location: adminSQL.php');
        exit();
      } catch (\Exception $e) {
        echo $e->getMessage();
      }
    }
    else {
      $echo_nvl_Ent_Prop = "<p>Compléter les 2 champs suivants pour créer une nouvelle entrée :</p>";
    }
  ?>

  <form action="" method="post">
    <?php
      if (!isset($row_idSelect) || isset($_POST['Annuler'])) {
        echo $echo_nvl_Ent_Prop;
        echo '<label for="Titre" class="col-sm-2 col-lg-1 align-top">Titre</label>
            <input type="text" name="titre" value="" class="col-sm-4 align-top border border-info" required>
            <br>
            <label for="contenu" class="col-sm-2 col-lg-1 align-top">Contenu</label>
            <textarea name="contenu" rows="10" class="col-sm-10 align-top border border-info"></textarea>
            <input type="submit" name="Creer" value="Créer la nvl entrée" class="offset-lg-1 col-sm-2 btn btn-outline-info mt-1">';
      }
      else {
        if (isset($row_idSelect)) {
        echo "<p>Compléter les 2 champs suivants pour modifier l'entrée selectionnée :</p>";
        echo '<label for="titre" class="col-sm-2 col-lg-1 align-top">Titre</label>
            <input type="text" name="titre" value="' . $row_idSelect["titre"] . '" class="col-sm-4 align-top border border-info" required>
            <br>
            <label for="contenu" class="col-sm-2 col-lg-1 align-top">Contenu</label>
            <textarea name="contenu" rows="10" class="col-sm-10 align-top border border-info">' . $row_idSelect["contenu"] . '</textarea>
            <input type="submit" name="Modifier" value="Valider la modification" class="offset-lg-1 col-sm-2 btn btn-outline-success mt-1">
            <input type="submit" name="Annuler" value="Annuler la modification" class="offset-lg-1 col-sm-2 btn btn-outline-danger mt-1" >';
        } else {
          header('Location: adminSQL.php');
          exit();
        }
      }
    ?>
  </form>
  <hr>

  <!-- Pour afficher toutes les entrées et les champs de la base de données -->
  <p class="font-weight-bold">Contenu de la table "jeux" non archivé :</p>
  <?php
    $sql = "SELECT * FROM jeux WHERE Archivage='0' ORDER BY id ASC";
    echo "<table class='table table-hover table-striped'>
            <thead>
              <tr>
                <th>id.</th>
                <th>Titre</th>
                <th>Description</th>
                <th>Prix</th>
                <th>LienCover</th>
                <th>Plateforme</th>
                <th>DateSortie</th>
                <th>BestSeller</th>
                <th>NbrJoueur</th>
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

      echo "<tr>";
      echo "<td>" . $row['id'] . "</td>";
      echo "<td>" . $row['Titre'] . "</td>";
      echo "<td  id='adminDescription'>" . $row['Titre'] . "</td>"; // Description > trouver le moyen de ne pas tout afficher
      echo "<td>" . $row['Prix'] . " €</td>";
      echo "<td>" . $row['LienCover'] . "</td>";
      echo "<td>" . $row['Plateforme'] . "</td>";
      echo "<td>" . $row['DateSortie'] . "</td>";
      echo "<td>" . $bestSeller . "</td>";
      echo "<td>" . $row['NbrJoueur'] . "</td>";
      echo "<td>" . $row['Categorie'] . "</td>";
      echo "<td>" . $row['Special'] . "</td>";

      // Bouton "Modifier", voir la page "select.php"
      echo "<td><a href='admin.php?idSelect=" . $row['id'] . "' class='btn btn-info'>Modifier</a></td>";
      // Bouton "Archiver", voir la page "archive.php"
      echo "<td><a href='archive.php?idArchive=" . $row['id'] . "' class='btn btn-warning'>Archiver</a></td>";
      // Bouton "Supprimer", voir la page "suppr.php"
      echo "<td><a href='suppr.php?idSuppr=" . $row['id'] . "' class='btn btn-danger'>Supprimer</a></td>";
    }
    echo "</tr></tbody></table><hr>";
  ?>

  <!-- Pour afficher toutes les entrées de la base de données archivées -->
  <p class="font-weight-bold">Contenu de la table "jeux" archivé :</p>
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
      echo "<tr>";
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
