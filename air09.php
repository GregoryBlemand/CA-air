<?php

/**
 * Consigne :
 *
 * Créez un programme qui fusionne deux listes d’entiers triées en les gardant triées, les deux listes seront séparées par un “fusion”.
 *
 * Utilisez une fonction de ce genre (selon votre langage) :
 * sorted_fusion(array1, array2) {
 * # your algo
 * return (new_array)
 * }
 *
 *
 * Exemples d’utilisation :
 * $> ruby exo.rb 10 20 30 fusion 15 25 35
 * 10 15 20 25 30 35
 *
 *
 * Afficher error et quitter le programme en cas de problèmes d’arguments.
 *
 */

/* fonctions */
function isNumeric(string $string) {
    return preg_match('/[0-9]+/', $string) && (!preg_match('/\D/', $string) || in_array(substr($string, 0, 1), ['-', '+']));
}

function sorted_fusion(array $list1, array $list2): array {
    $sortedList = $list1;
    $startFrom = 0;

    $length = count($list2);

    for ($i = 0; $i < $length; $i++) {
        [$startFrom, $sortedList] = sorted_insert($sortedList, $list2[$i], $startFrom);
    }

    return $sortedList;
}

function sorted_insert(array $array, int $new_element, $startFrom = 0)
{
    $newArray = [];

    $length = count($array);
    $inserted = false;

    for ($i = 0; $i < $length; $i++) {

        if ($startFrom > $i) {
            $newArray[] = $array[$i];
            continue;
        }

        if (!$inserted && $new_element < $array[$i]) {
            $newArray[] = $new_element;
            $inserted = true;
            $startFrom = $i;
        }
        $newArray[] = $array[$i];
    }

    if (!$inserted) {
        $newArray[] = $new_element;
        $startFrom = $length;
    }

    return [$startFrom, $newArray];
}

/* gestion d'erreurs */
$fusion = 0;
for ($i = 1; $i < $argc; $i++) {
    if ("fusion" !== $argv[$i] && !isNumeric($argv[$i])) {
        print "Erreur : Le paramètre \"$argv[$i]\" n'est pas numérique.\n";
        exit;
    }

    if ("fusion" == $argv[$i]) {
        $fusion++;
    }

    if ($fusion > 1) {
        print "Erreur : Le paramètre \"$i\" est le deuxième terme \"fusion\".\n";
        exit;
    }

    if ("fusion" !== $argv[$i] && isset($argv[$i+1]) && "fusion" !== $argv[$i + 1] && $argv[$i] > $argv[$i + 1]) {
        print "Erreur : Une des listes n'est pas ordonnée.\n";
        exit;
    }
}

/* récupération des données */
$list1 = [];
$list2 = [];
$secondList = false;

for ($j = 1; $j < $argc; $j++) {
    if ("fusion" == $argv[$j]) {
        $secondList= true;
        continue;
    }

    if (!$secondList) {
        $list1[] = $argv[$j];
        continue;
    }

    $list2[] = $argv[$j];
}

/* résolution */
$sortedList = sorted_fusion($list1, $list2);

/* affichage */
echo implode(' ', $sortedList)."\n";