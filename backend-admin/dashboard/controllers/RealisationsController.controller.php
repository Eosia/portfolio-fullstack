<?php
require_once "models/RealisationManager.class.php";

class RealisationsController{
    private $realisationManager;

    public function __construct(){
        $this->realisationManager = new RealisationManager;
        $this->realisationManager->chargementRealisations();
    }

    public function afficherRealisations(){
        $realisations = $this->realisationManager->getRealisations();
        require "views/realisations.view.php";
    }

    public function afficherRealisation($id){
        $realisation = $this->realisationManager->getRealisationById($id);
        require "views/afficherRealisation.view.php";
    }

    public function ajoutRealisation(){
        require "views/ajoutRealisation.view.php";
    }

    public function ajoutRealisationValidation(){
        $file = $_FILES['image'];
        $repertoire = "public/images/";
        $nomImageAjoute = $this->ajoutImage($file,$repertoire);
        $this->realisationManager->ajoutRealisationBd($_POST['titre'],$_POST['lien'],$nomImageAjoute);

        $_SESSION['alert'] = [
            "type" => "success",
            "msg" => "Ajout Réalisé"
        ];

        header('Location: '. URL . "realisations");
    }

    public function suppressionRealisation($id){
        $nomImage = $this->realisationManager->getRealisationById($id)->getImage();
        unlink("public/images/".$nomImage);
        $this->realisationManager->suppressionRealisationBD($id);
        $_SESSION['alert'] = [
            "type" => "success",
            "msg" => "Suppression Réalisée"
        ];
        header('Location: '. URL . "realisations");
    }

    public function modificationRealisation($id){
        $realisation = $this->realisationManager->getRealisationById($id);
        require "views/modifierRealisation.view.php";
    }

    public function modificationRealisationValidation(){
        $imageActuelle = $this->realisationManager->getRealisationById($_POST['identifiant'])->getImage();
        $file = $_FILES['image'];

        if($file['size'] > 0){
            unlink("public/images/".$imageActuelle);
            $repertoire = "public/images/";
            $nomImageToAdd = $this->ajoutImage($file,$repertoire);
        } else {
            $nomImageToAdd = $imageActuelle;
        }
        $this->realisationManager->modificationRealisationBD($_POST['identifiant'],$_POST['titre'],$_POST['lien'],$nomImageToAdd);
        $_SESSION['alert'] = [
            "type" => "success",
            "msg" => "modification Réalisée"
        ];

        header('Location: '. URL . "realisations");
    }

    private function ajoutImage($file, $dir){
        if(!isset($file['name']) || empty($file['name']))
            throw new Exception("Vous devez indiquer une image");

        if(!file_exists($dir)) mkdir($dir,0777);

        $extension = strtolower(pathinfo($file['name'],PATHINFO_EXTENSION));
        $random = rand(0,99999);
        $target_file = $dir.$random."_".$file['name'];

        if(!getimagesize($file["tmp_name"]))
            throw new Exception("Le fichier n'est pas une image");
        if($extension !== "jpg" && $extension !== "jpeg" && $extension !== "png" && $extension !== "gif")
            throw new Exception("L'extension du fichier n'est pas reconnu");
        if(file_exists($target_file))
            throw new Exception("Le fichier existe déjà");
        if($file['size'] > 5000000)
            throw new Exception("Le fichier est trop gros");
        if(!move_uploaded_file($file['tmp_name'], $target_file))
            throw new Exception("l'ajout de l'image n'a pas fonctionné");
        else return ($random."_".$file['name']);
    }
}