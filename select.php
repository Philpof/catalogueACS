<?php
// Ici, on inclue connexion.php lequel permet la connexion à la base de donnée
  include "connexion.php";

  // Pour afficher les informations de l'entrée séléctionnée par le bouton "Modifier" de la page "admin.php"
  if (isset($_GET['idSelect'])) {
    $select_Ent_Jeux = $bdd->prepare('SELECT id, Titre, Description FROM jeux WHERE id = :idSelect');
    $select_Ent_Jeux->execute(array(':idSelect'=>$_GET['idSelect']));
    $row_idSelect = $select_Ent_Jeux->fetch();

      //   header('Location: admin.php');
      //   exit();
      // }
      // else {
      //   header('Location: admin.php');
      //   exit();
  }
?>
