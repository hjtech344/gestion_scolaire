<?php
// Appelle a la base de donnée
require "../config/config.php";

if(isset($_POST['btn_classe_set'])){
    $classe_id = $_POST['classe_id'];
 
    $deletedClasse = $PDO->prepare(
        "DELETE FROM `classes`
         WHERE classe_id = ?
        "
    );
    $deletedClasse->execute([$classe_id]);
}