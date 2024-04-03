<?php

/**
 * Consigne :
 *
 * Créez un programme qui transforme un tableau de chaînes de caractères en une seule chaîne de caractères. Espacés d’un séparateur donné en dernier argument au programme.
 *
 * Utilisez une fonction de ce genre (selon votre langage) :
 * ma_fonction(array_de_strings, separateur) {
 * # votre algorithme
 * return (string)
 * }
 *
 *
 * Exemples d’utilisation :
 * $> python exo.py “je” “teste” “des” “trucs” “ “
 * Je teste des trucs
 *
 *
 * Afficher error et quitter le programme en cas de problèmes d’arguments.
 */

/* fonctions */
function getInputTable(array $argv, int $argc): array
{
    $inputs = [];

    for ($i = 1; $i < $argc - 1; $i++) {
        $inputs[] = $argv[$i];
    }

    return $inputs;
}

// cette fonction peut être remplacée par implode($separator, $table)
function concatTable(array $table, $separator = ' '): string
{
    $string= '';

    foreach ($table as $key => $row) {
        if (0 == $key) {
            $string = $row;
            continue;
        }

        $string.= $separator.$row;
    }

    return $string;
}

/* gestion d'erreurs */
if ($argc < 2) {
    print "Erreur : Aucun paramêtre.\n";
    exit;
}


if ($argc == 2) {
    print "Erreur : Pas de séparateur.\n";
    exit;
}

if ($argc == 3) {
    print "Erreur : une seule chaine à concaténer.\n";
    exit;
}

/* récupération des données */
$inputTable = getInputTable($argv, $argc);
$separator = $argv[$argc -1];

/* résolution */
$outputString = concatTable($inputTable, $separator);

/* affichage */
echo $outputString."\n";