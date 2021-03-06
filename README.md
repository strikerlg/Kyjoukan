Kyjoukan
========

Tournament planner and scheduler

This web application will take as input :
- An event details (name, date...)
- A list of teams that will participate in the said event
- A list of available grounds where to play

Then the user will create the first phase of the game, with two possible rules :
- Round-robin : each team plays against each other team in the same pool
- Brackets : each team plays another one; each winner play another winner, and so on...

Features
--------

Once given the teams, grounds and number of pools (group of teams), the application will:
- Automatically dispatch the teams into pools
- Let the user fine tune manually this dispatch
- Provide a printable schedule
- Provide printable game sheets ready to be filled
- Enable the user to type in results
- Provide printable rankings

Once the first phase is over, the user can create another one (and so on...).

Planned features
----------------
- Ability to add games manually
- Ability to remove games manually
- Ability to order teams
- Dispatch by order

Server Installation
-------------------

To install and run Kyjoukan on your own server :

* Install Symfony 2.8 http://symfony.com/download
* Download Kyjoukan :
```bash
$ php composer.phar require "abienvenu/kyjoukan":"dev-master"
```
* Add Kyjoukan in your AppKernel.php, and also load StofDoctrineExtensionsBundle :
```php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Abienvenu\KyjoukanBundle\KyjoukanBundle(),
        new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),
    );
}
```
* Include the route from your app/config/routing.yml :
```YAML
kyjoukan:
    resource: "@KyjoukanBundle/Resources/config/routing.yml"
    prefix: /kyjoukan
```
* Also activate sluggable in your app/config/config.yml :
```YAML
stof_doctrine_extensions:
    orm:
        default:
            sluggable: true
```
