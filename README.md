# Projet Web - Application PHP/MySQL

Projet realise dans le cadre du cours de projet web.

L'application est developpee en PHP avec une base de donnees MySQL/MariaDB et se lance avec XAMPP.

## Fonctionnalites principales

- inscription et connexion des utilisateurs ;
- espace membre ;
- profil utilisateur ;
- blog/news avec commentaires ;
- mini-chat ;
- boutique avec categories `Informatique`, `Livre` et `Hi-Fi` ;
- panier et commandes ;
- espace administrateur ;
- gestion des utilisateurs ;
- gestion des articles de la boutique.

## Prerequis

- XAMPP avec Apache et MySQL actifs ;
- PHP 8 ou version compatible ;
- phpMyAdmin ;
- un navigateur web.

## Installation du projet

1. Placer le dossier du projet dans :

```text
C:\xampp\htdocs\PROJET_WEB
```

Si le projet est recupere depuis un ZIP GitHub, renommer le dossier extrait en `PROJET_WEB` ou adapter l'URL de lancement au nom du dossier.

2. Demarrer Apache et MySQL depuis XAMPP.

3. Ouvrir phpMyAdmin.

4. Creer une base de donnees nommee :

```text
projet_web_noellie_angel_amr
```

5. Selectionner cette base de donnees.

6. Importer d'abord le fichier :

```text
database/schema.sql
```

7. Importer ensuite le fichier :

```text
database/seed.sql
```

8. Verifier que la configuration correspond bien au fichier :

```text
app/config/database.php
```

Configuration attendue avec XAMPP :

```text
host: localhost
dbname: projet_web_noellie_angel_amr
username: root
password: vide
```

## Lancement

Une fois le projet place dans `htdocs` et la base importee, ouvrir :

```text
http://localhost/PROJET_WEB/public/index.php
```

## Identifiants de test

Apres import de `database/schema.sql` puis `database/seed.sql`, un compte administrateur de test est disponible :

```text
Login : admin
Mot de passe : admin123
Email : admin@projet.local
```

Ce compte est uniquement prevu pour les tests locaux et la correction du projet. Il ne doit pas etre utilise en production.

## Base de donnees

Les fichiers SQL se trouvent dans le dossier `database` :

- `schema.sql` : structure de la base de donnees ;
- `seed.sql` : donnees de depart, categories, produits et compte administrateur ;
- `README.md` : details supplementaires sur l'installation de la base.

Si la base existe deja et que phpMyAdmin affiche des erreurs, supprimer la base, la recreer, puis reimporter les fichiers dans cet ordre :

```text
1. database/schema.sql
2. database/seed.sql
```

## Remarque

Le projet est prevu pour une execution locale avec XAMPP. Les informations de connexion fournies sont des donnees de test pour faciliter l'evaluation.
