<?php include "header.php" ?>
<?php
// function recherche($text) {
//
//
//     $db = new PDO("mysql:host=localhost;dbname=catalogueacs", 'root', '');
//
//     $text = htmlspecialchars($text);
//
//     $get_name = $db->prepare("SELECT categorie FROM jeux WHERE categorie LIKE concat('%', :Categorie, '%')");
//     $get_name -> execute(array('name' => $text));
//
//     while($names = $get_name->fetch(PDO::FETCH_ASSOC)) {
//
//         echo '<a href="">' .$names['name'] .'</a>';
//     }
//
// }





    /* Toss back results as json encoded array. */
    // echo json_encode($return_arr);
// }



?>

<?php include "footer.php" ?>
