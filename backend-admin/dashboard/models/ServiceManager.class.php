<?php
require_once "Model.class.php";
require_once "Service.class.php";

class ServiceManager extends Model{
    private $services;//tableau des services

    public function ajoutService($service){
        $this->services[] = $service;
    }

    public function getServices(){
        $services = [];
        $req = $this->getBdd()->prepare("SELECT * FROM services");
        $req->execute();
        $mesServices = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        foreach($mesServices as $service){
            $l = new Service($service['id'],$service['titre'],$service['lien'],$service['image']);
            $services[] = $l;
        }
        return $services;
    }

    public function chargementServices(){
        $req = $this->getBdd()->prepare("SELECT * FROM services");
        $req->execute();
        $mesServices = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        foreach($mesServices as $service){
            $l = new Service($service['id'],$service['titre'],$service['lien'],$service['image']);
            $this->ajoutService($l);
        }
    }

    public function getServiceById($id){
        for($i=0; $i < count($this->services);$i++){
            if($this->services[$i]->getId() === $id){
                return $this->services[$i];
            }
        }
        throw new Exception("La réalisation n'existe pas");
    }

    public function ajoutServiceBd($titre,$lien,$image){
        $req = "
        INSERT INTO services (titre, lien, image)
        values (:titre, :lien, :image)";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":titre",$titre,PDO::PARAM_STR);
        $stmt->bindValue(":lien",$lien,PDO::PARAM_STR);
        $stmt->bindValue(":image",$image,PDO::PARAM_STR);
        $resultat = $stmt->execute();
        $stmt->closeCursor();

        if($resultat > 0){
            $service = new Service($this->getBdd()->lastInsertId(),$titre,$lien,$image);
            $this->ajoutService($service);
        }
    }

    public function suppressionServiceBD($id){
        $req = "
        Delete from services where id = :idService
        ";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":idService",$id,PDO::PARAM_INT);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
        if($resultat > 0){
            $service = $this->getServiceById($id);
            unset($service);
        }
    }

    public function modificationServiceBD($id,$titre,$lien,$image){
        $req = "
        update services
        set titre = :titre, lien = :lien, image = :image
        where id = :id";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":id",$id,PDO::PARAM_INT);
        $stmt->bindValue(":titre",$titre,PDO::PARAM_STR);
        $stmt->bindValue(":lien",$lien,PDO::PARAM_STR);
        $stmt->bindValue(":image",$image,PDO::PARAM_STR);
        $resultat = $stmt->execute();
        $stmt->closeCursor();

        if($resultat > 0){
            $this->getServiceById($id)->setTitre($titre);
            $this->getServiceById($id)->setTitre($lien);
            $this->getServiceById($id)->setTitre($image);
        }
    }
}