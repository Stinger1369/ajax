<?php
        require_once '../../config/Database.php';
        require_once '../../Model/Departement.php';
        if (!empty($_POST["region"])) {
           Departement::GetDepartementByIdRegion($_POST["region"]);
        }
?>