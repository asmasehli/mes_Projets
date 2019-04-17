<?php
require_once('identifier.php');
require_once('connexion_db.php');

$idS=isset($_GET['idS'])?$_GET['idS']:0;


    $requete="delete from etudiant  where idStagiaire=? ";
    $params=array($idS);
    $resultat=$pdo->prepare($requete);
    $resultat->execute($params);
    header('location:etudiants.php');



?>