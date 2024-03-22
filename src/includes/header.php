<?php 

?>
<nav class="navbar  p-3 mb-2 bg-warning-subtle text-warning-emphasis border border-warning">

<div class="container-fluid">
    <a class="navbar-brand css-flame-text">Ma Super TODOLIST</a>
    <form class="d-flex" role="search">
    <?php if(!isset($_SESSION['connecte'])) { ?>
    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Inscription
    </button>
    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
        Connexion
    </button>
<?php } ?>
<?php if(isset($_SESSION['connecte'])) { ?>
    <button id="Deconnexion" type="button" class="btn btn-warning" >
        Deconnexion
    </button>
    <button id="SupprimerCompte" type="button" class="btn btn-warning" >
        Supprimer compte
    </button>

<?php } ?>
  </div>
<!-- Modale d'inscription -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Inscription</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body d-flex flex-column mb-3">
        <form action="traitementUtilisateur.php" method="post">
          <label for="nom">Nom :</label>
          <input type="text" name="nom" id="nom" required autocomplete="off">
          <label for="prenom">Prénom :</label>
          <input type="text" name="prenom" id="prenom" required autocomplete="off">
          <label for="email">Email :</label>
          <input type="email" name="email" id="email" required autocomplete="email">
          <label for="mdp">Mot de passe :</label>
          <input type="password" name="mdp" id="mdp" required autocomplete="new-password">
          <label for="mdp2">Vérification mot de passe :</label>
          <input type="password" name="mdp2" id="mdp2" required autocomplete="new-password">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
        <input type="submit" class="btn btn-primary" value="inscription" id="inscription">
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal de connexion -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Connexion</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post">
      <div class="modal-body d-flex flex-column mb-3">
          <label for="emailCo">Email :</label>
          <input type="email" name="emailCo" id="emailCo" required autocomplete="email">
          <label for="mdpCo">Mot de passe :</label>
          <input type="password" name="mdpCo" id="mdpCo" required autocomplete="current-password">
      </div>
      <div class="modal-footer">
        <div id="messageCo"> </div>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
        <input type="submit" class="btn btn-primary" value="Connexion" id="Connexion">

      </div>
      </form>
    </div>
  </div>
</div>

    </div>
  </div>
</div>
</nav>