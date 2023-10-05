<?php  
  
session_start();  
// Chargement des classes automatiquement  
require "autoload.php";  
  
$router = new Router();  
// Vérification de la route demandée  
if(isset($_GET["path"]))  
{  // Si un chemin est spécifié dans l'URL, vérifiez si la route correspondante existe
    $router->checkRoute($_GET["path"]);  
}  
else  
{  // Si aucun chemin n'est spécifié, renvoi sur "accueil"
    $router->checkRoute("");  
}