<?php 


class Priorite {
    private $idPrio;
    private $nomPrio;

    function __construct($idPrio, $nomPrio){
        $this->idPrio = $idPrio;
        $this->nomPrio = $nomPrio;
    }
   
    function getId(){
        return $this->idPrio;
    }

    function setId($idPrio){
        $this->idPrio = $idPrio;
    }

    function getNomPrio(){
        return $this->titre;
    }

    function setNomPrio($nomPrio){
        $this->nomPrio = $nomPrio;
    }
   
}
?>
