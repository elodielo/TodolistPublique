<?php
session_start();
require './src/init.php';

$userId = $_SESSION['utilisateur']['ID'];

$userRepository = new UtilisateursRepository();
$userRepository->deleteUtilisateur($userId);
session_destroy();

http_response_code(200);
echo "Le compte a été supprimé avec succès !";