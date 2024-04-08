<?php

/**
 * Consigne :
 *
 * Créez un programme qui vérifie si les exercices de votre épreuve de l’air sont présents dans le répertoire et qu’ils fonctionnent (sauf celui là).
 * Créez au moins un test pour chaque exercice.
 *
 *
 * Exemples d’utilisation :
 * $> python exo.py
 * air00 (1/3) : success
 * air00 (2/3) : success
 * air00 (3/3) : success
 * air01 (1/2) : success
 * air01 (2/2) : failure
 * air02 (1/1) : success
 * ...
 * Total success: (56/62)
 *
 *
 * Bonus : trouvez le moyen d’utiliser du vert et du rouge pour rendre réussites et échecs plus visibles.
 *
 */
/*
 * Réflexion
 *
 * 1) lister les fichiers présents dans le répertoire courant
 * 2) hormis README.md et ce script, tester chaque script avec 2 appels
 *  a) créer des test
 *  b) fonctionnement attendu : success
 *  c) erreur : failure
 * 3) pour chaque retour de test indiquer le fichier testé sans extension, le numéro du test, son état
 * 4) styliser la sortie
 *
 **/

/* fonctions */
function getFileList(): array
{
    $fileList = scandir('.');
    $outputList = [];

    foreach ($fileList as $file) {
        if (preg_match('/\.php$/', $file) && $file !== basename(__FILE__)) {
            $outputList[] = $file;
        }
    }

    return $outputList;
}

class assertions
{
    public $asserts = [
        'air01' => [
            [
                'params' => '"Bonjour les gars"',
                'expected' => "Bonjour\nles\ngars\n",
            ],
            [
                'params' => '"Bonjour les gars"',
                'expected' => "Bonjour\nLES\n",
            ],
        ],
        'air02' => [
            [
                'params' => '"Crevette magique dans la mer des étoiles" "la"',
                'expected' => "Crevette magique dans \n mer des étoiles\n",
            ],
        ],
        'air03' => [
            [
                'params' => '"je" "teste" "des" "trucs" " "',
                'expected' => "je teste des trucs\n",
            ],
            [
                'params' => '"je" "teste" "des" "trucs" "\n"',
                'expected' => 'je\nteste\ndes\ntrucs'."\n",
            ],
        ],
        'air04' => [
            [
                'params' => '1 2 3 4 5 4 3 2 1',
                'expected' => "5\n",
            ],
            [
                'params' => 'bonjour monsieur bonjour',
                'expected' => "monsieur\n",
            ],
        ],
        'air05' => [
            [
                'params' => 'Hello milady,   bien ou quoi ??',
                'expected' => "Helo milady, bien ou quoi ?\n",
            ],
        ],
        'air06' => [
            [
                'params' => '1 2 3 4 5 "+2"',
                'expected' => "3 4 5 6 7\n",
            ],
            [
                'params' => '10 11 12 20 "-5"',
                'expected' => "5 6 7 15\n",
            ],
            [
                'params' => '',
                'expected' => "Erreur : Aucun paramêtre.\n",
            ],
        ],
        'air07' => [
            [
                'params' => 'Michel Albert Thérèse Benoit t',
                'expected' => "Michel\n",
            ],
            [
                'params' => 'Michel Albert Thérèse Benoit a',
                'expected' => "Michel, Thérèse, Benoit\n",
            ],

        ],
        'air08' => [
            [
                'params' => '1 3 4 2',
                'expected' => "1 2 3 4\n",
            ],
            [
                'params' => '10 20 30 40 50 60 70 90 33',
                'expected' => "10 20 30 33 40 50 60 70 90\n",
            ],
        ],
        'air09' => [
            [
                'params' => '10 20 30 fusion 15 25 35',
                'expected' => "10 15 20 25 30 35\n",
            ],
            [
                'params' => '10 20 30 fusion 15 45 35',
                'expected' => "Erreur : Une des listes n'est pas ordonnée.\n",
            ],

        ],
        'air10' => [
            [
                'params' => '"Michel" "Albert" "Thérèse" "Benoit"',
                'expected' => "Albert, Thérèse, Benoit, Michel\n",
            ],
        ],
        'air11' => [
            [
                'params' => 'a.txt',
                'expected' => "Le fichier \"a.txt\" est introuvable.\n",
            ],
        ],
        'air12' => [
            [
                'params' => 'O 5',
                'expected' => "    O\n   OOO\n  OOOOO\n OOOOOOO\nOOOOOOOOO\n",
            ],
        ],
        'air13' => [
            [
                'params' => '6 5 4 3 2 1',
                'expected' => "1 2 3 4 5 6\n",
            ],
        ],
    ];

    public $returnList = [];

    public function executeTests(string $index) {
        // vérifier si index existe
        if (!isset($this->asserts[$index])) {
            return;
        }

        $counter = 1;
        $count = count($this->asserts[$index]);
        $red = "\e[31m";
        $green = "\e[32m";
        $resetColor = "\e[0m";

        // si c'est le cas, pour chaque item, appeler le script avec les paramètres et tester la sortie
        foreach ($this->asserts[$index] as $k => $assert) {
            $parameters = is_array($assert['params']) ? implode(' ', $assert['params']) : $assert['params'];

            $testReturn = shell_exec('php '.$index.'.php '.$parameters);
            $success = $testReturn == $assert['expected'];
            $startColor = $success ? $green : $red;

            $this->returnList[] = $startColor.$index.' ('.$counter.'/'.$count.') : '.($success ? 'success' : 'failure').$resetColor;

            $counter++;
        }
    }
}

/* gestion d'erreurs */

/* récupération des données */
$fileList = getFileList();
/* résolution */
$assertion = new assertions();

foreach ($fileList as $file) {
    $index = str_replace('.php', '', $file);
    $assertion->executeTests($index);
}

/* affichage */
echo implode("\n", $assertion->returnList)."\n";

