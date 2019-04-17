
<?php
require_once('identifier.php');
require_once('connexion_db.php');


if(isset($_POST['email']))

    $email=$_POST['email'];

else

    $email="";

$requete1="select * from utilisateur where email='$email'";

$resultat1 = $pdo->query($requete1);


if($user=$resultat1->fetch()){

    $id=$user['iduser'];

    $pwd="0000";

    $requete="update utilisateur set pwd=MD5(?) where iduser=?";

    $param=array($pwd,$id);

    $resultat = $pdo->prepare($requete);

    $resultat->execute($param);

    $to = $user['email'];

    $subject = "INITIALISATION DE MOT DE PASSE (Poste HP)";

    $txt = "Votre nouveau mot de passe de gesStag est :$pwd";

    $headers = "From: GesStag" . "\r\n" ."CC: asma.sehli.96@gmail.com";

    mail($to,$subject,$txt,$headers);

    header("location:confirmationResetPwd.php");

}else{

    $_SESSION['erreurLogin']="<strong>Erreur!</strong> L'Email est incorrecte!!!";

    header("Location:initialiserPwd.php");
}


?>