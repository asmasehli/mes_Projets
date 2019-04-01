<?php
require_once('connexion_db.php');
$idf=isset($_GET['idF'])?$_GET['idF']:0;
$requete="select * from Filiere where idFiliere=$idf";
$resultat=$pdo->query($requete);
$filiere=$resultat->fetch();
$nomf=$filiere['nomFiliere'];
$niveau=$filiere['niveau'];



?>

<!DOCTYPE html>
<html>
 <head>
    <meta charset="UTF-8">
    <title>Edition d'une Filière</title>
    <script type="text/javascript" src="js.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="../css/monstyle.css" />
 </head>
 <body>
    <?php include("menu.php"); ?>
   <div class="container">

     <div class="panel panel-primary margetop">
                 <div class="panel-heading"> Edition de la filière </div>
                 <div class="panel-body">
                   <form method="post" action="updateFiliere.php" class="form">
                                  <div class="form-group">
                                  <label for="niveau"> id de la filiere: <?php echo $idf ?> </label>
                                  <input type="hidden" name="idf" class="form-control" value="<?php echo $idf ?>"/>
                                  </div>


                                  <div class="form-group">
                                     <label for="niveau"> Nom de la filiere: </label>
                                    <input type="text" name="nomF"  class="form-control" value="<?php echo $nomf ?>"/>
                                    </div>








                                  <div class="form-group">
                                  <label for="niveau"> Niveau: </label>
                                  <select name="niveau" class="form-control" id="niveau" >
                                    <option value="all">
                                    tous les niveaux
                                    </option>

                                    <option value="2" <?php if($niveau=="2") echo "selected"?>>
                                       2ème année
                                    </option>

                                     <option value="3" <?php if($niveau=="3") echo "selected"?>>
                                        3ème année
                                      </option>
                                      <option value="4" <?php if($niveau=="4") echo "selected"?>>
                                         4ème année
                                      </option>
                                      <option value="5" <?php if($niveau=="5") echo "selected"?>>
                                         5ème année
                                      </option>

                                  </select>
                                  </div>

                                  <button type="submit" class="btn btn-success"> <span class="glyphicon glyphicon-save"> </span>
                                    enregistrer ...</button>

                                        </a>


                                </form>


                  </div>
          </div>
    </div>
 </body>
</html>
