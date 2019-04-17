
<?php
  session_start();
    if(isset($_SESSION['erreurLogin']))
        $erreur=$_SESSION['erreurLogin'];
    else
        $erreur="";
   session_destroy();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title> se connecter </title>

    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="../css/monstyle.css" />
</head>
<body>
<div class="container col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3">

    <div class="panel panel-primary margetop">
        <div class="panel-heading"> Se connecter </div>
        <div class="panel-body">
            <form method="post" action="seConnecter.php" class="form">
               <?php if(!empty($erreur))  {?>
               <div class="alert alert-danger">
                   <?php echo $erreur ?>

               </div>
                <?php } ?>

                <div class="form-group">
                    <label for="login"> Login : </label>
                    <input type="text" name="LOGIN" placeholder="Login" class="form-control" />
                </div>

                <div class="form-group">
                    <label for="pwd"> mot de passe : </label>
                    <input type="password" name="PWD" placeholder="mot de passe" class="form-control" />
                </div>





                <button type="submit" class="btn btn-success"> <span class="glyphicon glyphicon-log-in"> </span>
                    Se connecter ...</button>



            </form>


        </div>
    </div>
</div>

</body>
</html>
