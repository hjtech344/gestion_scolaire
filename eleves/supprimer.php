<?php
require "../config/config.php";

if(isset($_POST['btn_destroy_set'])){
    $eleve_id = $_POST['eleve_id'];

    $deletedEleve = $PDO->prepare(
       "DELETE FROM `eleves` WHERE eleve_id = ?" 
    );
    $deletedEleve->execute([$eleve_id]);
}