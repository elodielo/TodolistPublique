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

            $nvTache = new Tache(null, $titreTache, $tacheDescription, $tacheJour, $tachePriorite, null);

            $TacheRepo = new TachesRepository();
            $TacheRepo->creerTache($nvTache);
        }
    }
}

http_response_code(400);
echo json_encode(['error' => 'Requête invalide ou données manquantes']);
