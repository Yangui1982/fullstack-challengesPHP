# TP — À la découverte des fonctions PHP et de Git

**BTS SIO 1re année — Windows, macOS et Linux**  
**Durée indicative : 60 à 90 minutes**  
**Prérequis :** PHP 8 ou supérieur, VS Code, Git, compte GitHub.

## Objectifs

- Trouver dans la documentation PHP les fonctions standard adaptées à un besoin.
- Tester les fonctions PHP dans un fichier d’essais exécuté depuis le terminal.
- Comprendre la différence entre chaînes, nombres et tableaux en PHP.
- Faire passer les tests automatisés en vert, progressivement.
- Enregistrer son travail avec des commits Git et le publier sur son fork GitHub.

## 1. Découvrir et tester les fonctions PHP

PHP propose de nombreuses **fonctions natives** : elles permettent d’effectuer des opérations courantes sans devoir tout programmer soi-même. Par exemple, on peut mettre du texte en majuscules, obtenir le type d’une valeur ou mélanger un tableau.

Pour découvrir ces fonctions, vous utiliserez le fichier **`essais.php`**. Vous pouvez y écrire des instructions PHP, puis lancer le fichier dans le terminal intégré de VS Code afin d’observer les résultats. Modifiez le code et recommencez autant de fois que nécessaire.

Ouvrez le dossier du TP dans VS Code, puis **Terminal → Nouveau terminal**. Vérifiez que PHP est accessible :

```bash
php --version
php essais.php
```

Sur Windows, si la commande `php` n’est pas reconnue, utilisez directement PHP fourni avec XAMPP (si installé à cet emplacement) :

```powershell
C:\xampp\php\php.exe essais.php
```

Sur macOS et Linux, si `php` n’est pas reconnu, vérifiez le chemin de l’exécutable PHP installé sur votre machine ou demandez de l’aide à l’enseignant.

La fonction `var_dump()` permet d’afficher **la valeur et le type** d’une expression. Elle est particulièrement utile pour faire des essais.

### Testez les expressions suivantes

En PHP, de nombreuses opérations courantes se réalisent à l’aide de **fonctions**. On écrit le nom de la fonction, suivi des paramètres entre parenthèses, par exemple `strtoupper("bonjour")`. Certaines fonctions renvoient une nouvelle valeur ; d’autres modifient directement une variable. La documentation permet de vérifier leur fonctionnement.

```php
var_dump(get_debug_type('A string'));
var_dump(get_debug_type(19));
var_dump(get_debug_type([1, 2, 3]));
var_dump(strtoupper('A string'));
var_dump(strtolower('A STRING'));
$numbers = [1, 2, 3];
shuffle($numbers);
var_dump($numbers);
```

Questions : que renvoie `get_debug_type()` ? Que produit `shuffle()` ? Pourquoi faut-il afficher `$numbers` ensuite ?

## 2. Votre mission

Dans **`fonctions.php`**, compléter les 8 fonctions ci-dessous **sans changer leur signature** :

| Fonction | Comportement attendu | Exemple |
| --- | --- | --- |
| `get_rid_of_surrounding_whitespaces` | Enlever espaces autour d'une chaîne | `"  hey yo  "` → `"hey yo"` |
| `belongs_to` | Indiquer si une chaîne contient un mot | `("hey jude", "jude")` → `true` |
| `replace` | Remplacer toutes les occurrences | `("casanova", "a", "o")` → `"cosonovo"` |
| `exactly_divide` | Réaliser une division décimale | `(13, 4)` → `3.25` |
| `divisible_by_two` | Tester si un entier est pair | `6` → `true` |
| `random_subset` | Tirer N valeurs distinctes au hasard | `(["a","b","c"], 2)` → 2 valeurs |
| `randomize` | Renvoyer le tableau dans un ordre aléatoire | `[1,2,3,4]` → ordre mélangé |
| `ascending_order` | Trier par ordre croissant | `[7,3,1]` → `[1,3,7]` |

**Contraintes :**

