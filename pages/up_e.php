<?php
require_once('identifier.php');
require_once('connexion_db.php');

$id=$_POST['idS'];
$nom=$_POST['nom'];
$prenom=$_POST['prenom'];
$id_filiere=$_POST['idFiliere'];
$civilite=$_POST['civilite'];

//Récuperer le Nom de la photo envoyée
$nomPhoto= $_FILES['photo']['name'];

//Récuperer le Nom du fichier image temporaire sur le serveur
$imageTmp=$_FILES['photo']['tmp_name'];

//Déplacer le fichier temporaire vers le dossier images de mon application
move_uploaded_file($imageTmp,'../images/'.$nomPhoto);

if(!empty($nomPhoto)){ // empty($nomPhoto):$nomPhoto est vide (Photo non envoyée)
    // !empty($nomPhoto):$nomPhoto non vide (Photo envoyée)

    $requete="UPDATE etudiant SET nom=?,prenom=?,idFiliere=?,photo=?,civilite=? where id=?";

    $param=array($nom,$prenom,$id_filiere,$nomPhoto,$civilite,$id);
}
else{ // Photo non envoyée
    $requete="UPDATE etudiant SET nom=?,prenom=?,idFiliere=?,civilite=? where id=?";

    $param=array($nom,$prenom,$id_filiere,$civilite,$id);
}

$resultat = $pdo->prepare($requete);
$resultat->execute($param);

header("location:etudiants.php");

?>