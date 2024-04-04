<?php

/**
 * Consigne :
 *
 * Afficher un escalier constitué d’un caractère et d’un nombre d’étages donné en paramètre.
 *
 *
 * Exemples d’utilisation :
 * $> ruby exo.rb O 5
 *     O
 *    OOO
 *   OOOOO
 *  OOOOOOO
 * OOOOOOOOO
 *
 *
 * Afficher error et quitter le programme en cas de problèmes d’arguments.
 *
 */

/* fonctions */
function isNumeric(string $string) {
    return preg_match('/[0-9]+/', $string) && !preg_match('/\D/', $string);
}

function generated_pyramid($character, $stairs): string
{
    $outputString = '';

    for ($i = 0; $i < $stairs; $i++) {
        $outputString .= str_repeat(' ', $stairs - (1 + $i));

        $outputString .= str_repeat($character, (2 * $i) + 1)."\n";
    }

    return $outputString;
}

/* gestion d'erreurs */
if ($argc < 3) {
    print "Erreur : Pas assez de paramêtre.\n";
    exit;
}

if ($argc > 3) {
    print "Erreur : Trop de paramêtre.\n";
    exit;
}

if (strlen($argv[1]) > 1) {
    print "Erreur : le caractère à duppliquer est trop long.\n";
    exit;
}

if (!isNumeric($argv[2]) && intval($argv[2]) < 1) {
    print "Erreur : le deuxième paramêtre doit être un entier positif\n";
    exit;
}

/* récupération des données */
$character = $argv[1];
$stairs = intval($argv[2]);

/* résolution */
$output = generated_pyramid($character, $stairs);

/* affichage */
echo $output;