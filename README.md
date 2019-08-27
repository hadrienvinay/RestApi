rest_api
========

A Symfony project created on March 19, 2019, 1:52 pm.
Rest Api set up to simulate STET DSP2 API Specifications for testings
In order to set up the project, you can find classic information here : https://symfony.com/doc/current/setup.html#setting-up-an-existing-symfony-project

Simple set up: 
1. Clone this project in your favorite directory
2. Install dependencies in the created folder with composer : composer install
3. Launch your local server (like Wamp, Mamp)
4. Check the good set up of the project (Welcome to Symfony message): http://localhost/restapi/web/app_dev.php/
5. Set up the database with exemple data: php bin/console doctrine:database:create (https://symfony.com/doc/3.1/doctrine.html for more infos) and import database file (stetdata.sql) in phpmyAdmin (user:root; psw:) , there is no password :)
6. You can start testing build API in local (refer to Controller in the folder for address : RestApi\src\AppBundle\Controller)
7. Local address of the API is for instance : GET http://localhost/restapi/web/app_dev.php/v1/accounts for accounts views
