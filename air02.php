<?php

/**
 * Consigne :
 *
 * Créez un programme qui découpe une chaîne de caractères en tableau en fonction du séparateur donné en 2e argument.
 *
 * Votre programme devra intégrer une fonction prototypée comme ceci :
 * ma_fonction(string_à_couper, string_séparateur) { // syntaxe selon votre langage
 * # votre algorithme
 * return (tableau)
 * }
 *
 *
 * Exemples d’utilisation :
 * $> python exo.py “Crevette magique dans la mer des étoiles” “la”
 * Crevette magique dans
 * mer des étoiles
 *
 * Afficher error et quitter le programme en cas de problèmes d’arguments.
 */

/* fonctions */
function splitString($string, $separator = " "): array
{
    $array = [];
    $offset = 0;
    $separatorLength = strlen($separator);
    $stringLength = strlen($string);

    // algo
    while (false !== strpos($string, $separator, $offset)){
        $wordIndex = strpos($string, $separator, $offset);

        $array[] = substr($string, $offset, $wordIndex-$offset);

        $offset = $wordIndex + $separatorLength;
    }

    if ($offset < $stringLength) {
        $array[] = substr($string, $offset);
    }

    return $array;
}

/* gestion d'erreurs */
if ($argc < 2) {
    print "Erreur : Aucun paramêtre.\n";
    exit;
}

if ($argc > 3) {
    print "Erreur : Trop de paramêtres.\n";
    exit;
}

/* récupération des données */
$stringToSplit = $argv[1];
$separator = ' ';
if (3 == $argc) {
    $separator = $argv[2];
}

/* résolution */
$output = splitString($stringToSplit, $separator);

/* affichage */
echo implode("\n", $output)."\n";
