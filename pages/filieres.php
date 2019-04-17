<?php
    require_once('identifier.php');

        include("connexion_db.php");

        if(isset($_GET['nomF']))
          $nomf=$_GET['nomF'];
        else
           $nomf="";
        $niveauf=isset($_GET['niveau'])?$_GET['niveau']:"all";
        $size=isset($_GET['size'])?$_GET['size']:3;
        $page=isset($_GET['page'])?$_GET['page']:1;
        $offset=($page-1)*$size;
        if($niveauf=="all") {
         $requete="select * from filiere
             where nomFiliere like '%$nomf%'
             limit $size
              offset $offset";
          $requeteCount="select count(*) countF from filiere
            where nomFiliere like '%$nomf%'"
            ;
              }
        else {
         $requete="select * from filiere
                     where nomFiliere like '%$nomf%'
                     and niveau='$niveauf'";
         $requeteCount="select count(*) countF from filiere
                      where nomFiliere like '%$nomf%'
                      and niveau='$niveauf'";
         }
        $resultatf=$pdo->query($requete);
        $resultatCount=$pdo->query($requeteCount);
        $tabCount=$resultatCount->fetch();
        $nbrFiliere=$tabCount['countF'];
        $reste=$nbrFiliere % $size;
        if ($reste===0)
          $nbrePage=$nbrFiliere/$size;
        else
        $nbrePage=floor($nbrFiliere/$size)+1;
?>

<!DOCTYPE html>
<html>
 <head>
    <meta charset="UTF-8">
    <title>gestion des filieres</title>

    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="../css/monstyle.css" />
 </head>
 <body>
    <?php include("menu.php"); ?>
    <div class="container">

     <div class="panel panel-success margetop">
            <div class="panel-heading"> Rechercher des filières </div>
            <div class="panel-body">
             <form method="get" action="filieres.php" class="form-inLine">
               <div class="form-group">
               <input type="text" name="nomF" placeholder="taper le nom de la flière" class="form-control">
               </div>
               <label> Niveau </label>
               <select name="niveau" class="form-control" id="niveau" onchange="this.form.submit()">
                 <option value="all">
                 tous les niveaux
                 </option>

                 <option value="2">
                    2ème année
                 </option>

                  <option value="3">
                     3ème année
                   </option>
                   <option value="4">
                      4ème année
                   </option>
                   <option value="5">
                      5ème année
                   </option>

               </select>
               <button type="submit" class="btn btn-success"> <span class="glyphicon glyphicon-search"> </span>
                 chercher ...</button>
                  &nbsp &nbsp

                  <a href="NouvelleFiliere.php">
                  <span class="glyphicon glyphicon-plus"> </span>
                     Nouvelle Filière
                     </a>


             </form>


             </div>
     </div>

     <div class="panel panel-primary ">
                 <div class="panel-heading"> Liste des filières (<?php echo $nbrFiliere ?> Classes)</div>
                 <table>
                 </table>
                 <div class="panel-body">
                   <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                         <th> id Filiere </th>
                         <th> nom Filiere </th>
                         <th> Niveau </th>
                         <th> Actions </th>
                        </tr>
                      </thead>
                      <tbody>

                         <?php while($filiere=$resultatf->fetch()) {


                         ?>
                         <tr>
                         <td> <?php echo $filiere['idFiliere']  ?> </td>
                         <td> <?php echo $filiere['nomFiliere']  ?> </td>
                         <td> <?php echo $filiere['niveau']  ?> </td>
                         <td>

                         <a href="editerFiliere.php?idF=<?php echo $filiere['idFiliere'] ?>"> <span class="glyphicon glyphicon-edit"> </span> </a>
                           &nbsp;
                         <a onclick="return confirm('êtes vous sûrs de vouloir supprimer la filière ?')" href="supprimerFiliere.php?idF=<?php echo $filiere['idFiliere'] ?>"> <span class="glyphicon glyphicon-trash"> </span> </a> </td>

                         </tr>
                         <?php } ?>

                      </tbody>
                   </table>
                   <div>
                   <ul class="pagination">
                   <?php for($i=1;$i<=$nbrePage;$i++){?>

                    <li class="<?php if($i==$page) echo 'active' ?>"> <a href="filieres.php?page=<?php echo $i ; ?> &nomf=<?php echo $nomf  ?> &niveauf=<?php echo $niveauf  ?>">
                     <?php echo $i; ?> </a> </li>

                   <?php } ?>
                   </ul>
                   </div>
                 </div>
          </div>
    </div>
 </body>
</html>
