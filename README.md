## Prerequisites

-   PHP v8.2 installed
-   Composer v2.6 installed

## Installation Guide

-   Run composer install
-   Create a database.sqlite file in the route directory
-   Create .env file according to .envexample (change the path of the database)
-   Run php artisan migrate
-   Run php artisan:db seed
-   Run php artisan serve

## Testing Guide

-   Run php artisan migrate --env=testing
-   Run php artisan db:seed --env=testing
-   Run php artisan test --env=testing
