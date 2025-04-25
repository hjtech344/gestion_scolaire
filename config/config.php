<?php
// Informations pour la connection avec la base de donnée
$DB_DNS      = 'mysql:host=localhost;dbname=gestion_ecole';
$DB_USER     = 'root';
$DB_PASSWORD = 'hjdev';

// Connection avec la base de donnée
try{
    $PDO = new PDO($DB_DNS, $DB_USER, $DB_PASSWORD);
    if($PDO){
       $message = "La connection avec la base de donnée a été bien établit";
       setcookie("msg_db_success", $message);
    }
}catch(PDOException $error){ 
    echo(
       "Une erreur s'est produit lors de la connection avec la base de donnée"
       .$error->getMessage()
    );
}