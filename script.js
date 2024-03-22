let boutonAjout = document.getElementById("boutonAjout");
let ListeTaches = document.getElementById("ListeTaches");
let boutonInscription = document.getElementById("inscription");
let boutonConnexion = document.getElementById("Connexion");
let boutonDeconnexion = document.getElementById("Deconnexion");
let messageCo = document.getElementById("messageCo");
let SupprimerCompte = document.getElementById("SupprimerCompte");

if (boutonDeconnexion) {
  boutonDeconnexion.addEventListener("click", deconnexion);
}

if (SupprimerCompte) {
  SupprimerCompte.addEventListener("click", supprimerCompte);
}

let Poubelles = document.querySelectorAll(".poubelle");
Poubelles.forEach(function (poubelle) {
  poubelle.addEventListener("click", supprimerTache);
});

function supprimerTache() {
  let IdTacheAeffacer = this.getAttribute("data-task-id");

  const requeteAjax = new XMLHttpRequest();
  requeteAjax.open("POST", "suppressionTache.php", true);
  requeteAjax.setRequestHeader(
    "Content-Type",
    "application/x-www-form-urlencoded"
  );
  requeteAjax.send("taskId=" + IdTacheAeffacer);
  requeteAjax.onreadystatechange = function () {
    if (requeteAjax.readyState === 4 && requeteAjax.status === 200) {
      let divTache = document.getElementById("task_" + IdTacheAeffacer);
      if (divTache) {
        divTache.parentNode.removeChild(divTache);
      }
      console.log("La tâche a été supprimée avec succès.");
    } else if (this.readyState === XMLHttpRequest.DONE) {
      console.error(
        "Une erreur s'est produite lors de la suppression de la tâche."
      );
    }
  };
  requeteAjax.send("taskId=" + IdTacheAeffacer);
}
if(boutonAjout){
boutonAjout.addEventListener("click", appelAjax);}

if(boutonInscription){
boutonInscription.addEventListener("click", appelAjaxInscription);}
if(boutonConnexion){
boutonConnexion.addEventListener("click", appelAjaxConnexion);}

function appelAjax(event) {
  event.preventDefault();
  let titreTache = document.getElementById("nomTache").value.trim();
  let description = document.getElementById("descriptionTache").value.trim();
  let prioriteTache = document.getElementById("prioriteTache").value.trim();
  let dateTache = document.getElementById("dateTache").value.trim();
 
  const requeteAjax = new XMLHttpRequest();
  requeteAjax.open("POST", "traitement.php", true);
  requeteAjax.setRequestHeader("content-type", "application/json");
  if (titreTache != '') {
  requeteAjax.send(
    JSON.stringify({
      titreTache: titreTache,
      description: description,
      prioriteTache: prioriteTache,
      dateTache: dateTache,
    })
  );
  requeteAjax.onreadystatechange = function () {
    if (requeteAjax.readyState === 4 && requeteAjax.status === 200) {
      RepAjax = requeteAjax.responseText;
    }
    window.location.reload();
  };
  }else {
    alert("Veuillez remplir le titre.");
    return;
}}

function appelAjaxInscription(event) {
  event.preventDefault();
  let nom = document.getElementById("nom").value;
  let prenom = document.getElementById("prenom").value;
  let email = document.getElementById("email").value;
  let mdp = document.getElementById("mdp").value;
  let mdp2 = document.getElementById("mdp2").value;

  if (nom === '' || prenom === '' || email === '' || mdp === '' || mdp2 === '') {
    alert("Veuillez remplir tous les champs.");
    return;
  }

  if (mdp === mdp2) {
    const requeteAjax = new XMLHttpRequest();
    requeteAjax.open("POST", "traitementUtilisateur.php", true);
    requeteAjax.setRequestHeader("content-type", "application/json");
    requeteAjax.onreadystatechange = function () {
      if (requeteAjax.readyState === 4 && requeteAjax.status === 200) {
        RepAjax = JSON.parse(requeteAjax.responseText);
      }
    };
    if (nom != '' || prenom != '' || email != '' || mdp != '' ) {

    
    requeteAjax.send(
      JSON.stringify({
        nom: nom,
        prenom: prenom,
        email: email,
        mdp: mdp,
        mdp2: mdp2,
      })
    );

    requeteAjax.onreadystatechange = function () {
      if (requeteAjax.readyState === 4 && requeteAjax.status === 200) {
        RepAjax = JSON.parse(requeteAjax.responseText);
        window.location.reload();
      }
    };
  } else {
    alert("Les mots de passe ne correspondent pas");
  }}else {
    alert("Veuillez remplir tous les champs.");
    return;
  }
}

function appelAjaxConnexion(event) {
  event.preventDefault();
  let emailCo = document.getElementById("emailCo").value;
  let mdpCo = document.getElementById("mdpCo").value;

  const requeteAjax = new XMLHttpRequest();
  requeteAjax.open("POST", "traitementConnexion.php", true);
  requeteAjax.setRequestHeader("content-type", "application/json");
  requeteAjax.send(
    JSON.stringify({
      emailCo: emailCo,
      mdpCo: mdpCo,
    })
  );
  requeteAjax.onreadystatechange = function () {
    if (requeteAjax.readyState === 4 && requeteAjax.status === 200) {
      RepAjax = JSON.parse(requeteAjax.responseText);
      console.log(RepAjax);

      window.location.reload();
    } else {
      messageCo.innerHTML = "erreur d'email ou de mot de passe";
    }
  };
}

function deconnexion(event) {
  event.preventDefault();
  console.log("coucou");
  var req = new XMLHttpRequest();
  req.open("POST", "deconnexion.php", true);
  req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  req.send();
  req.onreadystatechange = function () {
    if (req.readyState == 4 && req.status == 200) {
      window.location.reload();
    }
  };
}

function supprimerCompte(event) {
  event.preventDefault();
  if (confirm("Êtes-vous sûr de vouloir retirer votre compte ?")) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "suppressionCompte.php", true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
          alert("Compte retiré avec succès !");
          
          window.location.reload();
          return;
      }
      else {
      alert("Erreur lors du retrait du compte.");
    }
    }
    xhr.send({});
    };
  }
