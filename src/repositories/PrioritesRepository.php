<?php

require_once __DIR__ . '/../init.php';

class PrioritesRepository {
    private $DB;
    public function __construct(){
        $database = new Database;
        $this->DB = $database->getDB();
    }

    public function getAllPriorites()
    {
        $data = $this->DB->query('SELECT * FROM to_priorites');

        $priorites = [];

        foreach ($priorites as $priorite) {
            $nvPriorite = new Priorite(
                $priorite['idPrio'],
                $priorite['nomPrio'],
            );

            $priorites[] = $nvPriorite;
        }

        return $priorites;
    }

    public function creerPrio($priorite) {
        $sql = "INSERT INTO to_priorites (id, nomPrio) VALUES (?,?)";
        $request = $this->DB->prepare($sql);
        $request->execute([
            null,
            $priorite->getNom(),
        ]);
    }

    public function deletePriorite($PrioId) 
    {
        $sql = 'DELETE FROM to_priorites WHERE id = :id';

        $query = $this->DB->prepare($sql);

        $query->execute([
            'id' => $PrioId
        ]);
    }

    public function getPrioriteById($id) {
        $sql = "SELECT * FROM to_priorites WHERE ID=:id";
        $statement = $this->DB->prepare($sql);
        $statement->execute([':id' =>$id]);
        $retour= $statement->fetch(PDO::FETCH_OBJ);
        return $retour;
      }

      public function getNomById($id) {
        $sql = "SELECT nom FROM to_priorites WHERE ID=:id";
        $statement = $this->DB->prepare($sql);
        $statement->execute([':id' =>$id]);
        $retour= $statement->fetchColumn();
        return $retour;
      }


}