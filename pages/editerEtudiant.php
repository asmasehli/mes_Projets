
<?php
require_once('identifier.php');
$id=$_GET['ID'];
require_once('connexion_db.php');

$requete="select * from etudiant where idStagiaire=$id";
$resultat = $pdo->query($requete);
$ETUDIANT=$resultat->fetch();

$requetef="select * from filiere";
$resultatf = $pdo->query($requetef);


?>

<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8" />
    <title>Editer un étudiant</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
</head>
<body>
<div class="container">
    <br>

    <div class="panel panel-primary">
        <div class="panel-heading">Editer un étudiant</div>
        <div class="panel-body">
            <form method="post" action="updateEtudiant.php" class="form" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="id" class="control-label" >
                        Id=<?php echo $ETUDIANT['idStagiaire']; ?>
                    </label>
                    <input type="hidden" name="ID"
                           id="id" class="form-control"
                           value="<?php echo $ETUDIANT['idStagiaire']; ?>"/>
                </div>

                <div class="form-group">
                    <label for="NOM" class="control-label">NOM</label>
                    <input type="text" name="NOM" id="NOM" class="form-control"
                           value="<?php echo $ETUDIANT['nom']; ?>"/>
                </div>

                <div class="form-group">
                    <label for="PRENOM" class="control-label">PRENOM</label>
                    <input type="text" name="PRENOM" id="PRENOM"
                           class="form-control"
                           value="<?php echo $ETUDIANT['prenom'] ?>"/>
                </div>

                <div class="form-group">
                    <label for="ID_FILIERE" class="control-label">FILIERE</label>
                    <select name="ID_FILIERE" id="ID_FILIERE" class="form-control">
                        <?php while($filiere=$resultatf->fetch()){ ?>
                            <option value="<?php echo $filiere['idFiliere']?>"
                                <?php echo $ETUDIANT['idFiliere']==$filiere['idFiliere']?"selected":"" ?>>
                                <?php echo $filiere['nomFiliere']?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <!---- **************************  -->
                <label class="control-label">Civilité</label>
                <div class="radio">
                    <label><input type="radio" name="civilite" value="F" <?php echo $ETUDIANT['civilite']=="F"?"checked":""?>/> F </label><br/>
                    <label><input type="radio" name="civilite" value="M" <?php echo $ETUDIANT['civilite']=="M"?"checked":""?>/> M </label><br/>
                </div>
                <!---- **************************  -->

                <div class="form-group">
                    <label for="PHOTO" class="control-label">PHOTO :</label>
                    <input type="file" name="PHOTO" id="PHOTO"/>
                </div>

                <button type="submit" class="btn btn-primary">Enregistrer</button>

            </form>
        </div>
    </div>



</div>
</body>
</html>



