<?php
session_start();
require './src/init.php';

if (isset($_POST['taskId'])) {
    // Récupérer l'ID de la tâche à supprimer
    $taskId = $_POST['taskId'];

    // Instancier TachesRepository
    $tachesRepository = new TachesRepository();

    // Appeler la fonction supprimerTache
    $tachesRepository->supprimerTache($taskId);

    // Envoyer une réponse appropriée à la requête AJAX
    http_response_code(200);
} else {
    // Si l'ID de la tâche n'a pas été envoyé avec la requête AJAX, renvoyer un code d'erreur approprié
    http_response_code(400);
    echo "ID de tâche manquant dans la requête.";
}
