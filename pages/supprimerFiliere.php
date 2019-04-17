<?php
require_once('identifier.php');
  require_once('connexion_db.php');

  $idf=isset($_GET['idF'])?$_GET['idF']:0;
  $requeteStage="select count(*) countEtu from etudiant where idFiliere=$idf";
  $resEtudiant=$pdo->query($requeteStage);
  $tabCountEtu=$resEtudiant->fetch();
  $nbreEtudiant=$tabCountEtu['countEtu'];
  if($nbreEtudiant==0){

  $requete="delete from filiere  where idFiliere=? ";
  $params=array($idf);
  $resultat=$pdo->prepare($requete);
  $resultat->execute($params);
  header('location:filieres.php');
  }
  else {
   $msg="suppression impossible! vous devez supprimer tous les étudiants inscrits dans cette filière";
   header("location:alerte.php?message=$msg");
  }



?>