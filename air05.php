<?php

/**
 * Consigne :
 *
 * Créez un programme qui affiche une chaîne de caractères en évitant les caractères identiques adjacents.
 *
 *
 * Exemples d’utilisation :
 * $> python exo.py “Hello milady,   bien ou quoi ??”
 * Helo milady, bien ou quoi ?
 *
 *
 * Afficher error et quitter le programme en cas de problèmes d’arguments.
 *
 */

/* fonctions */
function sanitizeString(string $string): string {
    $outputString = '';

    $chars = str_split($string);
    $stringLength = strlen($string);

    $outputString.=$chars[0];

    for ($i = 1; $i < $stringLength; $i++) {
        // comparer le caractère courant au caractère suivant
        if (sameAsPrevious($chars, $i)) {
            continue;
        }

        $outputString.= $chars[$i];
    }

    return $outputString;
}

function sameAsPrevious(array $array, int $index): bool
{
    return $array[$index] === $array[$index-1];
}

/* gestion d'erreurs */
if ($argc < 2) {
    print "Erreur : Aucun paramêtre.\n";
    exit;
}

if ($argc > 2) {
    print "Erreur : Trop de paramêtre.\n";
    exit;
}

if (strlen($argv[1]) < 2) {
    print "Erreur : Pas assez de caractères à comparer.\n";
    exit;
}

/* récupération des données */
$string = $argv[1];

/* résolution */
$sanitizedString = sanitizeString($string);

/* affichage */
echo $sanitizedString."\n";
