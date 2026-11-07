<?php

declare(strict_types=1);

require_once __DIR__ . '/lib/coach_answer.php';

$passed = 0;
$failed = 0;

function test_result(string $label, mixed $actual, mixed $expected): void
{
    global $passed, $failed;

    if ($actual === $expected) {
        ++$passed;
        echo "[OK]  {$label}" . PHP_EOL;
        return;
    }

    ++$failed;
    echo "[KO]  {$label}" . PHP_EOL;
    echo '      Attendu : ' . var_export($expected, true) . PHP_EOL;
    echo '      Obtenu  : ' . var_export($actual, true) . PHP_EOL;
}

function evaluate(string $label, callable $operation, mixed $expected): void
{
    global $failed;
    try {
        test_result($label, $operation(), $expected);
    } catch (Throwable $error) {
        ++$failed;
        echo "[KO]  {$label} (exception : {$error->getMessage()})" . PHP_EOL;
    }
}

echo "=== coach_answer : 4 tests ===" . PHP_EOL;
evaluate('Retourne une chaîne', fn () => is_string(coach_answer('Hello Coach!')), true);
evaluate('Affirmation', fn () => coach_answer('I would love to eat some pizza!'), "I don't care, get dressed and go to work!");
evaluate('Question', fn () => coach_answer('Can I eat some pizza?'), 'Silly question, get dressed and go to work!');
evaluate('Phrase de sortie', fn () => coach_answer('I am going to work right now!'), '');

echo PHP_EOL . "=== coach_answer_enhanced : 7 tests ===" . PHP_EOL;
evaluate('Retourne une chaîne', fn () => is_string(coach_answer_enhanced('Hello Coach!')), true);
evaluate('Affirmation sans crier', fn () => coach_answer_enhanced('I would love to eat some pizza!'), "I don't care, get dressed and go to work!");
evaluate('Question sans crier', fn () => coach_answer_enhanced('Can I eat some pizza?'), 'Silly question, get dressed and go to work!');
evaluate('Phrase de sortie normale', fn () => coach_answer_enhanced('I am going to work right now!'), '');
evaluate('Affirmation criée', fn () => coach_answer_enhanced('I WOULD LOVE SOME PIZZA!'), "I can feel your motivation! I don't care, get dressed and go to work!");
evaluate('Question criée', fn () => coach_answer_enhanced('CAN I EAT SOME PIZZA?'), 'I can feel your motivation! Silly question, get dressed and go to work!');
evaluate('Phrase de sortie criée', fn () => coach_answer_enhanced('I AM GOING TO WORK RIGHT NOW!'), '');

echo PHP_EOL . "Résultat : {$passed}/" . ($passed + $failed) . " tests réussis." . PHP_EOL;
exit($failed === 0 ? 0 : 1);
