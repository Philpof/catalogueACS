<?php
if (stripos($_SERVER['PHP_SELF'], 'produit.php')) {
  $fluid = '-fluid';
}
else {
  $fluid = null;
}
?>

<footer id="footer" class="container<?php echo $fluid ?> text-center">

    <div id="realisation" class="p-2">Site réalisé en HTML - CSS - PHP - MySQL - javascript</div>
    <div id="lienLinkedIn" class="p-2">
      <a href="https://www.linkedin.com/in/robin-de-march/" target="_blank">Robin DE MARCH</a> | <a href="404.php" target="_blank">Ali SYED</a> | <a href="https://www.linkedin.com/in/philippe-perechodov/" target="_blank">Philippe PERECHODOV</a>
    </div>
    <div id="copyright" class"p-2">
      <a>Copyright © 2020 GRAP.fr - All rights reserved</a>
      <a id="github" href="https://github.com/Philpof/catalogueACS" target="_blank"><i class="fab fa-github"></i></a>
    </div>

</footer>


  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

  <script type="text/javascript"src="script.js"></script>

</body>

</html>
