# Symblog
Blog  sous Symfony 4, 
permettant de gérer les articles, catégories et commentaires en utilisant le système d'authentifications des utilisateurs

Pré-requis : MySql et PHP 7.1.*

Installation

1. Clonez le dépôt : https://github.com/olpok/Symblog.git
2. Installer les dépendances : composer install
3. Créer la base de données : bin/console doctrine:database:create
4. Lancer la base de données : bin/console doctrine:schema:update –force
5. Lancez le serveur interne : php bin/console server:run
6. L'application est prête à être utilisée !
