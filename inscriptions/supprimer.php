<?php
// Appelle a la base de donnée
require "../config/config.php";

if(isset($_POST['btn_inscription_set'])){
    $inscription_id = $_POST['inscription_id'];
 
    $deletedInscription = $PDO->prepare(
       "DELETE 
        FROM `inscriptions` 
        WHERE id = ?
        "
    );
    $deletedInscription->execute([$inscription_id]);
}