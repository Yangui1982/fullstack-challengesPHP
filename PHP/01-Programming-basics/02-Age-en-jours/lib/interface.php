<?php

declare(strict_types=1);

// Charger la fonction age_in_days() depuis ce même dossier.
require_once __DIR__ . '/age_in_days.php';

echo "Quelle est ton année de naissance ?\n";
$birth_year = (int) trim(fgets(STDIN));

echo "Quel est ton mois de naissance ?\n";
$birth_month = (int) trim(fgets(STDIN));

echo "Quel est ton jour de naissance ?\n";
$birth_day = (int) trim(fgets(STDIN));

echo "Calcul de ton âge en jours...\n";

// TODO : appeler age_in_days() avec les trois arguments dans le bon ordre.
$calculated_age = 0;

echo "Tu as {$calculated_age} jours.\n";

// BONUS : remplacer les trois blocs de saisie par une fonction réutilisable.
