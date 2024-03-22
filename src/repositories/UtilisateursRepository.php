<?php

class UtilisateursRepository
{
    private $DB;
    public function __construct()
    {
        $database = new Database;
        $this->DB = $database->getDB();
    }

    public function getAllUtilisateurs()
    {
        $sql = "SELECT * FROM to_utilisateurs;";
        $retour = $this->DB->query($sql);
        $UtilisateursList = [];
        foreach ($retour as $utilisateur) {
            $nvUtilisateur = new Utilisateur(
                ($utilisateur['ID']),
                ($utilisateur['nom']),
                ($utilisateur['prenom']),
                ($utilisateur['mdp']),
                ($utilisateur['mail'])
            );
            $UtilisateursList[] = $nvUtilisateur;
        }
        var_dump($UtilisateursList);
        return $UtilisateursList;
    }

    public function getUtilisateurById($id)
    {
        $sql = "SELECT * FROM to_utilisateurs WHERE ID=:id";
        $statement = $this->DB->prepare($sql);
        $statement->execute([':id' => $id]);
        $retour = $statement->fetch(PDO::FETCH_OBJ);
        return $retour;
    }

    public function getUtilisateurByMailEtMdp($email, $mdp)
    {   
        $sql = "SELECT * FROM to_utilisateurs WHERE mail=:email";
        $statement = $this->DB->prepare($sql);
        $statement->execute([':email' => $email]);

        $utilisateur = $statement->fetch(PDO::FETCH_ASSOC);
        if($utilisateur){
        if(password_verify($mdp, $utilisateur['mdp'])){
            return $utilisateur;
        } else {
            echo "mot de passe erronne";
        }} else {
            echo "utilisateur inconnu";
        }
        
    }


    public function deleteUtilisateur($idUtilisateur)
    {  $request1 = 'DELETE FROM to_taches WHERE ID_Utilisateurs = :id';
        $query1 = $this->DB->prepare($request1);

        $query1->execute([
            'id' => $idUtilisateur
        ]);
        
        $request = 'DELETE FROM to_utilisateurs WHERE id = :id';

        $query = $this->DB->prepare($request);

        $query->execute([
            'id' => $idUtilisateur
        ]);
    }

    public function creerUtilisateur($utilisateur)
    {
        try {
            $sql = "INSERT INTO to_utilisateurs (nom, prenom, mdp, mail) VALUES (?,?,?,?)";
            $request = $this->DB->prepare($sql);
            $request->execute([
                $utilisateur->getNom(),
                $utilisateur->getPrenom(),
                $utilisateur->getMdp(),
                $utilisateur->getMail(),
            ]);
            return true;
        } catch (PDOException $e) {
            error_log("Erreur lors de la création de l'utilisateur : " . $e->getMessage());
            return false;
        }
    }
}
