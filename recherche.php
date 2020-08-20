<?php include "header.php";

// fonction de recherche d'Ali

if (isset($_POST["jeux"])) {
  $jeux = $_POST["jeux"];
  $str = $bdd->query("SELECT id FROM jeux WHERE Titre LIKE '%{$jeux}%'");

  foreach ($str as $row) {
  }

  if (isset($row['id'])) {
    $result = $bdd->query("SELECT * FROM jeux WHERE Titre LIKE '%{$jeux}%'");
    ?>  <br>
      <br><br>
      <table>
          <tr>
              <th>Titre</th>
              <th>Categorie</th>
          </tr><?php

    while($row = $result->fetch())
    {
      ?>
      <tr>
          <td><?php echo $row['Titre']; ?> </td>
          <td><?php echo $row['Categorie']; ?> </td>
      </tr>
      <?php
  }
echo  "</table>";
  }
  else {
      echo "It Does not exist";
  }
}
?>

<!-- Le HTML -->





<?php include "footer.php" ?>
