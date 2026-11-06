<?php

declare(strict_types=1);

require_once __DIR__ . '/fonctions.php';

/** Tests sans PHPUnit ni Composer ; PHP 8+ suffit. */
$success = 0;
$failure = 0;

function test(string $name, callable $callback): void
{
    global $success, $failure;
    try {
        if ($callback()) {
            $success++;
            echo "[OK]    {$name}\n";
        } else {
            $failure++;
            echo "[ECHEC] {$name}\n";
        }
    } catch (Throwable $error) {
        $failure++;
        echo "[ERREUR] {$name} : {$error->getMessage()}\n";
    }
}

function same_elements(array $actual, array $expected): bool
{
    sort($actual);
    sort($expected);
    return $actual === $expected;
}

test('trim : espaces autour', fn() => get_rid_of_surrounding_whitespaces('  hey yo  ') === 'hey yo');
test('trim : tabulations et retours ligne', fn() => get_rid_of_surrounding_whitespaces("\tBonjour\n") === 'Bonjour');
test('contient : mot présent', fn() => belongs_to('hey jude', 'jude') === true);
test('contient : mot absent', fn() => belongs_to('hey jude', 'paul') === false);
test('contient : respect de la casse', fn() => belongs_to('Salut', 'salut') === false);
test('remplace : toutes les occurrences', fn() => replace('casanova', 'a', 'o') === 'cosonovo');
test('remplace : aucune occurrence', fn() => replace('bonjour', 'x', 'y') === 'bonjour');
test('division : résultat décimal', fn() => exactly_divide(13, 4) === 3.25);
test('division : résultat inférieur à un', fn() => exactly_divide(1, 2) === 0.5);
test('pair : entier pair', fn() => divisible_by_two(6) === true);
test('pair : entier impair', fn() => divisible_by_two(7) === false);
test('pair : zéro', fn() => divisible_by_two(0) === true);
test('sous-ensemble : longueur et valeurs', function (): bool {
    $source = ['a', 'b', 'c', 'd', 'e'];
    $copy = $source;
    $result = random_subset($source, 3);
    return count($result) === 3 && count(array_unique($result)) === 3
        && count(array_diff($result, $source)) === 0 && $source === $copy;
});
test('sous-ensemble : un élément', function (): bool {
    $result = random_subset(['a', 'b', 'c'], 1);
    return count($result) === 1 && in_array($result[0], ['a', 'b', 'c'], true);
});
test('sous-ensemble : zéro élément', fn() => random_subset(['a', 'b'], 0) === []);
test('mélange : mêmes valeurs et conservation entrée', function (): bool {
    $source = [1, 2, 3, 4, 5];
    $copy = $source;
    $result = randomize($source);
    return same_elements($result, $source) && $source === $copy;
});
test('tri : croissant', fn() => ascending_order([7, 3, 1, 6, 9]) === [1, 3, 6, 7, 9]);
test('tri : doublons et négatifs', fn() => ascending_order([3, -1, 3, 0]) === [-1, 0, 3, 3]);
test("tri : ne modifie pas l'entrée", function (): bool {
    $source = [3, 1, 2];
    $copy = $source;
    $result = ascending_order($source);
    return $source === $copy && $result === [1, 2, 3];
});

echo "\nRésultat : {$success} test(s) réussi(s), {$failure} échec(s).\n";
exit($failure === 0 ? 0 : 1);
