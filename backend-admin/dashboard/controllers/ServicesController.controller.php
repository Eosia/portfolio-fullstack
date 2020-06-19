<?php
require_once "models/ServiceManager.class.php";

class ServicesController{
    private $serviceManager;

    public function __construct(){
        $this->serviceManager = new ServiceManager;
        $this->serviceManager->chargementServices();
    }

    public function afficherServices(){
        $services = $this->serviceManager->getServices();
        require "views/services.view.php";
    }

    public function afficherService($id){
        $service = $this->serviceManager->getServiceById($id);
        require "views/afficherService.view.php";
    }

    public function ajoutService(){
        require "views/ajoutService.view.php";
    }

    public function ajoutServiceValidation(){
        $file = $_FILES['image'];
        $repertoire = "public/images/";
        $nomImageAjoute = $this->ajoutImage($file,$repertoire);
        $this->serviceManager->ajoutServiceBd($_POST['titre'],$_POST['lien'],$nomImageAjoute);

        $_SESSION['alert'] = [
            "type" => "success",
            "msg" => "Ajout Réalisé"
        ];

        header('Location: '. URL . "services");
    }

    public function suppressionService($id){
        $nomImage = $this->serviceManager->getServiceById($id)->getImage();
        unlink("public/images/".$nomImage);
        $this->serviceManager->suppressionServiceBD($id);
        $_SESSION['alert'] = [
            "type" => "success",
            "msg" => "Suppression Réalisée"
        ];
        header('Location: '. URL . "services");
    }

    public function modificationService($id){
        $service = $this->serviceManager->getServiceById($id);
        require "views/modifierService.view.php";
    }

    public function modificationServiceValidation(){
        $imageActuelle = $this->serviceManager->getServiceById($_POST['identifiant'])->getImage();
        $file = $_FILES['image'];

        if($file['size'] > 0){
            unlink("public/images/".$imageActuelle);
            $repertoire = "public/images/";
            $nomImageToAdd = $this->ajoutImage($file,$repertoire);
        } else {
            $nomImageToAdd = $imageActuelle;
        }
        $this->serviceManager->modificationServiceBD($_POST['identifiant'],$_POST['titre'],$_POST['lien'],$nomImageToAdd);
        $_SESSION['alert'] = [
            "type" => "success",
            "msg" => "modification Réalisée"
        ];

        header('Location: '. URL . "services");
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