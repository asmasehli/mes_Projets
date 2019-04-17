<?php
require_once('identifier.php');
require_once('connexion_db.php');
$idS=isset($_GET['ID'])?$_GET['ID']:0;
$requete="select * from etudiant where idStagiaire=$idS";
$resultat=$pdo->query($requete);
$etudiant=$resultat->fetch();
$nom=$etudiant['nom'];
$prenom=$etudiant['prenom'];
$civilite=$etudiant['civilite'];
$idFiliere=$etudiant['idFiliere'];
$photo=$etudiant['photo'];

$requetef="select * from filiere ";
$resultatf=$pdo->query($requetef);







?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edition d'un Etudiant</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="../css/monstyle.css" />
</head>
<body>
<?php include("menu.php"); ?>
<div class="container">

    <div class="panel panel-primary margetop">
        <div class="panel-heading"> Edition d'un Etudiant </div>
        <div class="panel-body">
            <form method="post" action="updateEtudiant.php" class="form" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="idS"> id de l'étudiant: <?php echo $idS ?> </label>
                    <input type="hidden" name="idS" class="form-control" value="<?php echo $idS ?>"/>
                </div>


                <div class="form-group">
                    <label for="nom"> Nom : </label>
                    <input type="text" name="nom" placeholder="Nom" class="form-control" value="<?php echo $nom ?>"/>
                </div>

                <div class="form-group">
                    <label for="prenom"> Prénom : </label>
                    <input type="text" name="prenom" placeholder="Prénom" class="form-control" value="<?php echo $prenom ?>"/>
                </div>

                <div class="form-group">
                    <label for="civilite"> Civilité : </label>
                    <div class="radio">
                        <label><input type="radio" name="civilite"  value="F"
                                <?php if($civilite==="F") echo "checked" ?>/> F </label>
                        <label> <input type="radio" name="civilite"  value="M"
                                <?php if($civilite==="M") echo "checked" ?>/> M </label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="photo"> Photo: </label>
                    <input type="file" name="photo" />
                </div>






                <div class="form-group">
                    <label for="idFiliere"> Filiere: </label>
                    <select name="idFiliere" class="form-control" id="idFiliere" >
                        <?php while($filiere=$resultatf->fetch()) { ?>
                            <option value="<?php echo $filiere['idFiliere']?>" <?php if($idFiliere==$filiere['idFiliere']) echo "selected"?>>
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
