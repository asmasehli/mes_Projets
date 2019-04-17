<?php
require_once('identifier.php');
require_once('connexion_db.php');
$requetef="select * from filiere";
$resultatf=$pdo->query($requetef);



?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title> Nouveau Etudiant</title>

    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="../css/monstyle.css" />
</head>
<body>
<?php include("menu.php"); ?>
<div class="container">

    <div class="panel panel-primary margetop">
        <div class="panel-heading"> Ajout d'un Etudiant </div>
        <div class="panel-body">
            <form method="post" action="insertEtudiant.php" class="form" enctype="multipart/form-data">



                <div class="form-group">
                    <label for="nom"> Nom : </label>
                    <input type="text" name="nom" placeholder="Nom" class="form-control" />
                </div>

                <div class="form-group">
                    <label for="prenom"> Prénom : </label>
                    <input type="text" name="prenom" placeholder="Prénom" class="form-control" />
                </div>

                <div class="form-group">
                    <label for="civilite"> Civilité : </label>
                    <div class="radio">
                        <label><input type="radio" name="civilite"  value="F" checked/> F </label>
                        <label> <input type="radio" name="civilite"  value="M" /> M </label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="photo"> Photo: </label>
                    <input type="file" name="photo" />
                </div>






                <div class="form-group">
                    <label for="idfiliere"> Filiere: </label>
                    <select name="idfiliere" class="form-control" id="idfiliere" >
                        <?php while($filiere=$resultatf->fetch()) { ?>
                            <option value="<?php echo $filiere['idFiliere']?>" >
                                <?php echo $filiere['nomFiliere']?>
                            </option>
                        <?php } ?>


                    </select>
                </div>



                <button type="submit" class="btn btn-success"> <span class="glyphicon glyphicon-save"> </span>
                    Enregistrer ...</button>

                </a>


            </form>


        </div>
    </div>
</div>

</body>
</html>
