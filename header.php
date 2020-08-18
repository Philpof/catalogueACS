<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="Robin DE MARCH, Ali SYED & Philippe PERECHODOV">
  <title>Catalogue JV - ACS</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <!-- Fontawsome -->
  <script src="https://kit.fontawesome.com/fbdd9c8340.js" crossorigin="anonymous"></script>

  <!-- Style CSS -->
  <link rel="stylesheet" href="style.css">

</head>

<body>
  <?php

    if (isset($_GET['term'])){
            $term = htmlentities($_GET['term']);
            // $return_arr = array();



    try
    {
      // On se connecte à MySQL
      $bdd = new PDO('mysql:host=localhost;dbname=catalogueacs;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

      $stmt = $conn->prepare('SELECT * FROM jeux WHERE Titre ="' . $term . '"');
      // $stmt->execute();

      $stmt->execute();


      while($row = $stmt->fetch()) {
          $return_arr[] =  $row['Titre'];
      }


    }
    catch(Exception $e)
    {
      // En cas d'erreur, on affiche un message et on arrête tout
      die('Erreur : '.$e->getMessage());
    }







    function debug($var, $style = "")
    {
      echo "<pre style='background-color: white; border: gray 1px solid; -webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px; color: black; width: 95%; padding: 10px; overflow-y: auto;{$style}'>";
      var_dump($var);
      echo "</pre>";
    }
    ?>
