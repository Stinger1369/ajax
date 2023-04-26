<?php
require_once '../../config/Database.php';
require_once '../../Model/Ville.php';
if (!empty($_POST["departement"])) {
  Ville::GetVilleByIdDepartement($_POST["departement"]);
}
