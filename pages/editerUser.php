<?php
require_once('identifier.php');
require_once('connexion_db.php');

$idU=isset($_GET['idU'])?$_GET['idU']:0;
$requeteUser="select * from utilisateur where iduser=$idU";
$resultatUser=$pdo->query($requeteUser);
$User=$resultatUser->fetch();
$login=$User['login'];
$role=strtoupper($User['role']);
$email=$User['email'];







?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edition d'un Utilisateur </title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="../css/monstyle.css" />
</head>
<body>
<?php include("menu.php"); ?>
<div class="container">

    <div class="panel panel-primary margetop">
        <div class="panel-heading"> Edition d'un Utilisateur </div>
        <div class="panel-body">
            <form method="post" action="updateUser.php" class="form" >
                <div class="form-group">
                    <label for="idU"> id d'un utilisateur: <?php echo $idU ?> </label>
                    <input type="hidden" name="idU" class="form-control" value="<?php echo $idU ?>"/>
                </div>


                <div class="form-group">
                    <label for="login"> Login : </label>
                    <input type="text" name="login" placeholder="Login" class="form-control" value="<?php echo $login ?>"/>
                </div>

                <div class="form-group">
                    <label for="email"> Email : </label>
                    <input type="text" name="email" placeholder="Email" class="form-control" value="<?php echo $email ?>"/>
                </div>

                <div class="form-group">
                    <select name="role" class="form-control">
                        <option value="ADMIN" <?php if($role=="ADMIN") echo "selected" ?>> Administrateur</option>
                        <option value="VISITEUR" <?php if($role=="VISITEUR") echo "selected" ?>> Visiteur</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success"> <span class="glyphicon glyphicon-save"> </span>
                    Enregistrer ...</button>

                &nbsp;&nbsp;
                <a href=modifierPwd.php?idU=<?php echo $idU ?>"> changer le mot de passe</a>

            </form>


        </div>
    </div>
</div>

</body>
</html>
