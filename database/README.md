# Base de donnees du projet

## Nom de la base

Tous les membres du groupe doivent utiliser le meme nom de base de donnees :

```sql
projet_web_noellie_angel_amr
```

Ce nom doit correspondre au fichier `app/config/database.php`.

## Installation depuis phpMyAdmin

1. Ouvrir phpMyAdmin avec XAMPP.
2. Creer une nouvelle base de donnees :

```sql
projet_web_noellie_angel_amr
```

3. Selectionner cette base dans phpMyAdmin.
4. Aller dans l'onglet `Importer`.
5. Importer d'abord `database/schema.sql`.
6. Revenir dans l'onglet `Importer`.
7. Importer ensuite `database/seed.sql`.

## Role des fichiers

`schema.sql` contient la structure de la base :

- creation des tables ;
- cles primaires ;
- auto-increments ;
- cles etrangeres ;
- colonnes attendues par le code PHP.

`seed.sql` contient les donnees minimales communes :

- categories de vente obligatoires ;
- produits de base de la boutique ;
- compte administrateur de test.

## Compte administrateur de test

Apres avoir importe `seed.sql`, un compte admin commun est disponible :

```text
Login : admin
Email : admin@projet.local
Mot de passe : admin123
```

Ce compte sert uniquement au developpement local et aux tests du projet.

## Donnees boutique

Le fichier `seed.sql` cree les 3 categories demandees dans la consigne :

```text
Informatique
Livre
Hi-Fi
```

Il ajoute aussi 5 articles actifs par categorie, soit 15 articles disponibles dans la boutique.

La liste des articles est visible par tout le monde. Seuls les utilisateurs connectes peuvent valider une commande.

L'administrateur peut ajouter, modifier ou desactiver des articles depuis :

```text
?page=admin_products
```

## Si la base existe deja

Si phpMyAdmin affiche des erreurs comme `Table already exists`, il faut repartir proprement :

1. Supprimer la base `projet_web_noellie_angel_amr`.
2. La recreer avec le meme nom.
3. Refaire l'import dans cet ordre :

```text
1. schema.sql
2. seed.sql
```

## Important

Git met a jour le code PHP, mais il ne met pas automatiquement a jour la base MySQL locale de chaque personne.

Quand une table, une colonne ou une donnee de base change, chaque membre doit reimporter les fichiers SQL dans sa base locale.
