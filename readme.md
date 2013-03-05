## Togo

This is an implementation of the classic To Do/Task web application, based on the Laravel 4 PHP framework and the AngularJS framework. The backend application is exposed via an authenticated RESTful API which interfaces with the client-side MVC implementation in AngularJS to dynamically update and interact with the backend.

### Live Demonstration

A public live installation of the application is accessible at the [development server](http://sandbox.dev.stumpfwerk.com/).

### Setup

If you want to try it out for yourself, you may clone the repository and install Laravel 4 the usual way:

    git clone git://github.com/alanly/togo.git togo
    cd togo
    curl -s https://getcomposer.org/installer | php
    php composer.phar install

Afterwards, you will have to modify the database configuration at `app/config/database.php.default` and then rename it to `database.php`.
Then run the database migrations via `php artisan migrate`. If it fails, then either your database configuration details are incorrect or you haven't created the necessary SQLite database file with the appropriate permissions.
