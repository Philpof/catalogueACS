<?php
  include "header.php";

  // Pour archiver l'entrée de la table "jeux" sélectionnée par le bouton "Archiver" de la page "admin.php"
  if (isset($_GET['idArchive'])) {
    $select_Archive_Jeux = $bdd->prepare("UPDATE jeux SET Archivage = '1' WHERE id = :idArchive");
    $select_Archive_Jeux->execute(array(':idArchive'=>$_GET['idArchive']));

    header('Location: admin.php');
    exit();
  }
  else {
    header('Location: admin.php');
    exit();
  }
?>
