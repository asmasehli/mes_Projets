<?php
require_once('identifier.php');

include("connexion_db.php");

if(isset($_GET['motCle']))
    $mc=$_GET['motCle'];
else
    $mc="";

if(isset($_GET['ID_FILIERE']))
    $idf=$_GET['ID_FILIERE'];
else
    $idf=0;

if(isset($_GET['size']))
    $size=$_GET['size'];
else
    $size=4;

if(isset($_GET['page']))
    $page=$_GET['page'];
else
    $page=1;

$offset=($page-1)*$size;

if($idf==0){
    $resultat = $pdo->query("SELECT E.idStagiaire,nom,prenom,photo,nomFiliere
								FROM etudiant E,filiere F
								WHERE E.idFiliere=F.idFiliere
								AND (nom like '%$mc%' OR prenom like '%$mc%')
								ORDER BY E.idStagiaire
								LIMIT $size
								OFFSET $offset");

    $resultat2 = $pdo->query("select count(*) as nbrETUDIANT  
								from etudiant 
								where nom like '%$mc%' OR prenom like '%$mc%'");
}
else{
    $resultat = $pdo->query("SELECT E.idStagiaire,nom,prenom,photo,nomFiliere
								FROM etudiant E,filiere F
								WHERE E.idFiliere=F.idFiliere
								AND (nom like '%$mc%' OR prenom like '%$mc%')
								And idFiliere=$idf
								ORDER BY E.idStagiaire
								LIMIT $size
								OFFSET $offset");

    $resultat2 = $pdo->query("select count(*) as nbrETUDIANT 
								from etudiant  
								where (nom like '%$mc%' OR prenom like '%$mc%')
								And idFiliere=$idf");
}


$nbr=$resultat2->fetch();

$nbrPro=$nbr['nbrETUDIANT'];

$reste=$nbrPro % $size; //l'operateur % (modulo) retourne le reste de la
// devision euclidienne de $nbrPro sur $size
if($reste==0)
    $nbrPage=$nbrPro/$size;
else
    $nbrPage=floor($nbrPro/$size)+1;// floor retourne la partie entière d'un nombre
// decimale

$requetef="select * from filiere";
$resultatf = $pdo->query($requetef);

?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8" />
    <title>Gestion des étudiants</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
</head>
<body>
<div id="wrapper">
    <?php include('menu.php');?>

    <div class="container">
        <div class="panel panel-success espace60">
            <div class="panel-heading">Rechercher des étudiants</div>
            <div class="panel-body">
                <form method="get" action="etudiants.php" class="form-inline">
                    <div class="form-group">
                        <select name="ID_FILIERE" id="ID_FILIERE" class="form-control"
                                onChange="this.form.submit();">
                            <option value="0" >Toutes les filières</option>
                            <?php while($filiere=$resultatf->fetch()){ ?>
                                <option value="<?php echo $filiere['idFiliere']?>"
                                    <?php echo $idf==$filiere['idFiliere']?"selected":"" ?>>
                                    <?php echo $filiere['nomFiliere']?>
                                </option>
                            <?php } ?>
                        </select>

                        <input type="text" name="motCle"
                               placeholder="Taper un mot clé"
                               id="motCle" class="form-control"
                               value="<?php echo $mc; ?>"/>
                        <input type="hidden" name="size"  value="<?php echo $size ?>">
                        <input type="hidden" name="page"  value="<?php echo $page ?>">
                        <button type="submit" class="btn btn-success">
                            <i class="glyphicon glyphicon-search"></i>
                            Chercher...
                        </button>
                        &nbsp&nbsp&nbsp

                            <a class="btn btn-success" href="nouveauEtudiant.php">Nouveau étudiant</a>

                    </div>
                </form>
            </div>
        </div>
        <div class="panel panel-primary">
            <div class="panel-heading">

                Liste des étudiants (<?php echo $nbrPro ?> &nbsp étudiants)

            </div>
            <div class="panel-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>NOM</th>
                        <th>PRENOM</th>
                        <th>FILIERE</th>
                        <th>PHOTO</th>

                            <th>ACTIONS</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php while($ETUDIANT=$resultat->fetch()){?>
                        <tr>
                            <td><?php echo $ETUDIANT['idStagiaire'] ?></td>
                            <td><?php echo $ETUDIANT['nom'] ?></td>
                            <td><?php echo $ETUDIANT['prenom'] ?></td>
                            <td><?php echo $ETUDIANT['nomFiliere'] ?></td>
                            <td>
                                <img src="../images/<?php echo $ETUDIANT['photo']?>"
                                     class="img-thumbnail"  width="50" height="40" >
                            </td>
                            <td>

                                    <a href="editerEtudiant.php?ID=<?php echo $ETUDIANT['idStagiaire'] ?>">
                                        <span class="glyphicon glyphicon-pencil"></span>
                                    </a>

                                    &nbsp &nbsp

                                    <a Onclick="return confirm('Etes vous sur de vouloir supprimer étudiant ?')"
                                       href="supprimerEtudiant.php?ID=<?php echo $ETUDIANT['idStagiaire'] ?>">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </a>



                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <div>
                    <ul class="nav nav-pills nav-right">
                        <li>
                            <form class="form-inline">
                                <label>Nombre d'étudiant par Page </label>
                                <input type="hidden" name="ID_FILIERE"
                                       value="<?php echo $idf ?>">
                                <input type="hidden" name="motCle"
                                       value="<?php echo $mc ?>">
                                <input type="hidden" name="page"
                                       value="<?php echo $page ?>">
                                <select name="size" class="form-control"
                                        onchange="this.form.submit()">
                                    <option <?php if($size==5)  echo "selected" ?>>5</option>
                                    <option <?php if($size==10) echo "selected" ?>>10</option>
                                    <option <?php if($size==15) echo "selected" ?>>15</option>
                                    <option <?php if($size==20) echo "selected" ?>>20</option>
                                    <option <?php if($size==25) echo "selected" ?>>25</option>
                                </select>
                            </form>
                        </li>
                        <?php for($i=1;$i<=$nbrPage;$i++){ ?>
                            <li class="<?php if($i==$page) echo 'active' ?>">
                                <a href="etudiants.php?page=<?php echo $i ?>
											&motCle=<?php echo $mc ?>
											&ID_FILIERE=<?php echo $idf ?>
											&size=<?php echo $size ?>">
                                    Page <?php echo $i ?>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>

                </div>

            </div>
        </div>

    </div>
</div>
</body>
</html>