<?php
include "header.php";
?>

<!-- Le HTML -->


<main class="container">
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
  <?php

?>
  <div class="container main-content">
    <div class="row">

    <div class="col-8 games">
      <section class="on-sale">

        <div class="container">
          <div class="title-box">
            <h2>Best Seller</h2>
          </div>
          <div class="row">
            <?php

  $bestSeller = $bdd->query('SELECT id, Titre, Prix, LienCover FROM jeux WHERE BestSeller = 1');
  while ($donnees = $bestSeller->fetch()) {
?>

            <div class="col-md-4">
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
                <h3><?= $donnees['Titre'] ?></h3>
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
      <section class="new-product">
        <?php

        if (!isset($_GET['categorieSelect'])) {
        $categorie = 'Action';
        }
        else {
        $categorie = htmlspecialchars($_GET['categorieSelect']);
        }
        $query = $bdd->query("SELECT * FROM jeux WHERE Categorie LIKE '%" . $categorie ."%'");


        ?>

        <div class="container">
          <div class="title-box">
            <h2><?= $categorie ?></h2>
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
                <h3><?= $donnees['Titre'] ?></h3>
                <h5><?= $donnees['Prix'] ?> €</h5>
              </div>
            </div>
            <?php
    }
     ?>
          </div>
        </div>

      </section>
      <section class="new-product">
        <?php
        if (!isset($_GET['plateformeSelect'])) {
          $plateforme = 'PS4';
        }
        else {
          $plateforme = htmlspecialchars($_GET['plateformeSelect']);
        }

        $query = $bdd->query('SELECT * FROM jeux WHERE Plateforme LIKE "%' . $plateforme . '%"');
        ?>

        <div class="container">
          <div class="title-box">
            <h2><?= $plateforme ?></h2>
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
                <h3><?= $donnees['Titre'] ?></h3>
                <h5><?= $donnees['Prix'] ?> €</h5>
              </div>
            </div>
            <?php
    }
     ?>
          </div>
        </div>
      </section>
    </div>

    <!-- <div class="col-4 border-2 bcolor sidebar">
  <div class="w-100 text-center p-4">
    <h5 class="p-2 border-bt text-danger"></h5> -->
    <div class="offset-1 col-3 bcolor sidebar rounded">
          <div class="w-100 text-center px-2 py-4">
            <li class="productsTitle">
              <p>Plateforme</p>
            </li>
                <ul id="products">
                    <li><a href="/catalogueACS/index.php?plateformeSelect=Switch">Switch</a></li>
                    <li><a href="/catalogueACS/index.php?plateformeSelect=Wii U">Wii U</a></li>
                    <li><a href="/catalogueACS/index.php?plateformeSelect=PS4">PS4</a></li>
                    <li><a href="/catalogueACS/index.php?plateformeSelect=PC">PC</a></li>
                    <li><a href="/catalogueACS/index.php?plateformeSelect=Xbox One">Xbox One</a></li>
                    <li><a href="/catalogueACS/index.php?plateformeSelect=Xbox Series X">Xbox Series X</a></li>
                    <li><a href="/catalogueACS/index.php?plateformeSelect=NES">NES</a></li>
                    <li><a href="/catalogueACS/index.php?plateformeSelect=SNES">SNES</a></li>
                </ul>
                <hr>

                <li class="productsTitle">
                  <p>Categorie</p>
                </li>
                <ul id="products">
                    <li><a href="/catalogueACS/index.php?categorieSelect=Action">Action</a></li>
                    <li><a href="/catalogueACS/index.php?categorieSelect=Aventure">Aventure</a></li>
                    <li><a href="/catalogueACS/index.php?categorieSelect=Plateforme">Plateforme</a></li>
                    <li><a href="/catalogueACS/index.php?categorieSelect=RPG">RPG</a></li>
                    <li><a href="/catalogueACS/index.php?categorieSelect=Survie">Survie</a></li>
                    <li><a href="/catalogueACS/index.php?categorieSelect=Combat">Combat</a></li>
                </ul>
                <hr>

                <li class="productsTitle">
                  <p>Special</p>
                </li>
                <ul id="products">
                    <li><a href="/catalogueACS/index.php?specialSelect=Exclu">Exclu</a></li>
                    <li><a href="/catalogueACS/index.php?specialSelect=Retro">Retro</a></li>
                    <li><a href="/catalogueACS/index.php?specialSelect=Nouveauté">Nouveauté</a></li>
                    <li><a href="/catalogueACS/index.php?specialSelect=A venir">à venir</a></li>
                </ul>
                <hr>
      </div>
    </div>

  </div>

  </div>



  <!-- website features -->

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
