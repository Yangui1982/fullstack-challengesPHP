<?php

declare(strict_types=1);

// Bac à sable : écrire vos essais ici et exécuter : php essais.php
// Modifiez ou ajoutez des lignes librement.
var_dump(get_debug_type('A string'));
var_dump(get_debug_type(19));
var_dump(get_debug_type([1, 2, 3]));
var_dump(strtoupper('A string'));
var_dump(strtolower('A STRING'));
$liste = [1, 2, 3];
shuffle($liste); // shuffle modifie le tableau fourni et renvoie un booléen.
var_dump($liste);
