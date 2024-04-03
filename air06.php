<?php

/**
 * Consigne :
 *
 * Créez un programme qui est capable de reconnaître et de faire une opération (addition ou soustraction) sur chaque entier d’une liste.
 *
 *
 * Exemples d’utilisation :
 * $> ruby exo.rb 1 2 3 4 5 “+2”
 * 3 4 5 6 7
 *
 * $> ruby exo.rb 10 11 12 20 “-5”
 * 5 6 7 15
 *
 *
 * L’opération à appliquer sera toujours le dernier élément.
 *
 *
 * Afficher error et quitter le programme en cas de problèmes d’arguments.
 *
 */

/* fonctions */
function isNumeric(string $string) {
    return preg_match('/[0-9]+/', $string) && (!preg_match('/\D/', $string) || in_array(substr($string, 0, 1), ['-', '+']));
}

function makeOperations(array $inputs, string $operator, int $increment) {
    $outputArray = [];

    foreach ($inputs as $input) {
        if ($operator == '-') {
            $outputArray[] = $input - $increment;
            continue;
        }

        $outputArray[] = $input + $increment;
    }

    return $outputArray;
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

for ($j = 1; $j < $argc; $j++) {
    if (!isNumeric($argv[$j])) {
        print "Erreur : Le paramètre \"$argv[$j]\" n'est pas numérique.\n";
        exit;
    }
}

/* récupération des données */
$liste = [];

for ($i = 1; $i < $argc - 1; $i++) {
    $liste[] = intval($argv[$i]);
}

$operation = $argv[$argc-1];
$operator = substr($operation, 0, 1);
if (! in_array($operator, ['-', '+'])) {
    $operator = '+';
    $increment = intval($operation);
} else {
    $increment = intval(substr($operation, 1));
}

/* résolution */
$modifiedArray = makeOperations($liste, $operator, $increment);

/* affichage */
echo implode(' ', $modifiedArray)."\n";
