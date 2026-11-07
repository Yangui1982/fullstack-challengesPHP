<?php

declare(strict_types=1);

require_once __DIR__ . '/lib/compute_name.php';

$passed = 0;
$failed = 0;

function test_equal(string $label, mixed $actual, mixed $expected): void
{
    global $passed, $failed;
    if ($actual === $expected) {
        $passed++;
        echo "[OK] $label\n";
        return;
    }
    $failed++;
    echo "[ECHEC] $label\n";
    echo '  Attendu : ' . var_export($expected, true) . "\n";
    echo '  Obtenu  : ' . var_export($actual, true) . "\n";
}

function run_interface(string $input): array
{
    $command = [PHP_BINARY, __DIR__ . '/lib/interface.php'];
    $descriptors = [
        0 => ['pipe', 'r'],
        1 => ['pipe', 'w'],
        2 => ['pipe', 'w'],
    ];
    $process = proc_open($command, $descriptors, $pipes, __DIR__);
    if (!is_resource($process)) {
        throw new RuntimeException('Impossible de lancer interface.php');
    }
    fwrite($pipes[0], $input);
    fclose($pipes[0]);
    $output = stream_get_contents($pipes[1]);
    fclose($pipes[1]);
    $errors = stream_get_contents($pipes[2]);
    fclose($pipes[2]);
    $code = proc_close($process);
    return [$code, $output, $errors];
}

function test_interface(string $label, string $input, string $needle): void
{
    try {
        [$code, $output, $errors] = run_interface($input);
        test_equal("$label — exécution sans erreur", $code, 0);
        test_equal("$label — salutation", str_contains($output, $needle), true);
        if ($errors !== '') {
            echo "  Sortie d'erreur : $errors\n";
        }
    } catch (Throwable $e) {
        test_equal("$label — lancement", $e->getMessage(), 'Aucune erreur');
    }
}

echo "TESTS — CHALLENGE 04 : QUEL EST TON NOM ?\n\n";

test_equal('Retourne une chaîne', get_debug_type(compute_name('Jean', 'Michel', 'Saurin')), 'string');
test_equal('Forme le nom complet', compute_name('Jean', 'Michel', 'Saurin'), 'Jean Michel Saurin');
test_equal('Respecte les arguments fournis', compute_name('Boris', 'Alexandre', 'Papillard'), 'Boris Alexandre Papillard');
test_equal('Préserve les accents', compute_name('Émilie', 'Marie', 'Dufour'), 'Émilie Marie Dufour');
test_equal('Préserve les espaces internes aux arguments', compute_name('Anne Claire', 'Lou', 'Martin'), 'Anne Claire Lou Martin');
test_equal('Gère les valeurs vides sans les modifier', compute_name('', '', ''), '  ');

test_interface('Interface avec Jean', "Jean\nMichel\nSaurin\n", 'Hello, Jean Michel Saurin!');
test_interface('Interface avec Boris', "Boris\nAlexandre\nPapillard\n", 'Hello, Boris Alexandre Papillard!');

echo "\nRésultat : $passed réussis / " . ($passed + $failed) . " tests\n";
exit($failed === 0 ? 0 : 1);
