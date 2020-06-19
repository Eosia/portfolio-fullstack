<?php
require_once "Model.class.php";
require_once "Realisation.class.php";

class RealisationManager extends Model{
    private $realisations;//tableau de la realisation

    public function ajoutRealisation($realisation){
        $this->realisations[] = $realisation;
    }

    public function getRealisations(){
        $realisations = [];
        $req = $this->getBdd()->prepare("SELECT * FROM realisations");
        $req->execute();
        $mesRealisations = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        foreach($mesRealisations as $realisation){
            $l = new Realisation($realisation['id'],$realisation['titre'],$realisation['lien'],$realisation['image']);
            $realisations[] = $l;
        }
        return $realisations;
    }

    public function chargementRealisations(){
        $req = $this->getBdd()->prepare("SELECT * FROM realisations");
        $req->execute();
        $mesRealisations = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        foreach($mesRealisations as $realisation){
            $l = new Realisation($realisation['id'],$realisation['titre'],$realisation['lien'],$realisation['image']);
            $this->ajoutRealisation($l);
        }
    }

    public function getRealisationById($id){
        for($i=0; $i < count($this->realisations);$i++){
            if($this->realisations[$i]->getId() === $id){
                return $this->realisations[$i];
            }
        }
        throw new Exception("La réalisation n'existe pas");
    }

    public function ajoutRealisationBd($titre,$lien,$image){
        $req = "
        INSERT INTO realisations (titre, lien, image)
        values (:titre, :lien, :image)";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":titre",$titre,PDO::PARAM_STR);
        $stmt->bindValue(":lien",$lien,PDO::PARAM_STR);
        $stmt->bindValue(":image",$image,PDO::PARAM_STR);
        $resultat = $stmt->execute();
        $stmt->closeCursor();

        if($resultat > 0){
            $realisation = new Realisation($this->getBdd()->lastInsertId(),$titre,$lien,$image);
            $this->ajoutRealisation($realisation);
        }
    }

    public function suppressionRealisationBD($id){
        $req = "
        Delete from realisations where id = :idRealisation
        ";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":idRealisation",$id,PDO::PARAM_INT);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
        if($resultat > 0){
            $realisation = $this->getRealisationById($id);
            unset($realisation);
        }
    }

    public function modificationRealisationBD($id,$titre,$lien,$image){
        $req = "
        update realisations
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
            $this->getRealisationById($id)->setTitre($titre);
            $this->getRealisationById($id)->setTitre($lien);
            $this->getRealisationById($id)->setTitre($image);
        }
    }
}