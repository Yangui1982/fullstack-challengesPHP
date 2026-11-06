<?php

declare(strict_types=1);

require_once __DIR__ . '/lib/age_in_days.php';

// Tests autonomes : aucune dépendance à PHPUnit ni configuration particulière.
// Ne pas modifier ce fichier dans la version étudiante.

$today = new DateTimeImmutable('today');
$tests = [];

/** Calcule la référence attendue pour une date de naissance valide. */
function expected_days(DateTimeImmutable $birth_date, DateTimeImmutable $today): int
{
    return $birth_date->diff($today)->days;
}

function add_test(array &$tests, string $label, DateTimeImmutable $birth_date, DateTimeImmutable $today): void
{
    $tests[] = [
        'label' => $label,
        'date' => $birth_date,
        'expected' => expected_days($birth_date, $today),
    ];
}

add_test($tests, 'Naissance aujourd’hui : 0 jour', $today, $today);
add_test($tests, 'Naissance hier : 1 jour', $today->modify('-1 day'), $today);
add_test($tests, 'Il y a une semaine : 7 jours', $today->modify('-7 days'), $today);
add_test($tests, 'Il y a trente jours : 30 jours', $today->modify('-30 days'), $today);
add_test($tests, 'Date de naissance fixe : 1 janvier 2000', new DateTimeImmutable('2000-01-01'), $today);
add_test($tests, 'Année bissextile : 29 février 2024', new DateTimeImmutable('2024-02-29'), $today);
add_test($tests, 'Fin de mois : 31 décembre 2010', new DateTimeImmutable('2010-12-31'), $today);
add_test($tests, 'Début d’année : 1 janvier 2020', new DateTimeImmutable('2020-01-01'), $today);

$passed = 0;
$failed = 0;

foreach ($tests as $test) {
    $birth_date = $test['date'];
    $day = (int) $birth_date->format('j');
    $month = (int) $birth_date->format('n');
    $year = (int) $birth_date->format('Y');

    try {
        $actual = age_in_days($day, $month, $year);
        if (is_int($actual) && $actual === $test['expected']) {
            echo '[OK] ' . $test['label'] . "\n";
            $passed++;
        } else {
            echo '[ECHEC] ' . $test['label'] . ' : attendu '
                . $test['expected'] . ', obtenu ' . var_export($actual, true) . "\n";
            $failed++;
        }
    } catch (Throwable $exception) {
        echo '[ECHEC] ' . $test['label'] . ' : exception '
            . $exception->getMessage() . "\n";
        $failed++;
    }
}

echo "\nRésultat : {$passed} test(s) réussi(s), {$failed} échec(s).\n";
exit($failed === 0 ? 0 : 1);
