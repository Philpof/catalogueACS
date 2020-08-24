<?php
include "header.php";
?>

<main class="container">
  <h1 class="text-center">Résultats de la recherche</h1>
  <hr>

<?php
// fonction de recherche d'Ali

if (isset($_POST["jeux"])) {
  $jeux = $_POST["jeux"];
  $str = $bdd->query("SELECT id FROM jeux WHERE Archivage = '0' AND Titre LIKE '%{$jeux}%'");

  foreach ($str as $row) {
  }

  if (isset($row['id'])) {
    $result = $bdd->query("SELECT * FROM jeux WHERE Archivage = '0' AND Titre LIKE '%{$jeux}%' ORDER BY Titre ASC");
?>
      <table class='table table-hover table-striped text-center align-middle'>
        <thead>
          <tr>
            <th></th>
            <th>Titre</th>
            <th>Categorie</th>
            <th>Plateforme</th>
            <th>Prix</th>
            <th>+ d'info ?</th>
          </tr>
        </thead>
        <tbody>
<?php
    while($row = $result->fetch())
    {
?>
    <tr class="align-center">
      <td class="col-sm-1 align-middle"><img class="cover" src="<?= $row['LienCover'] ?>"></td>
      <td class="col-sm-3 align-middle"><?php echo $row['Titre']; ?></td>
      <td class="col-sm-2 align-middle"><?php echo $row['Categorie']; ?></td>
      <td class="col-sm-2 align-middle"><?php echo $row['Plateforme']; ?></td>
      <td class="col-sm-2 align-middle"><?php echo $row['Prix']; ?> €</td>
      <td class="col-sm-2 align-middle"><a href='produit.php?idSelect=<?php echo $row['id']; ?>' class='btn'><i id="loupeInfo" class="fas fa-search-plus"></i></a></td>
    </tr>
<?php
    }
    echo  "</tbody></table>";
  }
  else {
      echo "<div class='alert alert-danger mt-5 text-center' role='alert'>Le jeu demandé n'est pas disponible ou n'existe pas.</div>";
  }
}
?>



  <!-- Liens pour retourner au site -->
  <hr>
  <div class="col-sm-12 text-center mt-4">
    <a id="retour" href="index.php" class="align-item-center">Revenir à l'accueil</a>
  </div>
  <hr>

</main>





<?php include "footer.php" ?>
