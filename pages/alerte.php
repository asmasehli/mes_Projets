<?php
$msg=isset($_GET['message'])?$_GET['message']:"erreur";

?>

<!DOCTYPE html>
<html>
 <head>
    <meta charset="UTF-8">
    <title>Alerte</title>
    <script type="text/javascript" src="js.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="../css/monstyle.css" />
 </head>
 <body>
    <?php include("menu.php"); ?>
   <div class="container">

     <div class="panel panel-danger margetop">
            <div class="panel-heading"> Erreur </div>
            <div class="panel-body">
             <h3>     <?php  echo $msg ?>        </h3>
             <h4> <a href="<?php echo $_SERVER['HTTP_REFERER']?>" > Retour >>>< </a> </h4>
            </div>
     </div>


 </body>
</html>
