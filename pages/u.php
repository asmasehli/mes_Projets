<?php
require_once('identifier.php');

include("connexion_db.php");

if(isset($_GET['login']))
    $login=$_GET['login'];
else
    $login="";

$size=isset($_GET['size'])?$_GET['size']:4;
$page=isset($_GET['page'])?$_GET['page']:1;
$offset=($page-1)*$size;


$requeteUser="select *
          from utilisateur where login like '%$login%'";
$requeteCount="select count(*) countU from utilisateur";

$resultatUser=$pdo->query($requeteUser);
$resultatCount=$pdo->query($requeteCount);
$tabCount=$resultatCount->fetch();
$nbrUser=$tabCount['countU'];
$reste=$nbrUser % $size;
if ($reste===0)
    $nbrePage=$nbrUser/$size;
else
    $nbrePage=floor($nbrUser/$size)+1;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>gestion des utilisateurs</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="../css/monstyle.css" />
</head>
<body>
<?php include("menu.php"); ?>
<div class="container">

    <div class="panel panel-success margetop">
        <div class="panel-heading"> Rechercher des utilisateurs </div>
        <div class="panel-body">
            <form method="get" action="utilisateurs.php" class="form-inLine">
                <div class="form-group">
                    <input type="text" name="login" placeholder="Login" class="form-control"
                           value="<?php echo $login ?>"/>
                </div>

                <button type="submit" class="btn btn-success"> <span class="glyphicon glyphicon-search"> </span>
                    chercher ...</button>
                &nbsp &nbsp



            </form>


        </div>
    </div>

    <div class="panel panel-primary ">
        <div class="panel-heading"> Liste des utilisateurs (<?php echo $nbrUser ?> Utilisateurs)</div>

        <div class="panel-body">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th> ID </th>
                    <th> login  </th>
                    <th> rôle  </th>
                    <th> Actions  </th>

                </tr>
                </thead>
                <tbody>

                <?php while($user=$resultatUser->fetch()) {


                    ?>
                    <tr class="<?php echo $user['etat']==1?'success':'danger'  ?>">
                        <td> <?php echo $user['iduser']  ?> </td>
                        <td> <?php echo $user['login']  ?> </td>
                        <td> <?php echo $user['role']  ?> </td>
                        <td>
                            <a href="editerUser.php?idU=<?php echo $user['iduser'] ?>"> <span class="glyphicon glyphicon-edit"> </span> </a>
                            &nbsp;
                            <a onclick="return confirm('êtes vous sûrs de vouloir le supprimer ?')" href="supprimerUser.php?idU=<?php echo $user['iduser'] ?>"> <span class="glyphicon glyphicon-trash"> </span> </a>
                            &nbsp;
                            <a href="activerUser.php?idU=<?php echo $user['iduser'] ?> &etat=<?php echo $user['etat'] ?>">
                                <?php
                                if($user['etat']== 1)
                                    echo '<span class="glyphicon glyphicon-remove">';
                                else
                                    echo '<span class="glyphicon glyphicon-ok">';

                                ?>
                            </a>
                        </td>
                    </tr>
                <?php } ?>

                </tbody>
            </table>
            <div>
                <ul class="pagination">
                    <?php for($i=1;$i<=$nbrePage;$i++){?>

                        <li class="<?php if($i==$page) echo 'active' ?>"> <a href="utilisateurs.php?page=<?php echo $i ; ?> &login=<?php echo $login  ?>" >
                                <?php echo $i; ?> </a> </li>

                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>
</body>
</html>
