<?php

session_start();

require_once "autoload.php";

$router = new Router(); //* Instanciation d'une class Router

//Appel de la function checkRoute de Router.php
if (isset($_GET["route"])) //* Si la variable route est dÃ©finie
{
    $router->checkRoute($_GET["route"]);
} else //* Sinon on appel checkRoute sans valeur
{
    $router->checkRoute("");
}
