<?php
 try {
   $pdo=new PDO("mysql:host=localhost;dbname=gestion_stage","root","root");

 }catch (Exception $e){
  die("erreur de connexion:" .$e->getMessage());
 }


?>