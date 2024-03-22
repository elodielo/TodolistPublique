<?php
require_once './src/init.php';

class TachesRepository {
    private $DB;
    public function __construct(){
        $database = new Database;
        $this->DB = $database->getDB();
    }

    public function getAllTaches()
    {
        $data = $this->DB->query('SELECT * FROM to_taches');

        $taches = [];

        foreach ($data as $tache) {
            $nvTache = new Tache(
                $tache['ID'],
                $tache['titre'],
                $tache['description'],
                $tache['jour'],
                $tache['ID_Priorites'],
                $tache['ID_Utilisateurs'],
            );

            $taches[] = $nvTache;
        }

        return $taches;
    }

    public function creerTache($tache) {
        $utilisateur = $_SESSION['utilisateur'];
        $sql = "INSERT INTO to_taches (titre, description, jour, ID_Priorites, ID_Utilisateurs) VALUES (?,?,?,?,?)";
        $request = $this->DB->prepare($sql);
        $request->execute([
            $tache->getTitre(),
            $tache->getDescription(),
            $tache->getDate(),
            $tache->getPriorite(),
            $utilisateur['ID']
        ]);
    }

    public function supprimerTache($TacheId) 
    {
        $sql = 'DELETE FROM to_taches WHERE id = :id';

        $query = $this->DB->prepare($sql);

        $query->execute([
            'id' => $TacheId
        ]);
    }

    public function getTacheById($id) {
        $sql = "SELECT * FROM to_taches WHERE ID=:id";
        $statement = $this->DB->prepare($sql);
        $statement->execute([':id' =>$id]);
        $retour= $statement->fetch(PDO::FETCH_OBJ);
        return $retour;
      }

      public function getAllTachesParIDUtilisateur($IdUtilisateur)
      {
          $sql = "SELECT * FROM `to_taches` WHERE `ID_Utilisateurs` = :id";
          $statement = $this->DB->prepare($sql);
          $statement->execute([':id' => $IdUtilisateur]);
          
          $taches = [];
      
          foreach ($statement->fetchAll(PDO::FETCH_ASSOC) as $tache) {
              $nvTache = new Tache(
                  $tache['ID'],
                  $tache['titre'],
                  $tache['description'],
                  $tache['jour'],
                  $tache['ID_Priorites'],
                  $tache['ID_Utilisateurs']
              );
      
              $taches[] = $nvTache;
          }
      
          return $taches;
      }
      


    }