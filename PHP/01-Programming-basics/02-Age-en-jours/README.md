# Challenge 02 — Calculer son âge en jours (PHP)

**BTS SIO — 1re année | PHP 8.x | VS Code | Terminal**

## Contexte et objectifs

Dans ce deuxième exercice, tu vas construire un programme PHP qui demande une date de naissance puis affiche l'âge correspondant **en jours**.

À la fin du challenge, tu dois savoir :

- inclure un fichier PHP externe avec `require_once` et `__DIR__` ;
- définir une fonction, lui transmettre des arguments et utiliser sa valeur de retour ;
- distinguer une variable, son affectation et sa réaffectation ;
- lire une saisie utilisateur dans le terminal avec `fgets(STDIN)` ;
- chercher une fonction ou une classe utile dans la documentation PHP ;
- exécuter des tests automatisés, corriger ton code et enregistrer tes modifications avec Git.

## Organisation du projet

```text
02-Age-en-jours/
├── README.md
├── .gitignore
├── lib/
│   ├── age_in_days.php   # Fonction à programmer
│   └── interface.php     # Programme interactif à terminer
└── tests.php             # Tests automatisés fournis
```

## Prérequis

PHP 8.x doit être accessible en ligne de commande. Depuis le dossier de l'exercice :

```bash
php -v
```

Si PHP n'est pas dans le `PATH`, utilise celui de XAMPP pour les commandes suivantes :

| Système | Exécuter les tests |
| --- | --- |
| Windows PowerShell | `& "C:\xampp\php\php.exe" tests.php` |
| macOS | `/Applications/XAMPP/xamppfiles/bin/php tests.php` |
| Linux (XAMPP) | `/opt/lampp/bin/php tests.php` |

**Apache n'est pas nécessaire** : cet exercice se lance dans le terminal, pas dans le navigateur. Utilise la même méthode pour lancer `lib/interface.php`.

## Mission 1 — Calculer l'âge en jours

Ouvre `lib/age_in_days.php`. La fonction est déjà déclarée :

```php
function age_in_days(int $day, int $month, int $year): int
```

Elle reçoit trois **paramètres** : le jour, le mois et l'année de naissance. Elle doit **renvoyer un entier** représentant le nombre de jours écoulés entre la date de naissance et la date du jour.

**Exemples :**

- Une naissance aujourd'hui donne `0` jour.
- Une naissance hier donne `1` jour.
- Une naissance il y a exactement sept jours donne `7` jours.

Le calcul doit tenir compte des années bissextiles et des vrais mois du calendrier : ne multiplie pas simplement le nombre d'années par 365. Pour ce challenge, les tests utilisent des dates de naissance valides, non futures.

Le fichier contient un `TODO` et une valeur provisoire. **Remplace la valeur provisoire par ton calcul.** Ne modifie pas la déclaration de la fonction.

**Pistes de recherche** : `DateTimeImmutable`, `DateTime::diff`, `DateInterval`, format des dates. Utilise la documentation officielle :

- https://www.php.net/manual/fr/class.datetimeimmutable.php
- https://www.php.net/manual/fr/datetime.diff.php
- https://www.php.net/manual/fr/class.dateinterval.php

Cherche, teste une petite expression dans un fichier d'essai si nécessaire, puis implémente la fonction.

## Mission 2 — Rendre le programme interactif

Ouvre `lib/interface.php`. Le fichier :

1. charge le fichier de la fonction avec `require_once __DIR__ . '/age_in_days.php'` ;
2. demande l'année, le mois et le jour de naissance ;
3. récupère la saisie au moyen de `fgets(STDIN)` ;
4. utilise `trim()` puis une conversion en entier `(int)` ;
5. affiche actuellement **0 jour**, quelle que soit la saisie.

**À faire** : remplace la valeur provisoire de `$calculated_age` par un appel à `age_in_days()` avec les trois arguments, dans le bon ordre.

Depuis le dossier de l'exercice :

```bash
php lib/interface.php
```

Exemple d'interaction (les valeurs dépendent de la date du jour) :

```text
Quelle est ton année de naissance ?
2006
Quel est ton mois de naissance ?
11
Quel est ton jour de naissance ?
6
Calcul de ton âge en jours...
Tu as XXXX jours.
```

Le résultat est exprimé en **jours** et non en années.

## Mission 3 — Faire passer les tests au vert

Lance :

```bash
php tests.php
```

Chaque test affiche `[OK]` ou `[ECHEC]`. Les tests vérifient la fonction et non la présentation de l'interface. **Ne modifie pas `tests.php` : c'est l'outil qui valide ton travail.**

Si un test échoue, lis son intitulé, consulte la documentation, corrige `lib/age_in_days.php` et relance la commande.

## Bonus — Refactorisation (DRY)

Dans `interface.php`, les trois questions à l'utilisateur suivent presque le même schéma : message, lecture, `trim()`, conversion.

Peux-tu créer une fonction `ask_integer(string $question): int` pour éviter la répétition de ces instructions ? Vérifie ensuite que le programme interactif donne toujours la bonne réponse.

## Questions de bilan

### Variables

1. Qu'est-ce qu'une variable ? Identifie celles de `interface.php`.
2. Que signifie *affecter une valeur* à une variable ? Quelle syntaxe utilise PHP ?
3. Peut-on réaffecter une variable ? Que font les instructions `$number = 1;` puis `$number = $number * 2;` ?
4. Pourquoi les variables PHP commencent-elles par `$` ?
5. Quelle convention de nommage est utilisée dans ce challenge ?

### Fonctions et inclusion

6. Quelle différence y a-t-il entre **déclarer** et **appeler** une fonction ?
7. Où est définie `age_in_days()` ? Où est-elle appelée ?
8. Quelle différence y a-t-il entre un paramètre et un argument ?
9. Pourquoi utiliser `return` plutôt que `echo` dans `age_in_days()` ?
10. À quoi servent `require_once` et `__DIR__` ?

### Terminal

11. Quelle instruction lit une ligne saisie au clavier ?
12. Pourquoi utiliser `trim()` sur une saisie ?
13. Pourquoi convertir la saisie en entier avec `(int)` ?
14. Quelle commande permet de lancer tous les tests ?

## Git / GitHub

Dans ton fork du dépôt enseignant, crée plusieurs commits compréhensibles, par exemple :

```bash
git add .
git commit -m "Calcul de l'âge en jours"
git add .
git commit -m "Connexion de la fonction à l'interface"
git push
```

Adapte les commits à tes véritables étapes de travail. N'enregistre pas de corrigé dans le dépôt collectif de l'enseignant.
