<?php
  require_once('connexion_db.php');
  $nomF=isset($_POST['nomF'])?$_POST['nomF']:"";
  $idf=isset($_POST['idf'])?$_POST['idf']:0;
  $niveau=isset($_POST['niveau'])?$_POST['niveau']:"";

  $requete="update filiere set nomFiliere=?,niveau=? where idFiliere=? ";
  $params=array($nomF,$niveau,$idf);
  $resultat=$pdo->prepare($requete);
  $resultat->execute($params);

  header('location:filieres.php');

?>