1. Utiliser autant que possible les fonctions natives et opérateurs de PHP ; ne pas réécrire un algorithme déjà disponible.
2. Ne modifier que `fonctions.php` pour la solution. `essais.php` sert de brouillon libre.
3. Ne pas modifier `tests.php`.
4. Préserver le tableau d'origine pour les fonctions de mélange, de tirage et de tri ; retourner un nouveau tableau.
5. Les fonctions de tirage renvoient des **valeurs** (pas les indices). Pour `random_subset`, si N vaut 0, retourner `[]`.
6. On considère que le diviseur de `exactly_divide` est non nul et que la taille de tirage est comprise entre 0 et le nombre d'éléments du tableau. Les tableaux de tirage utilisés dans ce TP contiennent des valeurs distinctes.

**Important :** `sort()` et `shuffle()` modifient le tableau qui leur est passé et renvoient un booléen. Il faudra donc réfléchir à la copie du tableau. Toutes les solutions ne tiennent pas en une seule ligne : privilégiez du code juste et lisible.

## 3. Cherchez puis testez

Documentation officielle :

- Chaînes : https://www.php.net/manual/fr/ref.strings.php
- Tableaux : https://www.php.net/manual/fr/ref.array.php
- Opérateurs arithmétiques : https://www.php.net/manual/fr/language.operators.arithmetic.php
- Documentation générale : https://www.php.net/manual/fr/

**Méthode attendue :** 1) décrire l'opération ; 2) chercher une fonction PHP appropriée ; 3) lire la signature et le type de retour ; 4) faire un essai dans `essais.php` ; 5) écrire la solution ; 6) lancer les tests.

## 4. Exécuter les tests

Dans le dossier du projet :

```bash
php tests.php
```

Sur Windows avec PHP uniquement accessible via XAMPP :

```powershell
C:\xampp\php\php.exe tests.php
```

Au départ, les tests échouent : c'est normal. Après chaque fonction, relancer les tests pour observer votre progression. Il y a **19 vérifications** ; le but est d'atteindre **19 tests réussis et 0 échec**.

## 5. Git et GitHub : à faire pendant le TP

**D'abord, sur GitHub :** ouvrir le dépôt public communiqué par l'enseignant, cliquer sur **Fork** et créer une copie dans **son propre compte**.

Puis cloner **l'URL de votre fork**, et non celle du dépôt enseignant :

```bash
git clone https://github.com/VOTRE_IDENTIFIANT/NOM_DU_DEPOT.git
cd NOM_DU_DEPOT
code .
```

Ne pas publier le travail directement sur le dépôt enseignant. Les noms exacts de dépôt seront fournis en classe.

**Étape A — après les premières fonctions** :

```bash
git status
git add fonctions.php
git commit -m "Résolution des fonctions sur les chaînes"
git push
```

**Étape B — après les calculs** :

```bash
git add fonctions.php
git commit -m "Ajout des fonctions numériques"
git push
```

**Étape C — une fois les tableaux terminés** :

```bash
git add fonctions.php
git commit -m "Finalisation des fonctions sur les tableaux"
git push
```

> En cas de tests incomplets, enregistrer quand même un commit décrivant précisément l'avancement. **Ne pas inclure le corrigé du professeur.**

## 6. Questions de bilan

1. Quels types PHP avez-vous rencontrés ? En quoi un type se distingue-t-il d'une classe ?
2. Quelle est la syntaxe générale pour appeler une fonction PHP ? Donnez un exemple avec une chaîne de caractères.
3. Pourquoi consulter la documentation avant de coder sa propre fonction ?
4. À quoi sert le fichier `essais.php` dans votre démarche ?
5. Pourquoi `shuffle($tableau)` ne renvoie-t-il pas directement le tableau mélangé ?
6. Quelle différence y a-t-il entre `git commit` et `git push` ?

## Livrable

Communiquer l'URL **du fork personnel** sur GitHub. Le dépôt doit contenir `fonctions.php` complété et **au moins trois commits** décrivant les étapes. La réussite des 19 tests servira de vérification technique.
