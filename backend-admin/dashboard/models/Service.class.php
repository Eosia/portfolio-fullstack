<?php
class Service{
    public $id;
    public $titre;
    public $lien;
    public $image;

    public function __construct($id,$titre,$lien,$image){
        $this->id = $id;
        $this->titre = $titre;
        $this->lien = $lien;
        $this->image = $image;
    }

    public function getId(){return $this->id;}
    public function setId($id){$this->id = $id;}

    public function getTitre(){return $this->titre;}
    public function setTitre($titre){$this->titre = $titre;}

    public function getLien(){return $this->lien;}
    public function setLien($lien){$this->lien = $lien;}

    public function getImage(){return $this->image;}
    public function setImage($image){$this->image = $image;}
}