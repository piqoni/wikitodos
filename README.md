wikitodos
=========
TODO lists should be reusable.
![Homepage Screenshot](http://i.imgur.com/RYUpGwx.jpg)

The idea of wikitodos is very simple: ready-made TODOs & checklists. Do you want to cook Spaghetti, or go to the beach? 

There must be a TODO about that. 

This is my first Symfony Project. Actually, the whole point of this project is to learn & touch Symfony features, so there are a lot of improvements that could be made. 

![Admin Panel](http://i.imgur.com/QlGh2Sj.png)


## Features / TODO

* :white_check_mark: Search TODO-s
* :white_check_mark: User Authentication
* :white_check_mark: Admin Panel
* :x: Save TODOs to DB when user interacts with a TODO, to remember state of TODO elements
* :x: Users should be able to add their own TODO elements
* :x: Mobile version (duh)

## Installation 

Clone the repository and from project root install required packages.

```
composer install
```

Create database schema, load fixtures (sample data, admin user), install assets. 
```
php app/console doctrine:schema:create
php app/console doctrine:fixtures:load
php app/console assets:install
```

You may login to Administration backend at /admin using **admin/admin** credentials.
