<?php

spl_autoload_register('chargerClasses');

function chargerClasses($classe)
{
  $fichier = $classe . ".php";
  try {
    if (file_exists(__DIR__ . "/classes/" . $fichier)) {
      require __DIR__ . "/classes/" . $fichier;
    } elseif (file_exists(__DIR__ . "/repositories/" . $fichier)) {
      require __DIR__ . "/repositories/" . $fichier;
    }
    else {
      throw new Error("La classe $classe est introuvable.");
    }
  } catch (Error $e) {
    echo "Une erreur est survenue : " . $e->getMessage();
  }
}

require_once __DIR__ . '/../config.php';

// if (DB_INITIALIZED == FALSE ) {
//   $db = new Database;
//   echo $db->initializeDB();
// }
