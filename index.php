<?php
session_start();
require_once './src/init.php';

  if (isset($_SESSION['connecte']) && !empty($_SESSION['utilisateur'])) {
    $utilisateur = $_SESSION['utilisateur'];
    //echo "Coucou " . $utilisateur->getPrenom() . " et bienvenue sur ta todolist";
    echo "Bonjour " . $utilisateur['prenom'] . " et bienvenue sur ta todolist.";
    // 1ere ligne pour inscription
    // 2eme pour connexion
  } else {
    echo "Tu dois d'abord te connecter pour accéder à ta todolist.";
  }
  ?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="script.js" defer></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="./assets/style.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <title>ToDoList</title>
</head>

<body>
  <?php
  include "./src/includes/header.php";
  ?>


  <?php include "./src/includes/formulaire.php"
  ?>
  <h2> A faire </h2>
  <div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
      Actions
    </button>
    <ul class="dropdown-menu">
      <li><a class="dropdown-item" href="#">Trier par urgence</a></li>
      <li><a class="dropdown-item" href="#">Trier par date</a></li>
      <li><a class="dropdown-item" href="#">Tout effacer</a></li>
    </ul>
  </div>
  <div id="ListeTaches">
    <?php
    if (isset($_SESSION['connecte']) && !empty($_SESSION['utilisateur'])) {
      $TachesRepository = new TachesRepository;
      $taches = $TachesRepository->getAllTachesParIDUtilisateur($utilisateur['ID']);
       //$taches = $TachesRepository->getAllTachesParIDUtilisateur($utilisateur->getId());
      // 1ere ligne pour inscription
      // 2eme pour connexion
      $priorite = new PrioritesRepository;
      foreach ($taches as $tache) {
        $nompriorite = $priorite->getNomById($tache->getPriorite());
        $couleurClasse = '';
        if ($tache->getPriorite() == '1') {
          $couleurClasse = 'text-info';
        } elseif ($tache->getPriorite() == '2') {
          $couleurClasse = 'text-warning';
        } elseif ($tache->getPriorite() == '3') {
          $couleurClasse = 'text-danger';
        }
        echo ('<div id="task_' . $tache->getId() . '" class="divList container bg-warning-subtle text-warning-emphasis border border-warning">
      <ul class="list-group">
      <li class="list-group-item d-flex justify-content-around .text-info

" data-bs-toggle="tooltip" data-bs-placement="top" title="' . $tache->getDescription() . '">
              <input class="form-check-input me-1" type="checkbox" value="" id="firstCheckbox">
              <label class="form-check-label" for="firstCheckbox">' . $tache->getTitre() . '</label>
              <span id="prio_' . $tache->getPriorite() . '" class="bouton ' . $couleurClasse . '">' . $nompriorite . '</span>
              <span class="badge text-bg-light">' . $tache->getDate() . '</span>
              <svg class="poubelle" data-task-id="' . $tache->getId() . '" xxmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                  <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
              </svg>
          </li>
          
      </ul>
  </div>');
      }
    }

    ?>


  </div>

</body>

</html>