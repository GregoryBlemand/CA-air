<?php

/**
 * Consigne :
 *
 * Créez un programme qui découpe une chaîne de caractères en tableau (séparateurs : espaces, tabulations, retours à la ligne).
 *
 * Votre programme devra utiliser une fonction prototypée comme ceci :
 * ma_fonction(string_à_couper, string_séparateur) { // syntaxe selon votre langage
 * # votre algorithme
 * return (tableau)
 * }
 *
 *
 * Exemples d’utilisation :
 * $> python exo.py “Bonjour les gars”
 * Bonjour
 * les
 * gars
 *
 * Afficher error et quitter le programme en cas de problèmes d’arguments.
 */

/* fonctions */
function splitString($string, $separator = " "): array
{
    $array = [];
    $chars = str_split($string);
    $wordIndex = 0;

    // algo
    foreach ($chars as $char) {
        if ($char == $separator) {
            $wordIndex++;
            continue;
        }

        if (!isset($array[$wordIndex])) {
            $array[$wordIndex] = '';
        }

        $array[$wordIndex] .= $char;
    }

    return $array;
}

/* gestion d'erreurs */
const VALID_SEPARATORS = [' ', "\t", "\n"];
if ($argc < 2) {
    print "Erreur : Aucun paramêtre.\n";
    exit;
}

if ($argc > 3) {
    print "Erreur : Trop de paramêtres.\n";
    exit;
}

if (
    3 == $argc
    && !in_array($argv[2], VALID_SEPARATORS)
    ) {
    print "Erreur : Séparteur invalide.'".$argv[2]."'\n";
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