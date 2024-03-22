<?php
require './src/init.php';
$DB = new Database;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $json_data = file_get_contents('php://input');

    if (!empty($json_data)) {
        $data = json_decode($json_data, true);

        if ($data !== null) {
            $nom = $data['nom'];
            $prenom = $data['prenom'];
            $mdp = $data['mdp'];
            $mdp2 = $data['mdp2'];
            $email = $data['email'];

            if ($mdp === $mdp2) {
                $hashMdp = password_hash($mdp, PASSWORD_DEFAULT);

                $utilisateur = new Utilisateur(null, $nom, $prenom, $hashMdp, $email);
                $repoUtilisateur = new UtilisateursRepository();
                $repoUtilisateur->creerUtilisateur($utilisateur);
                
                $utilisateur = $repoUtilisateur->getUtilisateurByMailEtMdp($email, $mdp);

                session_start();
                $_SESSION['utilisateur'] = $utilisateur;
                $_SESSION['connecte'] = true;

                header("Content-Type: application/json");
                echo json_encode($utilisateur);
                exit;
            }

        } else {

            $erreur = "Les mots de passe ne correspondent pas.";
        }
    } else {
        $erreur = "Veuillez remplir tous les champs.";
    }
}

http_response_code(400);
echo json_encode(['error' => 'Requête invalide ou données manquantes']);
