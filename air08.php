<?php

/**
 * Consigne :
 *
 * Créez un programme qui ajoute à une liste d’entiers triée un nouvel entier tout en gardant la liste triée dans l’ordre croissant. Le dernier argument est l’élément à ajouter.
 *
 * Utilisez une fonction de ce genre (selon votre langage) :
 * sorted_insert(array, new_element) {
 * # your algo
 * return (new_array)
 * }
 *
 * Exemples d’utilisation :
 * $> ruby exo.rb 1 3 4 2
 * 1 2 3 4
 *
 * $> ruby exo.rb 10 20 30 40 50 60 70 90 33
 * 10 20 30 33 40 50 60 70 90
 *
 *
 * Afficher error et quitter le programme en cas de problèmes d’arguments.
 *
 */

/* fonctions */
function isNumeric(string $string) {
    return preg_match('/[0-9]+/', $string) && (!preg_match('/\D/', $string) || in_array(substr($string, 0, 1), ['-', '+']));
}

function sorted_insert(array $array, int $new_element)
{
    $newArray = [];

    $length = count($array);
    $inserted = false;

    for ($i = 0; $i < $length; $i++) {
        if (!$inserted && $new_element < $array[$i]) {
            $newArray[] = $new_element;
            $inserted = true;
        }
        $newArray[] = $array[$i];
    }

    return $newArray;
}

/* gestion d'erreurs */
if ($argc < 2) {
    print "Erreur : Aucun paramêtre.\n";
    exit;
}

if ($argc <= 3) {
    print "Erreur : Manque de paramètre.\n";
    exit;
}

for ($j = 1; $j < $argc; $j++) {
    if (!isNumeric($argv[$j])) {
        print "Erreur : Le paramètre \"$argv[$j]\" n'est pas numérique.\n";
        exit;
    }

    // vérifier que les éléments de la liste sont bien dans l'ordre croissant
    if ($j > 1 && $j < $argc - 1 && $argv[$j] < $argv[$j - 1]) {
        print "Erreur : la liste n'est pas ordonnée dans l'ordre croissant.\n";
        exit;
    }
}

/* récupération des données */
$liste = [];

for ($i = 1; $i < $argc - 1; $i++) {
    $liste[] = intval($argv[$i]);
}

$toInsert = intval($argv[$argc-1]);

/* résolution */
$newList = sorted_insert($liste, $toInsert);

/* affichage */
echo implode(' ', $newList)."\n";
