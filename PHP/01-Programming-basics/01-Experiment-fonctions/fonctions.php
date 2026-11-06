<?php

declare(strict_types=1);

/**
 * TP BTS SIO — Fonctions PHP à compléter.
 *
 * Consigne : rechercher dans la documentation PHP une fonction ou un opérateur
 * adapté à chaque problème, puis tester vos hypothèses dans essais.php.
 * Ne modifiez pas les noms, paramètres ni types de retour des fonctions.
 */

function get_rid_of_surrounding_whitespaces(string $a_string): string
{
    // TODO : renvoyer une chaîne sans les espaces au début et à la fin.
    // Exemple : "  hey yo  " -> "hey yo"cd
}

function belongs_to(string $a_string, string $a_word): bool
{
    // TODO : vérifier si la chaîne contient le mot demandé (sensible à la casse).
    // Exemple : ("hey jude", "jude") -> true
}

function replace(string $initial_string, string $old_letter, string $new_letter): string
{
    // TODO : remplacer toutes les occurrences recherchées.
    // Exemple : ("casanova", "a", "o") -> "cosonovo"
}

function exactly_divide(int $an_integer, int $a_divider): float
{
    // TODO : calculer une division décimale (diviseur non nul).
    // Exemple : (13, 4) -> 3.25
}

function divisible_by_two(int $an_integer): bool
{
    // TODO : renvoyer true si l'entier est divisible par deux.
    // Exemple : 6 -> true
}

function random_subset(array $an_array, int $sample_size): array
{
    // TODO : renvoyer des éléments DISTINCTS tirés au hasard, sans modifier l'entrée.
    // On suppose 0 <= $sample_size <= count($an_array).
    // Exemple : (["a", "b", "c", "d"], 2) -> ["c", "a"]
    // Astuce : un tirage de 0 élément doit renvoyer [].
}

function randomize(array $an_array): array
{
    // TODO : renvoyer une copie du tableau dont l'ordre est mélangé.
    // Exemple : [1, 2, 3, 4] -> [2, 1, 4, 3]
}

function ascending_order(array $an_array): array
{
    // TODO : renvoyer une copie triée par ordre croissant.
    // Exemple : [7, 3, 1, 6, 9] -> [1, 3, 6, 7, 9]
}
