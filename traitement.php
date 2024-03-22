<?php
session_start();
require './src/init.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $json_data = file_get_contents('php://input');

    if (!empty($json_data)) {
        $data = json_decode($json_data, true);

        if ($data !== null) {
            $titreTache = $data['titreTache'];
            $tacheDescription = $data['description'];
            $tacheJour = $data['dateTache'];
            $tachePriorite = $data['prioriteTache'];

            // Création de l'objet Tache

            $nvTache = new Tache(null, $titreTache, $tacheDescription, $tacheJour, $tachePriorite, null);

            $TacheRepo = new TachesRepository();
            $TacheRepo->creerTache($nvTache);
        }
    }
}

// Si la méthode de requête n'est pas POST ou si aucune donnée n'a été envoyée, renvoyer une réponse d'erreur
http_response_code(400);
echo json_encode(['error' => 'Requête invalide ou données manquantes']);
