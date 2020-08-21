<?php
include "header.php";
?>

<main class="container pt-5 pb-5">
  <h1 class="text-center">Résultats de la recherche</h1>
  <hr>

<?php
// fonction de recherche d'Ali

if (isset($_POST["jeux"])) {
  $jeux = $_POST["jeux"];
  $str = $bdd->query("SELECT id FROM jeux WHERE Titre LIKE '%{$jeux}%'");

  foreach ($str as $row) {
  }

  if (isset($row['id'])) {
    $result = $bdd->query("SELECT * FROM jeux WHERE Titre LIKE '%{$jeux}%'");
?>
      <table class='table table-hover table-striped text-center align-middle'>
        <thead>
          <tr>
            <th>Screenshot</th>
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
    <tr>
      <td><img class="jaquettes" src="<?= $row['LienImage'] ?>">;</td>
      <td><?php echo $row['Titre']; ?></td>
      <td><?php echo $row['Categorie']; ?></td>
      <td><?php echo $row['Plateforme']; ?></td>
      <td><?php echo $row['Prix']; ?> €</td>
      <td><a href='produit.php?idSelect=<?php echo $row['id']; ?>' class='btn'><i id="loupeInfo" class="fas fa-search-plus"></i></a></td>
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
