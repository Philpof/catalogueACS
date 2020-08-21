<?php
// On prolonge la session
session_start ();

// Réinitialisation du tableau de session
// On le vide intégralement
$_SESSION = array();
// Destruction de la session
session_destroy();
// Destruction du tableau de session
unset($_SESSION);
//histoire d'être sûre
$_SESSION = null;

// On redirige le visiteur vers la page d'accueil
header ('location: index.php');
?>
