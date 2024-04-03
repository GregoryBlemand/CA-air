<?php

/**
 * Consigne :
 *
 * Créez un programme qui retourne la valeur d’une liste qui n’a pas de paire.
 *
 *
 * Exemples d’utilisation :
 * $> python exo.py 1 2 3 4 5 4 3 2 1
 * 5
 *
 * $> python exo.py bonjour monsieur bonjour
 * monsieur
 *
 *
 * Afficher error et quitter le programme en cas de problèmes d’arguments.
 *
 */

/* fonctions */
function getUniqueValue(array $table): string
{
    $uniqueValues = [];
    $treatedValues = [];

    foreach ($table as $value) {
        if (!array_key_exists($value, $treatedValues)) {
            $treatedValues[$value] = 1;
            continue;
        }

        $treatedValues[$value]++;
    }

    foreach ($treatedValues as $key => $number) {
        if (1 === $number) {
            $uniqueValues[] = $key;
        }
    }

    if (empty($uniqueValues)) {
        throw new Exception('Aucune valeur unique.');
    }

    if (count($uniqueValues) > 1) {
        throw new Exception('Multiple valeurs uniques.');
    }

    return $uniqueValues[0];
}

/* gestion d'erreurs */
if ($argc < 4) {
    print "Erreur : Pas assez de paramêtre.\n";
    exit;
}

/* récupération des données */
for ($i = 1; $i < $argc; $i++) {
    $inputs[] = $argv[$i];
}

/* résolution */
try {
    $uniqueValue = getUniqueValue($inputs);
} catch (Exception $e) {
    print "Erreur : ".$e->getMessage()."\n";
    exit;
}

/* affichage */
echo $uniqueValue."\n";
