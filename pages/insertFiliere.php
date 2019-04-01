<?php
  require_once('connexion_db.php');
  $nomF=isset($_POST['nomF'])?$_POST['nomF']:"";
  $niveau=isset($_POST['niveau'])?$_POST['niveau']:"";

  $requete="insert into filiere(nomFiliere,niveau) values (?,?)";
  $params=array($nomF,$niveau);
  $resultat=$pdo->prepare($requete);
  $resultat->execute($params);

  header('location:filieres.php');

?>