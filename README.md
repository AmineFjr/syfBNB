Fixtures : implementer fausses jeux de données

composer require orm-fixtures --dev

php bin/console make:fixtures

php bin/console doctrine:fixtures:load

-------------------------------------------------

Faker : données aléatoires 

composer require fzaninotto/faker

-------------------------------------------------

Slug : Génération de Slug

composer require cocur/slugify

-------------------------------------------------

Controller: Création d'un Controller 

php bin/console make:controller AdController


-------------------------------------------------

Form: Créer une classe contenant la création du formulaire

php bin/console make:form AnnonceType

-------------------------------------------------

Pour enlever le .env :

git rm --cached .env
