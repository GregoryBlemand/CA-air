<?php

/**
 * Consigne :
 *
 * Créez un programme qui décale tous les éléments d’un tableau vers la gauche. Le premier élément devient le dernier à chaque rotation.
 *
 * Utilisez une fonction de ce genre (selon votre langage) :
 * ma_rotation(array) {
 * # votre algorithme
 * return (new_array)
 * }
 *
 *
 * Exemples d’utilisation :
 * $> python exo.py “Michel” “Albert” “Thérèse” “Benoit”
 * Albert, Thérèse, Benoit, Michel
 *
 *
 * Afficher error et quitter le programme en cas de problèmes d’arguments.
 *
 */

/* fonctions */
function rotate(array $array): array {
    $newArray = $array;

    $newArray[count($array)] = $newArray[0];
    unset($newArray[0]);

    return $newArray;
}

/* gestion d'erreurs */
if ($argc < 2) {
    print "Erreur : Aucun paramêtre.\n";
    exit;
}

if ($argc < 3) {
    print "Erreur : Manque de paramètre.\n";
    exit;
}

/* récupération des données */
$liste = [];

for ($i = 1; $i < $argc; $i++) {
    $liste[] = $argv[$i];
}

/* résolution */
$newList = rotate($liste);

/* affichage */
echo implode(', ', $newList)."\n";
