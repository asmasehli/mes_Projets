<!DOCTYPE html>
<html>
 <head>
    <meta charset="UTF-8">
    <title>Nouvelle Filière</title>
    <script type="text/javascript" src="js.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="../css/monstyle.css" />
 </head>
 <body>
    <?php include("menu.php"); ?>
   <div class="container">

     <div class="panel panel-primary margetop">
                 <div class="panel-heading"> veuillez saisir les données de la nouvelle filière </div>
                 <div class="panel-body">
                   <form method="post" action="insertFiliere.php" class="form">
                                  <div class="form-group">
                                  <label for="niveau"> Nom de la filiere: </label>
                                  <input type="text" name="nomF" placeholder="taper le nom de la flière" class="form-control">
                                  </div>
                                  <div class="form-group">
                                  <label> Niveau </label>
                                  <select name="niveau" class="form-control" id="niveau" >
                                    <option value="all">
                                    tous les niveaux
                                    </option>

                                    <option value="2">
                                       2ème année
                                    </option>

                                     <option value="3">
                                        3ème année
                                      </option>
                                      <option value="4" selected>
                                         4ème année
                                      </option>
                                      <option value="5">
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
