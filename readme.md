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