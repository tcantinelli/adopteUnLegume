# Application testSymfony

## Installation du projet
1. Cloner le dépôt https://github.com/tcantinelli/testSymfony.git
2. Ouvrir une console et se rendre dans le dossier du projet (/testSymfony)
3. Installer les dépendances:
    composer install

## Base de données et fixtures
1. Editer le fichier .env à la racine du projet
2. Dans la partie "doctrine/doctrine-bundle", vérifier la configuration de l'URL de la base de données
    DATABASE_URL=sqlite:///%kernel.project_dir%/var/achats.db

3. Dans la console, créer la base de données SQLite
    php bin/console doctrine:migrations:migrate

4. Ajouter les données des fixtures dans la base de données
    php bin/console doctrine:fixtures:load
    

## Assets
1. Installer les paquets necessaires
    yarn install
2. Créer les assets suivant la configuration du fichier webpack.config.js
    yarn encore dev

## Executer le projet
1. Utiliser le web server de Symfony:
    composer require symfony/web-server-bundle --dev

2. Lancer le serveur
    php bin/console server:run

3. Dans le navigateur, entrer l'url
    http://127.0.0.1:8000

Note: Pour lancer l'application sur un autre serveur web Apache, il est necessaire de configurer le projet:
    - Executer la commande
        composer require symfony/apache-pack
    - Mettre en place le virtualhost, l'url doit pointer vers le dossier /public du projet
        Aide: https://symfony.com/doc/current/setup/web_server_configuration.html

##Administration
Accès à la page d'administration
Login: admin
Password: password

## Tests
Le projet contient 3 tests:
1. Test unitaire PanierTest (/tests/Functions/PanierTest.php)
    => Vérifie le calcul de la somme totale des prix des produits du panier

2. test fonctionnel testResponseHomePage (/tests/Controller/HomeControllerTest.php)
    => Vérifie le code de retour de la requête à la racine du projet (page Home)

3. test fonctionnel testShowNumberProductsHomePage (/tests/Controller/HomeControllerTest.php)
    => Vérifie le nombre de produits du panier affiché sur la page Home. Dans ce test, le client possède 3 articles dans son panier stocké en session.

Pour lancer les tests, executer la commande dans la console:
  ./bin/phpunit

