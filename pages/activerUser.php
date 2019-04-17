<?php
require_once('identifier.php');
require_once('connexion_db.php');

$idU=isset($_GET['idU'])?$_GET['idU']:0;
$etat=isset($_GET['etat'])?$_GET['etat']:0;


if($etat==1)
    $etat=0;
else
    $etat=1;
$requete="update utilisateur set etat=? where iduser=?";

$param=array($etat,$idU);


$resultat = $pdo->prepare($requete);
$resultat->execute($param);

header("location:utilisateurs.php");

?>