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



  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "catalogueacs";

  try {
    $conn = new PDO('mysql:host=localhost;dbname=catalogueacs;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    // set the PDO error mode to exception
    // $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully";
  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }



  if (isset($_POST["jeux"])) {
          $jeux = $_POST["jeux"];
          $str = $conn->query("SELECT * FROM jeux WHERE Titre LIKE '%{$jeux}%'");
          if ($str === true) {



            $str->setFetchmode(PDO:: FETCH_OBJ);
            ?>  <br>
              <br><br>
              <table>
                  <tr>
                      <th>Titre</th>
                      <th>Categorie</th>
                  </tr><?php

          while($row = $str->fetch())
          {

              ?>

                  <tr>
                      <td><?php echo $row->Titre; ?> </td>
                      <td><?php echo $row->Categorie; ?> </td>
                  </tr>


        <?php

          }
        echo  "</table>";




        }
        else{
            echo "It Does not exist";
         }


     }









    function debug($var, $style = "")
    {
      echo "<pre style='background-color: white; border: gray 1px solid; -webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px; color: black; width: 95%; padding: 10px; overflow-y: auto;{$style}'>";
      var_dump($var);
      echo "</pre>";
    }
  ?>



  <div class="main">

  <form method="post" action="header.php">
        <label id="clr">Search</label>
        <input class="search-txt" type="text" name="jeux" placeholder="tapez à rechercher">
        <button type="submit" class="btn-search"><i class="fas fa-search"></i></button>


        <!-- <input type="submit" name="submit"> -->
        <!-- <a class="search-btn"href="#"></a>
        <i class="fas fa-search"></i> -->
  </form>

  </div>
