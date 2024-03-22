<?php 


class Tache {
    private $id;
    private $titre;
    private $description;
    private $date;
    private $priorite;
    private $categorie;

    function __construct($id, $titre, $description, $date, $priorite,$categorie){
        $this->id = $id;
        $this->titre = $titre;
        $this->description = $description;
        $this->date = $date;
        $this->priorite = $priorite;
        $this->categorie = $categorie;
    }
   
    function getId(){
        return $this->id;
    }

    function setId($id){
        $this->id = $id;
    }

    function getTitre(){
        return $this->titre;
    }

    function setTitre($titre){
        $this->titre = $titre;
    }
    function getDescription(){
        return $this->description;
    }

    function setDescription($description){
        $this->description = $description;
    }

    function getDate(){
        return $this->date;
    }

    function setDate($date){
        $this->date = $date;
    }
    function getPriorite(){
        return $this->priorite;
    }

    function setPriorite($priorite){
        $this->priorite = $priorite;
    }   
    function getCategorie(){
        return $this->categorie;
    }

    function setCategorie($categorie){
        $this->categorie = $categorie;
    }
}
?>
