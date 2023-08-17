# Projet PHP To-Do List
Projet To-Do List développé en PHP avec utilisation de la librairie PDO pour l'accès à la base de données. Cette application vous permet de gérer vos tâches quotidiennes en les ajoutant, en les modifiant et en les supprimant.

## Prérequis
PHP 7.4 ou supérieur
Serveur web (Apache, Nginx, etc.)
Composer (pour installer les dépendances)
Base de données MySQL

## Installation
1 - Clonez ce dépôt dans le répertoire de votre choix :

```
Copy code
git clone https://github.com/votre-utilisateur/Projet-PHP-Todo.git
```

2 - Naviguez vers le répertoire du projet :

```
Copy code
cd Projet-PHP-Todo
```
3 - Installez les dépendances à l'aide de Composer :

```
composer install
```

4 - Copiez le fichier .env.example en .env et configurez vos informations de base de données :

```
DB_HOST=127.0.0.1
DB_PORT=3306
DB_NAME=votre_base_de_donnees
DB_USERNAME=votre_nom_utilisateur
DB_PASSWORD=votre_mot_de_passe
```

5 - Créez la base de données correspondante à la configuration dans le fichier .env.

6 - Création de table (bientot disponible)

7 - Lancez le serveur web (par exemple, avec PHP's built-in server) :

```
php -S 127.0.0.1:8000 -t public
```

8 - Accédez à l'application dans votre navigateur à l'adresse http://127.0.0.1:8000.

## Fonctionnalités
- Ajoutez, modifiez et supprimez des tâches.
- Visualisez la liste de vos tâches dans un tableau interactif.
- Utilisation de Bootstrap pour une interface conviviale.

## Auteurs
Florimond Jouffroy
