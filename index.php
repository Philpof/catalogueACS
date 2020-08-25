<?php
include "header.php";
?>

<!-- Le HTML -->

<main id="main" class="container">
  <div class="slider">
    <div id="slider" class="carousel slide carousel-fade" data-ride="carousel">
      <div class="carousel-inner">

        <?php
          $nbrIdBG = $bdd->query("SELECT COUNT(id) AS nbrId FROM background");
          $resultat = $nbrIdBG->fetch();
          $nbMax = $resultat['nbrId'];

          // Le random avec, en nombre max, le nombre d'entrée déterminée
          $numeroPre = 0;
          $idTest = 0;
          $idTest2 = 0;
          for ($cnt = 0; $cnt < 3; $cnt++) {
            while ($idTest == $numeroPre || $idTest2 == $numeroPre) {
              $numero = rand(1, $nbMax);
              $testPoss = $bdd->query("SELECT id_jeu FROM background WHERE id='{$numero}'");
              $testRecup = $testPoss->fetch();
              $idTest2 = $idTest;
              $idTest = $testRecup['id_jeu'];
            }

            $imageCarousel = $bdd->query("SELECT * FROM background WHERE id='{$numero}'");

            while($imageFinal = $imageCarousel->fetch()){
              $lienImage = $imageFinal['lien'];
              $idJeu = $imageFinal['id_jeu'];
            }
        ?>

        <div class="carousel-item <?php if($cnt < 1 ) echo "active";?>">
          <a href="/catalogueACS/produit.php?idSelect=<?= $idJeu ?>">
            <img src="<?= $lienImage ?>" class="d-block w-100">
          </a>
        </div>

        <?php
         $numeroPre = $idJeu;
        }
        ?>

        <ol class="carousel-indicators">
          <li data-target="#slider" data-slide-to="0" class="active"></li>
          <li data-target="#slider" data-slide-to="1"></li>
          <li data-target="#slider" data-slide-to="2"></li>
        </ol>
      </div>
    </div>
  </div>

  <div class="container main-content">
    <div class="row">
      <div class="col-10">
        <section class="">
          <div class="container">
            <div class="title-box">
              <h2>Best Seller</h2>
            </div>
            <div class="row">
              <?php

                $bestSeller = $bdd->query('SELECT id, Titre, Prix, LienCover FROM jeux WHERE BestSeller = 1');
                while ($donnees = $bestSeller->fetch()) {

              ?>

              <div class="col-md-3">
                <div class="product-top">
                  <a href="/catalogueACS/produit.php?idSelect=<?= $donnees['id'] ?>"><img src="<?= $donnees['LienCover'] ?>"></a>
                  <div class="overlay-right">
                    <button type="button" class="btn btn-secondary" title="game shop">
                      <i class="fa fa-eye"></i>
                    </button>
                    <button type="button" class="btn btn-secondary" title="Ad to wishlist">
                      <i class="fa fa-heart-o"></i>
                    </button>
                    <button type="button" class="btn btn-secondary" title="game shop">
                      <i class="fa fa-shopping-cart"></i>
                    </button>
                  </div>
                </div>
                <div class="product-bottom text-center">
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star-half-o"></i>
                  <h5><?= $donnees['Titre'] ?></h5>
                  <h5><?= $donnees['Prix'] ?> €</h5>
                </div>
              </div>

              <?php
                }
              ?>

            </div>
          </div>
        </section>

        <!-- deuxième row -->
        <section id="categorie" class="">

          <?php
          $categorie = "";
          if (isset($_POST['categorieSelect'])) {
            $categorie = " WHERE ";
            foreach($_POST["categorieSelect"] as $cs) $categorie .= ($categorie != " WHERE " ? " AND " : "") . 'Categorie LIKE "%' . htmlentities($cs) . '%"';
          }
            $query = $bdd->query('SELECT * FROM jeux' . $categorie);
          ?>

          <div class="container">
            <div class="title-box">
              <h2>Catégorie</h2>
            </div>
            <div class="row">

              <?php
                while ($donnees = $query->fetch()) {
              ?>

              <div class="col-md-3">
                <div class="product-top">
                  <a href="/catalogueACS/produit.php?idSelect=<?= $donnees['id'] ?>"><img src="<?= $donnees['LienCover'] ?>"></a>
                  <div class="overlay-right">
                    <button type="button" class="btn btn-secondary" title="game shop">
                      <i class="fa fa-eye"></i>
                    </button>
                    <button type="button" class="btn btn-secondary" title="Add to wishlist">
                      <i class="fa fa-heart-o"></i>
                    </button>
                    <button type="button" class="btn btn-secondary" title="game shop">
                      <i class="fa fa-shopping-cart"></i>
                    </button>
                  </div>
                </div>
                <div class="product-bottom text-center">
                  <h5><?= $donnees['Titre'] ?></h5>
                  <h5><?= $donnees['Prix'] ?> €</h5>
                </div>
              </div>

              <?php
                }
              ?>

            </div>
          </div>
        </section>

        <hr>
        <div class="text-center">
          <a id="haut" href="index.php">Retour en haut de la page</a>
        </div>
        <hr>

        <section id="plateforme" class="">

          <?php
          $plateforme = "";
          if (isset($_POST['plateformeSelect'])) {
            $plateforme = " WHERE ";
            foreach($_POST["plateformeSelect"] as $ps) $plateforme .= ($plateforme != " WHERE " ? " OR " : "") . 'Plateforme LIKE "%' . htmlentities($ps) . '%"';
          }
            $query = $bdd->query('SELECT * FROM jeux' . $plateforme);

          ?>

          <div class="container">
            <div class="title-box">
              <h2>Plateforme</h2>
            </div>
            <div class="row">

              <?php
                while ($donnees = $query->fetch()) {
              ?>

              <div class="col-md-3">
                <div class="product-top">
                  <a href="/catalogueACS/produit.php?idSelect=<?= $donnees['id'] ?>"><img src="<?= $donnees['LienCover'] ?>"></a>
                  <div class="overlay-right">
                    <button type="button" class="btn btn-secondary" title="game shop">
                      <i class="fa fa-eye"></i>
                    </button>
                    <button type="button" class="btn btn-secondary" title="Add to wishlist">
                      <i class="fa fa-heart-o"></i>
                    </button>
                    <button type="button" class="btn btn-secondary" title="game shop">
                      <i class="fa fa-shopping-cart"></i>
                    </button>
                  </div>
                </div>
                <div class="product-bottom text-center">
                  <h5><?= $donnees['Titre'] ?></h5>
                  <h5><?= $donnees['Prix'] ?> €</h5>
                </div>
              </div>

              <?php
                }
              ?>

            </div>
          </div>
        </section>

        <hr>
        <div class="text-center">
          <a id="haut" href="index.php">Retour en haut de la page</a>
        </div>
        <hr>

      </div>

      <div class="col-2 bcolor sidebar rounded">
        <div class="w-100 text-center px-2 py-4">
          <li class="productsTitle">
            <p>Categorie</p>
          </li>
          <ul id="products">
            <li><input class="sideBarCheckbox" type="checkbox" id="Action" name="categorieSelect[]" value="Action">
             <label for="Action">Action</label></li>
            <li><input class="sideBarCheckbox" type="checkbox" id="Aventure" name="categorieSelect[]" value="Aventure">
             <label for="Aventure">Aventure</label></li>
            <li><input class="sideBarCheckbox" type="checkbox" id="Plateforme" name="categorieSelect[]" value="Plateforme">
             <label for="Plateforme">Plateforme</label></li>
            <li><input class="sideBarCheckbox" type="checkbox" id="RPG" name="categorieSelect[]" value="RPG">
             <label for="RPG">RPG</label></li>
            <li><input class="sideBarCheckbox" type="checkbox" id="Survie" name="categorieSelect[]" value="Survie">
             <label for="Survie">Survie</label></li>
            <li><input class="sideBarCheckbox" type="checkbox" id="Combat" name="categorieSelect[]" value="Combat">
             <label for="Combat">Combat</label></li>

          </ul>
          <hr>
          <li class="productsTitle">
            <p>Plateforme</p>
          </li>
          <form id="products" method="post" action="index.php">
            <ul>
              <li><input class="sideBarCheckbox" type="checkbox" id="switch" name="plateformeSelect[]" value="Swicth">
               <label for="switch">Switch</label></li>
              <li><input class="sideBarCheckbox" type="checkbox" id="wiiU" name="plateformeSelect[]" value="Wii U">
               <label for="wiiU">Wii U</label></li>
              <li><input class="sideBarCheckbox" type="checkbox" id="PS4" name="plateformeSelect[]" value="PS4">
               <label for="PS4">PS4</label></li>
              <li><input class="sideBarCheckbox" type="checkbox" id="PC" name="plateformeSelect[]" value="PC">
               <label for="PC">PC</label></li>
              <li><input class="sideBarCheckbox" type="checkbox" id="xboxOne" name="plateformeSelect[]" value="Xbox One">
               <label for="xboxOne">Xbox One</label></li>
              <li><input class="sideBarCheckbox" type="checkbox" id="xboxSeriesX" name="plateformeSelect[]" value="Xbox Series X">
               <label for="xboxSeriesX">Xbox Series X</label></li>
              <li><input class="sideBarCheckbox" type="checkbox" id="NES" name="plateformeSelect[]" value="NES">
               <label for="NES">NES</label></li>
              <li><input class="sideBarCheckbox" type="checkbox" id="SNES" name="plateformeSelect[]" value="SNES">
               <label for="SNES">SNES</label></li>
               <input class="sideBarFiltre" type="Submit" name="filtre" value="Filtrer">
          </ul>
            <hr>
          <li class="productsTitle">
            <p>Special</p>
          </li>
          <ul id="products">
              <li><a href="/catalogueACS/index.php?specialSelect=Exclu">Exclu</a></li>
              <li><a href="/catalogueACS/index.php?specialSelect=Retro">Retro</a></li>
              <li><a href="/catalogueACS/index.php?specialSelect=Nouveauté">Nouveauté</a></li>
              <li><a href="/catalogueACS/index.php?specialSelect=A venir">A venir</a></li>
            </ul>




          </form>
          <hr>
        </div>
      </div>
    </div>
</div>
  <!-- website features -->
  <section class="website-features">
    <div class="container">
      <div class="row">
        <div class="col-md-3 feature-box">
          <img src="img/garant.jfif">
          <div class="feature-text">
            <p><b>100% Original items </b>are available at company</p>
          </div>
        </div>
        <div class="col-md-3 feature-box">
          <img src="img/return1.jpg">
          <div class="feature-text">
            <p><b>Return within 30 days </b>of receiving your order.</p>
          </div>
        </div>
        <div class="col-md-3 feature-box">
          <img src="img/free.webp">
          <div class="feature-text">
            <p><b>Get free delivery for every </b>order on more than price.</p>
          </div>
        </div>
        <div class="col-md-3 feature-box">
          <img src="img/pay.png">
          <div class="feature-text">
            <p><b>Pay Online through multiple</b>options (card/Net banking)</p>
          </div>
        </div>
      </div>
    </div>
  </section>

</main>

<?php include "footer.php" ?>
