<?php
session_start();
require_once('connexion_db.php');

$login=isset($_POST['LOGIN'])?$_POST['LOGIN']:"";
$pwd=isset($_POST['PWD'])?$_POST['PWD']:"";

$requete="select * from utilisateur where login='$login' and pwd=MD5('$pwd')";
$resultat=$pdo->query($requete);

if($user=$resultat->fetch()) {
    if($user['etat']==1){
        $_SESSION['user']=$user;
        header('location:../index.php');
    }else {
        $_SESSION['erreurLogin']="<strong>Erreur!! </strong> Votre compte est désactivé. <br> Veuillez contacter l'adminisrateur";
        header('location:login.php');
    }

} else {
    $_SESSION['erreurLogin']="<strong>Erreur!! </strong> Login ou mot de passe  incorrect !! ";
    header('location:login.php');
}

$requetef="select * from filiere ";
$resultatf=$pdo->query($requetef);







?>