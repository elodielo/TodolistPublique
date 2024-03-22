<?php
require './src/init.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $json_data = file_get_contents('php://input');

    if (!empty($json_data)) {
        $data = json_decode($json_data, true);

        if ($data !== null) {
            $emailCo = $data['emailCo'];
            $mdpCo = $data['mdpCo'];
            $repoUtilisateur = new UtilisateursRepository();
            $utilisateur = $repoUtilisateur->getUtilisateurByMailEtMdp($emailCo, $mdpCo);

            if ($utilisateur !== null) {
                session_start();
                $_SESSION['utilisateur'] = $utilisateur;
                $_SESSION['connecte'] = true;

                $response = $utilisateur;
                // $response = array(
                //     'utilisateur' => $utilisateur,
                //     'connecte' => true
                // );

                header("Content-Type: application/json");
                echo json_encode($response);
                exit;
            } else {
                http_response_code(404);
                echo json_encode(['error' => 'Utilisateur non trouvé']);
            }
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'Données JSON invalides']);
        }
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Aucune donnée envoyée']);
    }
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Méthode non autorisée']);
}
