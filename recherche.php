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


define('DB_SERVER', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'catalogueacs');


if (isset($_GET['term'])){
    // $return_arr = array();

    try {
        $conn = new PDO("mysql:host=".DB_SERVER.";port=8889;dbname=".DB_NAME, DB_USER, DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare('SELECT * FROM jeux WHERE Categorie LIKE :term');
        $stmt->execute(array('term' => '%'.$_GET['term'].'%'));

        while($row = $stmt->fetch()) {
            $return_arr[] =  $row['Categorie'];
        }

    } catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }


    /* Toss back results as json encoded array. */
    // echo json_encode($return_arr);
}



?>

<?php include "footer.php" ?>
