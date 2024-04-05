<?php

/**
 * Consigne :
 *
 * Créez un programme qui trie une liste de nombres. Votre programme devra implémenter l’algorithme du tri rapide (QuickSort).
 *
 * Vous utiliserez une fonction de cette forme (selon votre langage) :
 * my_quick_sort(array) {
 * # votre algorithme
 * return (new_array)
 * }
 *
 *
 * Exemples d’utilisation :
 * $> python exo.py 6 5 4 3 2 1
 * 1 2 3 4 5 6
 *
 *
 *
 * Afficher error et quitter le programme en cas de problèmes d’arguments.
 *
 *
 * Wikipedia vous présentera une belle description de cet algorithme de tri.
 *
 */

/* fonctions */
function isNumeric(string $string) {
    return preg_match('/[0-9]+/', $string) && !preg_match('/\D/', $string);
}

function tri_rapide(array $liste) {

    $length = count($liste);
    if ($length <= 1) {
        return $liste;
    }

    $petit = [];
    $grand = [];
    $pivot = $liste[$length -1];
    $grand[] = $pivot;

    foreach ($liste as $number) {
        if ($number < $pivot) {
            $petit[] = $number;
        } elseif ($number > $pivot) {
            $grand[] = $number;
        }
    }

    return array_merge(tri_rapide($petit), tri_rapide($grand));
}

/* gestion d'erreurs */
if ($argc < 3) {
    print "Erreur : Pas assez de paramêtre.\n";
    exit;
}

for ($j = 1; $j < $argc; $j++) {
    if (!isNumeric($argv[$j])) {
        print "Erreur : l'argument \"$argv[$j]\" n'est pas un nombre entier positif\n";
        exit;
    }
}

/* récupération des données */
$liste = [];
for ($i = 1; $i < $argc; $i++) {
    $liste[] = intval($argv[$i]);
}

/* résolution */
$sortedListe = tri_rapide($liste);

/* affichage */
print implode(' ', $sortedListe)."\n";

