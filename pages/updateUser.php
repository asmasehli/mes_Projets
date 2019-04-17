<?php
require_once('identifier.php');
require_once('connexion_db.php');

$idU=isset($_POST['idU'])?$_POST['idU']:0;
$login=isset($_POST['login'])?$_POST['login']:"";
$email=isset($_POST['email'])?$_POST['email']:"";
$role=isset($_POST['role'])?$_POST['role']:"";


$requete="update utilisateur set login=?,email=?,role=? where iduser=?";

$param=array($login,$email,$role,$idU);


$resultat = $pdo->prepare($requete);
$resultat->execute($param);

header("location:utilisateurs.php");

?>