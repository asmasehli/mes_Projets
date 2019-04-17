<?php
require_once('identifier.php');
require_once('connexion_db.php');

$nom=$_POST['NOM'];
$prenom=$_POST['PRENOM'];
$id_filiere=$_POST['ID_FILIERE'];
$civilite=$_POST['civilite'];

//Récuperer le Nom de la photo envoyée
$nomPhoto= $_FILES['PHOTO']['name'];

//Récuperer le Nom du fichier image temporaire sur le serveur
$imageTmp=$_FILES['PHOTO']['tmp_name'];

//Déplacer le fichier temporaire vers le dossier images de mon application
move_uploaded_file($imageTmp,'../images/'.$nomPhoto);



    $requete="insert into etudiant(nom,prenom,civilite,idFiliere,photo) values(?,?,?,?,?)";

    $param=array($nom,$prenom,$civilite,$id_filiere,$nomPhoto);




$resultat = $pdo->prepare($requete);
$resultat->execute($param);

header("location:etudiants.php");

?>