<?php
?>
<h2> Ajout d'une tâche </h2>
<div class="container p-3 mb-2 bg-warning-subtle text-warning-emphasis border border-warning">

  <div class="form-group">
    <label for="nom">Entrez la tâche</label>
    <input required type="text" minlength="3" maxlength="50" class="form-control" id="nomTache" placeholder="Entrez une tâche">
  </div>

  <div class="mb-3">
    <label for="descriptionTache" class="form-label">Description de la tâche</label>
    <textarea class="form-control" id="descriptionTache" minlength="3" maxlength="50" rows="1"></textarea>
  </div>

  <select required class="form-select" id="prioriteTache" aria-label="Default select example">
    <option value="1">Sans pression</option>
    <option value="2">Important</option>
    <option value="3">Urgent</option>
  </select>
  <div class="p-2">
    <label required for="dateTache">Start date:</label>
    <input type="date" id="dateTache" name="trip-start" value="2024-02-22" min="2018-01-01" max="2025-12-31" required />
  </div>
  <div class="d-flex justify-content-center">
    <button class="btn btn-primary" type="submit" id="boutonAjout">Ajout</button>
  </div>
</div>