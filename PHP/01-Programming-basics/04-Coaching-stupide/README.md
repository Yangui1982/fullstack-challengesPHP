# Challenge 03 — Stupid Coaching (PHP)

**BTS SIO 1re année — Initiation à PHP**  
**Thèmes :** conditions, boucles, fonctions, chaînes de caractères, programme interactif, réutilisation de fichiers.  
**Prérequis :** notions de variables, paramètres, arguments, `return`, utilisation du terminal et recherche dans la documentation PHP.

## Contexte et objectifs

Tu vas programmer un coach personnel peu sympathique ! Ce challenge introduit des concepts que nous allons approfondir ensuite : **conditions (`if`, `elseif`, `else`)** et **boucles (`while`, `do...while`)**.

Ton travail consiste à :

1. Identifier le **flux d'exécution** d'un programme (l'ordre dans lequel les instructions s'exécutent).
2. Écrire des conditions pour choisir la réponse du coach.
3. Réutiliser une fonction PHP définie dans un autre fichier à l'aide de `require_once`.
4. Programmer une conversation dans le terminal qui se répète jusqu'à ce que l'utilisateur prononce la phrase de sortie.
5. Vérifier régulièrement ton travail avec des **tests automatisés**.

## Règles du coach

Le coach répond **exactement** avec les phrases ci-dessous, en anglais (majuscules, ponctuation et espaces compris). Ce choix permet de comparer les résultats aux tests.

| Message saisi | Réponse attendue |
| --- | --- |
| `I met a girl last night` | `I don't care, get dressed and go to work!` |
| `Can I eat some pizza?` | `Silly question, get dressed and go to work!` |
| `I am going to work right now!` | *(chaîne vide : aucune réponse)* |

- Une **question** se termine par le caractère `?`.
- Une **affirmation** est un message qui n'est pas une question et n'est pas la phrase de sortie.
- La phrase de sortie est exactement `I am going to work right now!` (et, dans la version améliorée, sa variante entièrement en majuscules).

### Bonus : le coach amélioré

Si le message est **crié** (les lettres sont en majuscules), le coach ajoute au début de sa réponse :

`I can feel your motivation! `

Exemples :

| Message | Réponse du coach amélioré |
| --- | --- |
| `I WOULD LOVE SOME PIZZA!` | `I can feel your motivation! I don't care, get dressed and go to work!` |
| `CAN I EAT SOME PIZZA?` | `I can feel your motivation! Silly question, get dressed and go to work!` |
| `I AM GOING TO WORK RIGHT NOW!` | *(chaîne vide)* |

**Important :** la phrase de sortie prime toujours sur les autres règles. Le coach ne doit rien répondre à cette phrase, même lorsqu'elle est criée.

## Structure de l'exercice

```text
03-Stupid-coaching/
├── README.md
├── .gitignore
├── lib/
│   ├── coach_answer.php     # Fonctions à compléter
│   └── interface.php        # Programme interactif à compléter
└── tests.php                # Vérification automatique
```

## Étape 1 — Programmer la réponse du coach

Dans `lib/coach_answer.php`, complète les fonctions suivantes :

```php
function coach_answer(string $your_message): string
function coach_answer_enhanced(string $your_message): string
```

La première retourne l'une des trois réponses prévues. La seconde applique les mêmes règles, en ajoutant une phrase de motivation lorsque l'utilisateur crie, sauf dans le cas de la phrase de sortie.

**Aides (à chercher dans la documentation, pas de solution donnée) :**

- Tester une égalité stricte avec `===`.
- Tester une condition avec `if`, `elseif` et `else`.
- Étudier `str_ends_with()` et `strtoupper()`.
- Une fonction doit utiliser **`return`** pour transmettre une valeur aux tests : `echo` ne remplace pas `return`.

Documentation : [php.net/manual/fr/](https://www.php.net/manual/fr/)

## Étape 2 — Faire passer les tests

Ouvre un terminal **dans le dossier `03-Stupid-coaching`**, puis exécute :

```bash
php tests.php
```

Le script comporte **11 tests**, dont 4 pour `coach_answer()` et 7 pour `coach_answer_enhanced()`.

Les tests sont initialement en échec : c'est prévu ! Corrige les fonctions, relance les tests et progresse jusqu'à obtenir **11/11**.

Sous Windows, si PHP n'est pas dans le PATH mais que XAMPP est installé, utilise PowerShell :

```powershell
& "C:\xampp\php\php.exe" tests.php
```

## Étape 3 — Programme interactif

Dans `lib/interface.php`, utilise la fonction du coach et les instructions de lecture au clavier pour créer une conversation.

Lance ton programme depuis la racine de l'exercice :

```bash
php lib/interface.php
```

**Comportement attendu :**

1. Le programme demande à l'utilisateur de saisir un message.
2. Il lit le texte saisi dans le terminal.
3. Il affiche la réponse du coach.
4. Il attend un nouveau message et recommence **en boucle**.
5. Il s'arrête lorsque l'utilisateur saisit exactement `I am going to work right now!` ou `I AM GOING TO WORK RIGHT NOW!`.

Pour lire depuis le terminal, recherche comment utiliser `fgets(STDIN)` et `trim()`. Pour importer le fichier contenant les fonctions, utilise `require_once` et `__DIR__`.

Une fois le programme fonctionnel, essaie d'utiliser `coach_answer_enhanced()` à la place de la fonction de base pour obtenir le bonus.

**Boucle infinie ?** Appuie sur **Ctrl + C** dans le terminal pour interrompre le programme.

**Attention :** la réussite des 11 tests ne vérifie pas le comportement interactif. Tu dois aussi lancer `php lib/interface.php` et tester réellement la conversation.

## Étape 4 — Vérification manuelle

Teste successivement ces messages dans ton interface :

```text
I love pizza!
Can I eat some pizza?
CAN I EAT SOME PIZZA?
I AM GOING TO WORK RIGHT NOW!
```

Vérifie que le programme répète les échanges et se termine sur la dernière ligne.

## Bonus — Réflexion

- Pourquoi la règle de sortie doit-elle être vérifiée avant les autres conditions ?
- Quelle différence y a-t-il entre `=` (affectation), `==` (égalité non stricte) et `===` (égalité stricte) ?
- Quelle différence y a-t-il entre **afficher** une valeur (`echo`) et la **renvoyer** (`return`) ?
- Peut-on éviter de répéter les règles du coach de base dans le coach amélioré ? (Principe **DRY**.)
- Que se passe-t-il si l'utilisateur ferme l'entrée du terminal (fin de fichier) ?

## Enseignements clés

À la fin de cet exercice, tu dois pouvoir expliquer :

1. Dans quel ordre les instructions d'un programme PHP sont exécutées.
2. Comment un `if...elseif...else` modifie ce flux.
3. Comment une boucle `while` permet de répéter un traitement.
4. Comment appeler une fonction déclarée dans un autre fichier PHP.
5. Comment arrêter proprement une boucle interactive.
6. Pourquoi on teste d'abord une fonction isolée avant de l'intégrer à une interface.

## Travail avec Git

Dans ton fork du dépôt de l'enseignant, effectue des commits progressifs, par exemple :

```bash
git add .
git commit -m "Implémentation des réponses du coach"
git add .
git commit -m "Ajout du coach amélioré"
git add .
git commit -m "Interface interactive du coach"
git push
```

Réalise les commits **au fur et à mesure** du travail : ne reproduis pas toutes ces commandes sans avoir modifié les fichiers entre les commits.
