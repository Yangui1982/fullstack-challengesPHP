# Challenge 04 — Quel est ton nom ?

**BTS SIO 1re année — Initiation à PHP 8**  
**Thèmes :** variables, fonctions, paramètres, interpolation de chaînes, saisie au terminal, inclusion de fichiers.  
**Durée indicative :** 30 à 45 minutes.

## Contexte et objectifs

Tu vas écrire un programme capable de demander le prénom, le deuxième prénom et le nom d'une personne, puis d'afficher son nom complet.

À la fin de cet exercice, tu dois savoir :

- définir une fonction, lui transmettre des arguments et récupérer sa valeur de retour ;
- utiliser des variables et comprendre leur portée ;
- **interpoler des variables dans une chaîne PHP** ;
- distinguer guillemets simples (`'...'`) et doubles (`"..."`) ;
- inclure un fichier PHP avec `require_once` ;
- lire une saisie dans le terminal et supprimer son retour à la ligne.

## Structure du challenge

```text
04-What-your-name/
├── README.md
├── .gitignore
├── lib/
│   ├── compute_name.php      # Fonction à compléter
│   └── interface.php         # Programme interactif à compléter
└── tests.php                 # Tests automatisés
```

## 1. Calculer le nom complet

Dans `lib/compute_name.php`, complète la fonction :

```php
function compute_name(string $first_name, string $middle_name, string $last_name): string
{
    // TODO : retourner le nom complet séparé par des espaces.
    return '';
}
```

**Résultat attendu :**

```text
compute_name("Jean", "Michel", "Saurin") → "Jean Michel Saurin"
```

**Contrainte :** tu dois utiliser **l'interpolation de variables dans une chaîne à guillemets doubles**, et non la concaténation avec `.` ni `sprintf()`.

En PHP, l'interpolation insère la **valeur d'une variable** dans une chaîne :

```php
$prenom = "Alex";
echo "Bonjour $prenom";   // Bonjour Alex
echo 'Bonjour $prenom';   // Bonjour $prenom
```

Tu peux également entourer une variable d'accolades : `"Bonjour {$prenom}"`.

**Attention :** PHP ne prend pas en charge l'interpolation Ruby `#{...}` ; n'utilise pas cette syntaxe.

## 2. Créer un programme interactif

Ouvre `lib/interface.php`. La première ligne du programme charge déjà la fonction depuis l'autre fichier :

```php
require_once __DIR__ . '/compute_name.php';
```

Complète ensuite le programme pour :

1. afficher une question demandant le prénom ;
2. lire le prénom et le conserver dans une variable ;
3. recommencer pour le deuxième prénom et le nom de famille ;
4. appeler **`compute_name()`** avec les trois valeurs, dans le bon ordre ;
5. afficher `Hello, Jean Michel Saurin!` si les valeurs saisies sont `Jean`, `Michel` et `Saurin`.

Aides :

- `echo "Ton prénom : ";` affiche une question ;
- `fgets(STDIN)` récupère une ligne au clavier dans un programme CLI ;
- `trim(...)` enlève les espaces et le retour à la ligne aux extrémités de la saisie ;
- `echo "Hello, ...!\n";` affiche une ligne, `\n` représentant un saut de ligne dans les guillemets doubles.

**Contrainte :** l'interface doit réutiliser ta fonction `compute_name()` ; elle ne doit pas reconstruire le nom complet elle-même.

### Lancer le programme

Depuis le dossier de l'exercice :

```bash
php lib/interface.php
```

Exemple de dialogue attendu (le texte exact des questions est libre) :

```text
Prénom : Jean
Deuxième prénom : Michel
Nom : Saurin
Hello, Jean Michel Saurin!
```

Il faut utiliser le **terminal**, pas le navigateur : `STDIN` désigne ici l'entrée standard du programme en ligne de commande.

Si `php` n'est pas trouvé sur Windows avec XAMPP, depuis PowerShell :

```powershell
& "C:\xampp\php\php.exe" lib/interface.php
```

## 3. Vérifier ton travail

Depuis le dossier du challenge :

```bash
php tests.php
```

Les tests vérifient la fonction et l'interaction dans le terminal. Ils doivent tous être réussis pour terminer le challenge. Les tests de l'interface attendent un affichage contenant `Hello, Jean Michel Saurin!` et vérifient que le nom complet est calculé à partir des valeurs saisies.

Lance aussi ton programme manuellement : les tests ne remplacent pas un essai réel.

## 4. Perfectionnement (facultatif)

Après le message de salutation, affiche le nombre de caractères du nom complet, espaces compris.

Par exemple :

```text
Hello, Jean Michel Saurin!
Ton nom complet contient 18 caractères (espaces compris).
```

Pour gérer correctement les lettres accentuées, recherche `mb_strlen()` dans la documentation PHP et vérifie si l'extension `mbstring` est activée.

## Questions de bilan

1. Quelles variables utilises-tu ? Où leur affectes-tu une valeur ?
2. Qu'est-ce que la **portée** (*scope*) d'une variable ? Les paramètres de `compute_name()` sont-ils accessibles directement dans `interface.php` ?
3. Quelle différence existe-t-il entre définir une fonction et l'appeler ?
4. Quelle est la valeur retournée par `compute_name()` ? Pourquoi utiliser `return` plutôt que `echo` dans cette fonction ?
5. Dans quel ordre les instructions des deux fichiers sont-elles exécutées ?
6. Que produit `"Salut $prenom"` ? Et `'Salut $prenom'` ?
7. Pourquoi utilise-t-on `trim(fgets(STDIN))` pour la saisie ?
8. À quoi servent `require_once` et `__DIR__` ?

## Documentation

- [Chaînes de caractères](https://www.php.net/manual/fr/language.types.string.php)
- [Fonctions définies par l'utilisateur](https://www.php.net/manual/fr/functions.user-defined.php)
- [Portée des variables](https://www.php.net/manual/fr/language.variables.scope.php)
- [require_once](https://www.php.net/manual/fr/function.require-once.php)
- [fgets](https://www.php.net/manual/fr/function.fgets.php)
- [trim](https://www.php.net/manual/fr/function.trim.php)

### Git / GitHub

Travaille dans ton fork du dépôt enseignant. Après avoir terminé :

```bash
git add PHP/01-Programming-basics/04-What-your-name/
git commit -m "Termine le challenge 04 : nom complet"
git push
```

Adapte le chemin si tu n'as pas conservé exactement la même arborescence. Ne publie pas de corrigé enseignant dans ton fork.
