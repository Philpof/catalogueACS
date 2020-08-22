<?php
  include "header.php";

  // Pour désarchiver l'entrée séléctionnée par le bouton "Désarchiver" de la page "adminSQL.php"
  if (isset($_GET['idDesarchive'])) {
    $sql = "UPDATE jeux SET Archivage = '0' WHERE id = :idDesarchive";
    $select_Archive_Jeux = $bdd->prepare($sql);
    $select_Archive_Jeux->execute(array(':idDesarchive'=>$_GET['idDesarchive']));

    header('Location: admin.php');
    exit();
  }
  else {
    header('Location: admin.php');
    exit();
  }
?>
