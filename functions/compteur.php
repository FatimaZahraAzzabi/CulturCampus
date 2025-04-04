<?php
session_start();

function ajouter_vue() {
    if (!isset($_SESSION['vue_incrementee'])) { 
        $fichier = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'compteur';
        $compteur = 0; 

        if (file_exists($fichier)) {
            $contenu = file_get_contents($fichier);
            if ($contenu !== false) {
                $compteur = (int)$contenu;
            }
            $compteur++;
        }

        if (file_put_contents($fichier, $compteur) === false) {
            die("Erreur lors de l'écriture dans le fichier compteur.");
        }

        $_SESSION['vue_incrementee'] = true; 
    }
}

function nombre_vue(): string {
    $fichier = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'compteur';

    if (file_exists($fichier)) {
        $contenu = file_get_contents($fichier);
        if ($contenu !== false) {
            return $contenu;
        } else {
            die("Erreur lors de la lecture du fichier compteur.");
        }
    }

    return "0"; 
}

?>