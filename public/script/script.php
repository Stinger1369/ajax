<?php

// Charger le contenu du fichier CSV d'origine
$filename = "villes.csv";
$content = file_get_contents($filename);

// Diviser le contenu en lignes
$lines = explode("\n", $content);

// Préparer l'instruction SQL INSERT
$output = "INSERT IGNORE INTO ville (id_ville, nom_ville, code_insee, code_postal, id_departement) VALUES\n";

// Traiter chaque ligne
foreach ($lines as $key => $line) {
    $parts = explode(";", $line, 2);

    if (count($parts) > 1) {
        $fields = explode(";", $parts[1]);
        if (count($fields) == 4) {
            // Remplacer l'apostrophe dans le nom de la ville
            $nom_ville = str_replace("'", "''", trim($fields[0]));
            $output .= "(" . ($key + 1) . ", '" . $nom_ville . "', '" . trim($fields[1]) . "', '" . trim($fields[2]) . "', '" . trim($fields[3]) . "')";
            if ($key < count($lines) - 2) {
                $output .= ",\n";
            } else {
                $output .= ";\n";
            }
        }
    }
}

// Enregistrer le contenu modifié dans un nouveau fichier SQL
$new_filename = "votre_fichier_modifie.sql";
file_put_contents($new_filename, $output);

echo "Le fichier modifié a été sauvegardé sous le nom: " . $new_filename . "\n";