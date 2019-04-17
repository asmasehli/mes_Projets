<?php
require_once('identifier.php');
require_once('connexion_db.php');

$idU=isset($_GET['idU'])?$_GET['idU']:0;


$requete="delete from utilisateur  where iduser=? ";
$params=array($idU);
$resultat=$pdo->prepare($requete);
$resultat->execute($params);
header('location:utilisateurs.php');



?>