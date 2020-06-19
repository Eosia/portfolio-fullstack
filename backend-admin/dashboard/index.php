<?php
session_start();

define("URL", str_replace("index.php","",(isset($_SERVER['HTTPS']) ? "https" : "http").
"://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));

require_once "controllers/RealisationsController.controller.php";
require_once "controllers/ServicesController.controller.php";

$realisationController = new RealisationsController;
$serviceController = new ServicesController;

try{
    if(empty($_GET['page'])){
        require "views/realisations.view.php";
    } else {
        $url = explode("/", filter_var($_GET['page']),FILTER_SANITIZE_URL);

        switch($url[0]){
            case "realisations" : 
                if(empty($url[1])){
                    $realisationController->afficherRealisations();
                } else if($url[1] === "l") {
                    $realisationController->afficherRealisations($url[2]);
                } else if($url[1] === "a") {
                    $realisationController->ajoutRealisation();
                } else if($url[1] === "m") {
                    $realisationController->modificationRealisation($url[2]);
                } else if($url[1] === "s") {
                    $realisationController->suppressionRealisation($url[2]);
                } else if($url[1] === "av") {
                    $realisationController->ajoutRealisationValidation();
                } else if($url[1] === "mv") {
                    $realisationController->modificationRealisationValidation();
                }
                else {
                    throw new Exception("La page n'existe pas");
                }
            break;
            case "services" : 
                if(empty($url[1])){
                    $serviceController->afficherServices();
                } else if($url[1] === "l") {
                    $serviceController->afficherServices($url[2]);
                } else if($url[1] === "a") {
                    $serviceController->ajoutService();
                } else if($url[1] === "m") {
                    $serviceController->modificationService($url[2]);
                } else if($url[1] === "s") {
                    $serviceController->suppressionService($url[2]);
                } else if($url[1] === "av") {
                    $serviceController->ajoutServiceValidation();
                } else if($url[1] === "mv") {
                    $serviceController->modificationServiceValidation();
                }
                else {
                    throw new Exception("La page n'existe pas");
                }
            break;
            
        
            default : throw new Exception("La page n'existe pas");
        }
    }
}
catch(Exception $e){
    $msg = $e->getMessage();
    require "views/error.view.php";
}
