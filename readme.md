## Installation

```
# install assets & migrate
php artisan ohio-content:publish
composer dumpautoload

# migrate & seed
php artisan migrate
php artisan db:seed --class=OhioContentSeeder

# compile assets
gulp
```

## Misc

```
# unit testing
phpunit --coverage-html=public/tests/ohio/content/base   -c vendor/ohiocms/content/tests/base   --bootstrap=bootstrap/autoload.php
phpunit --coverage-html=public/tests/ohio/content/block  -c vendor/ohiocms/content/tests/block  --bootstrap=bootstrap/autoload.php
phpunit --coverage-html=public/tests/ohio/content/handle -c vendor/ohiocms/content/tests/handle --bootstrap=bootstrap/autoload.php
phpunit --coverage-html=public/tests/ohio/content/page   -c vendor/ohiocms/content/tests/page   --bootstrap=bootstrap/autoload.php
```