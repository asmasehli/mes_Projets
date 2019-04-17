<?php
require_once('identifier.php');

include("connexion_db.php");

if(isset($_GET['nomPrenom']))
    $nomPrenom=$_GET['nomPrenom'];
else
    $nomPrenom="";
$idfiliere=isset($_GET['idFiliere'])?$_GET['idFiliere']:0;
$size=isset($_GET['size'])?$_GET['size']:3;
$page=isset($_GET['page'])?$_GET['page']:1;
$offset=($page-1)*$size;
$requeteFiliere="select * from filiere";



if($idfiliere==0) {
    $requeteStagiaire="select idStagiaire,nom,prenom,nomFiliere,civilite,photo
          from filiere as f,etudiant as s
             where f.idFiliere=s.idFiliere
             and (nomFiliere like '%$nomPrenom%' or prenom like '%$nomPrenom%')
             order by idStagiaire
             limit $size
             offset $offset";
    $requeteCount="select count(*) countS from etudiant
            where nom like '%$nomPrenom%' or prenom like '%$nomPrenom%'"
    ;
}
else {
    $requeteStagiaire="select idStagiaire,nom,prenom,nomFiliere,civilite,photo
                   from filiere as f,etudiant as s
                      where f.idFiliere=s.idFiliere
                      and (nomFiliere like '%$nomPrenom%' or prenom like '%$nomPrenom%')
                      and f.idFiliere=$idfiliere

                      limit $size
                      offset $offset";
    $requeteCount="select count(*) countS from etudiant
                     where (nom like '%$nomPrenom%' or prenom like '%$nomPrenom%')
                     and idFiliere=$idfiliere" ;
}
$resultatFiliere=$pdo->query($requeteFiliere);
$resultatE=$pdo->query($requeteStagiaire);
$resultatCount=$pdo->query($requeteCount);
$tabCount=$resultatCount->fetch();
$nbrStagiaire=$tabCount['countS'];
$reste=$nbrStagiaire % $size;
if ($reste===0)
    $nbrePage=$nbrStagiaire/$size;
else
    $nbrePage=floor($nbrStagiaire/$size)+1;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>gestion des étudiants</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="../css/monstyle.css" />
</head>
<body>
<?php include("menu.php"); ?>
<div class="container">

    <div class="panel panel-success margetop">
        <div class="panel-heading"> Rechercher des stagiaires </div>
        <div class="panel-body">
            <form method="get" action="etudiants.php" class="form-inLine">
                <div class="form-group">
                    <input type="text" name="nomPrenom" placeholder="Nom et prénom" class="form-control"
                           value="<?php echo $nomPrenom ?>"/>
                </div>
                <label for="idFiliere"> Filiere </label>
                <select name="idFiliere" class="form-control" id="idFiliere" onchange="this.form.submit()">


                    <option value=0 > Toutes les filières </option>
                    <?php
                    while($filiere=$resultatFiliere->fetch()){
                        ?>
                        <option value="<?php  echo $filiere['idFiliere']?>"
                            <?php if($filiere['idFiliere']===$idfiliere) echo "selected" ?>>
                            <?php  echo $filiere['nomFiliere']?> </option>

                    <?php } ?>


                    ?>
                </select>
                <button type="submit" class="btn btn-success"> <span class="glyphicon glyphicon-search"> </span>
                    chercher ...</button>
                &nbsp &nbsp
                <a href="NouveauEtudiant.php">
                    <span class="glyphicon glyphicon-plus"> </span>
                    Nouveau Etudiant
                </a>


            </form>


        </div>
    </div>

    <div class="panel panel-primary ">
        <div class="panel-heading"> Liste des Etudiants (<?php echo $nbrStagiaire ?> Etudiants)</div>

        <div class="panel-body">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th> id Etudiant </th>
                    <th> nom  </th>
                    <th> Prénom  </th>
                    <th> Filière  </th>
                    <th> Photo  </th>
                    <th> Actions </th>
                </tr>
                </thead>
                <tbody>

                <?php while($etudiant=$resultatE->fetch()) {


                    ?>
                    <tr>
                        <td> <?php echo $etudiant['idStagiaire']  ?> </td>
                        <td> <?php echo $etudiant['nom']  ?> </td>
                        <td> <?php echo $etudiant['prenom']  ?> </td>
                        <td> <?php echo $etudiant['nomFiliere']  ?> </td>
                        <td>
                            <img src="../images/<?php echo $etudiant['photo']  ?>" width="40px" height="50px" class="img-circle"> </td>
                        <td>

                            <a href="editerEtudiant.php?idS=<?php echo $etudiant['idStagiaire'] ?>">
                                <span class="glyphicon glyphicon-edit"> </span> </a>
                            &nbsp;
                            <a onclick="return confirm('êtes vous sûrs de vouloir le supprimer ?')" href="supprimerEtudiant.php?idS=<?php echo $etudiant['idStagiaire'] ?>"> <span class="glyphicon glyphicon-trash"> </span> </a> </td>

                    </tr>
                <?php } ?>

                </tbody>
            </table>
            <div>
                <ul class="pagination">
                    <?php for($i=1;$i<=$nbrePage;$i++){?>

                        <li class="<?php if($i==$page) echo 'active' ?>">
                            <a href="etudiants.php?page=<?php echo $i ; ?> &nomPrenom=<?php echo $nomPrenom  ?> &idFiliere=<?php echo $idfiliere ?>">
                                <?php echo $i; ?> </a> </li>

                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>
</body>
</html>
