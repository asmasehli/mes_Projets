<?php
  require_once('connexion_db.php');

  $idf=isset($_GET['idF'])?$_GET['idF']:0;


  $requete="delete from filiere  where idFiliere=? ";
  $params=array($idf);
  $resultat=$pdo->prepare($requete);
  $resultat->execute($params);

  header('location:filieres.php');

?>