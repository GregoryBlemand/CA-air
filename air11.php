<?php

/**
 * Consigne :
 *
 * Créez un programme qui affiche le contenu d’un fichier donné en argument.
 *
 *
 * Exemples d’utilisation :
 * $> cat a.txt
 * Je danse le mia
 * $> ruby exo.rb “a.txt”
 * Je danse le mia
 *
 *
 * Afficher error et quitter le programme en cas de problèmes d’arguments ou de fichier inaccessible.
 *
 */

/* fonctions */

/* gestion d'erreurs */
if ($argc < 2) {
    print "Erreur : Aucun paramêtre.\n";
    exit;
}

if ($argc > 2) {
    print "Erreur : Un seul paramêtre => le chemin du fichier à lire.\n";
    exit;
}

if (!is_file($argv[1])) {
    print "Le fichier \"$argv[1]\" est introuvable.\n";
    exit;
}

/* récupération des données */
$file = $argv[1];

/* résolution */
try {
    $content = file_get_contents($file);
} catch (Exception $e) {
    print $e->getMessage()."\n";
    exit;
}

/* affichage */
echo $content."\n";
