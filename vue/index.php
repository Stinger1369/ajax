<?php
ini_set('display_errors', 1);
session_start();
include '../config/Database.php';
include '../Model/Region.php';
include '../Model/Ville.php';
include '../Model/Map.php';

$connexion = new Database;
$maBase = $connexion->connexion();

?>
<!doctype html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Exemple de sélection de région, département et ville avec Ajax & JQuery">
  <meta name="author" content="Ryad Afpa Roubaix">
  <meta name="generator" content="">
  <title>Exemple de sélection de région, département et ville</title>
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.css">
  <script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>
  <link href="../assets/css/floating-labels.css" rel="stylesheet">

  <script>
    function AjaxDepartement(regionId) {
      $.ajax({
        type: 'POST',
        url: '../model/ajax/AjaxDepartement.php',
        data: {
          region: regionId
        },
        success: function(data) {
          $('#departement').html(data);
        },
      });
    }

    function getVille(departementId) {
      $.ajax({
        type: 'POST',
        url: '../model/ajax/AjaxVille.php',
        data: {
          departement: departementId
        },
        success: function(data) {
          $('#ville').html(data);
        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.log('Erreur : ' + textStatus + ' | ' + errorThrown);
        },
      });
    }
  </script>
</head>

<body>
  <form class="form-signin" method="POST" action="">
    <div class="text-center mb-4">
      <h1 class="h3 mb-3 font-weight-normal">Exemple de sélection de région, département et ville avec ajax & jquery</h1>
    </div>
    <div class="form-label-group">
      <select class="custom-select d-block w-100" id="region" name="region" onchange="AjaxDepartement(this.value);" required>
        <?php Region::GetAllRegion(); ?>
      </select>
    </div>
    <div class="form-label-group">
      <select class="custom-select d-block w-100" id="departement" name="departement" onChange="getVille(this.value);" required>
        <option value="">Choisissez un département</option>
      </select>
    </div>
    <div class="form-label-group">
      <select class="custom-select d-block w-100" id="ville" name="ville" required>
        <option value="">Choisissez une ville</option>
      </select>
    </div>
    <br>
    <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Valider</button>
    <br>
    <div class="form-label-group text-center">
      <?php if (isset($_POST['ville'])) { ?>
        <div class="alert alert-primary" role="alert">
          <?php
          $selectedVille = Ville::GetVilleById($_POST['ville']);
          if ($selectedVille !== null) {
            echo $selectedVille->getNomVille();
          ?>
        </div>
    <?php
            $villeId = $_POST['ville'];
            $villeName = $selectedVille->getNomVille();
            $map = new Map($villeId, $villeName);
            echo $map->getMapHTML();
          }
        }; ?>
    </div>

    <p class="mt-5 mb-3 text-muted text-center">&copy; Afpa Roubaix 2016-2019</p>
  </form>
</body>

</html>