<?php 
class Utilisateur {
    private $id;
    private $nom;
    private $prenom;
    private $mdp;
    private $mail;

    function __construct($id, $nom, $prenom, $mdp, $mail){
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->mdp = $mdp;
        $this->mail = $mail;
    }
   
    function getId(){
        return $this->id;
    }

    function setId($id){
        $this->id = $id;
    }

    function getNom(){
        return $this->nom;
    }

    function setNom($nom){
        $this->nom = $nom;
    }
    function getPrenom(){
        return $this->prenom;
    }

    function setPrenom($prenom){
        $this->prenom = $prenom;
    }

    function getMdp(){
        return $this->mdp;
    }

    function setMdp($mdp){
        $this->mdp = $mdp;
    }
    function getMail(){
        return $this->mail;
    }

    function setMail($mail){
        $this->mail = $mail;
    }   

}
?>
