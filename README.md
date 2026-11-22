# tp7_yassine-ait-moulay-ali
# TP7 : Gestion d'un centre de formation (CRUD multi-entités)



## Description du projet

Le centre de formation propose plusieurs formations. Les règles à respecter sont les suivantes :

- une formation peut accueillir plusieurs étudiants ;
- un étudiant est rattaché à une seule formation ;
- une formation contient plusieurs modules ;
- un module appartient à une seule formation.

Pour chaque entité, l'application permet d'ajouter, d'afficher, de modifier et de supprimer des enregistrements.

## Technologies utilisées

- PHP 8 pour la logique côté serveur ;
- PDO pour la connexion à MySQL et les requêtes préparées ;
- MySQL et phpMyAdmin pour la base de données ;
- XAMPP comme serveur local (Apache et MySQL) ;
- HTML, CSS et Bootstrap 5 pour l'interface ;
- VS Code comme éditeur de code.

## Modèle de données

La base s'appelle `tp7_crud` et contient trois tables.

**formations**
- clé primaire : `id_formation`
- attributs : `titre`, `duree_mois`, `niveau`

**etudiants**
- clé primaire : `id_etudiant`
- attributs : `nom`, `prenom`, `email`
- clé étrangère : `id_formation`

**modules**
- clé primaire : `id_module`
- attributs : `intitule`, `volume_horaire`
- clé étrangère : `id_formation`

Les relations sont : une formation pour plusieurs étudiants, et une formation pour plusieurs modules. La clé étrangère est placée du côté « plusieurs » de chaque relation. Elle est définie avec `ON DELETE RESTRICT` : on ne peut pas supprimer une formation qui a encore des étudiants ou des modules.

## Structure du projet

```
tp7-crud/
├── index.php              page d'accueil
├── includes/
│   ├── header.php         menu de navigation
│   └── footer.php         pied de page
├── database/
│   └── connexion.php      connexion PDO
├── formations/            index, create, edit, delete
├── etudiants/             index, create, edit, delete
└── modules/               index, create, edit, delete
```

## Fonctionnement

**Connexion :** le fichier `database/connexion.php` crée l'objet `$pdo`. Il est inclus dans chaque page avec `require_once`.

**Lecture (`index.php`) :** une requête `SELECT` récupère les données, qui sont affichées dans un tableau HTML. Pour les étudiants et les modules, un `INNER JOIN` permet d'afficher le titre de la formation au lieu de son identifiant.

**Ajout (`create.php`) :** un formulaire envoie les données en POST. Une requête `INSERT` préparée les enregistre, puis la page redirige vers la liste.

**Modification (`edit.php`) :** l'enregistrement est chargé grâce à son identifiant, le formulaire est prérempli, puis une requête `UPDATE ... WHERE` enregistre les changements.

**Suppression (`delete.php`) :** une requête `DELETE ... WHERE` supprime uniquement la ligne choisie, puis la page redirige vers la liste.

**Points importants :**
- les requêtes utilisent `prepare()` et `execute()` pour se protéger des injections SQL ;
- les valeurs affichées passent par `htmlspecialchars()` ;
- les listes déroulantes des formulaires sont alimentées depuis MySQL ;
- les messages de confirmation s'affichent grâce au paramètre `?msg=` dans l'URL ;
- le traitement PHP et les redirections sont placés avant l'inclusion de `header.php`, car `header('Location: ...')` ne fonctionne qu'avant tout affichage HTML.


## Utilisation

- Accueil : `http://localhost/tp7-crud/`
- Formations : `http://localhost/tp7-crud/formations/index.php`
- Étudiants : `http://localhost/tp7-crud/etudiants/index.php`
- Modules : `http://localhost/tp7-crud/modules/index.php`

Depuis chaque liste, le bouton Ajouter ouvre le formulaire de création, et les boutons Modifier et Supprimer agissent sur la ligne choisie.

## Tests réalisés

- affichage des trois listes, avec le titre de la formation pour les étudiants et les modules ;
- ajout d'un élément dans chaque entité, vérifié dans phpMyAdmin ;
- formulaires de modification préremplis et modifications enregistrées ;
- suppression ciblée : seule la ligne choisie disparaît ;
- suppression d'une formation liée refusée, avec un message d'erreur ;
- navigation entre l'accueil et les listes.

