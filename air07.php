<?php

/**
 * Consigne :
 *
 * Créez un programme qui supprime d’un tableau tous les éléments qui ne contiennent pas une autre chaîne de caractères.
 *
 * Utilisez une fonction de ce genre (selon votre langage) :
 * ma_fonction(array_de_strings, string) {
 * # votre algorithme
 * return (nouvel_array_de_strings)
 * }
 *
 *
 * Exemples d’utilisation :
 * $> python exo.py “Michel” “Albert” “Thérèse” “Benoit” “t”
 * Michel
 *
 * $> python exo.py “Michel” “Albert” “Thérèse” “Benoit” “a”
 * Michel, Thérèse, Benoit
 *
 *
 *
 * Afficher error et quitter le programme en cas de problèmes d’arguments.
 *
 */

/* fonctions */
function getValuesNotContainingNeedle(array $liste, string $needle) {
    $notContainingList = [];

    foreach ($liste as $item) {
        if (false === strpos(strtolower($item), $needle)) {
            $notContainingList[] = $item;
        }
    }

    return $notContainingList;
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

for ($i = 1; $i < $argc - 1; $i++) {
    $liste[] = $argv[$i];
}

$needle = $argv[$argc-1];

/* résolution */
$excludedValues = getValuesNotContainingNeedle($liste, $needle);

/* affichage */
echo implode(', ', $excludedValues)."\n";
