<?php
session_start();
require './src/init.php';

if (isset($_POST['taskId'])) {
    $taskId = $_POST['taskId'];

    $tachesRepository = new TachesRepository();

    $tachesRepository->supprimerTache($taskId);

    http_response_code(200);
} else {
    http_response_code(400);
    echo "ID de tâche manquant dans la requête.";
}
