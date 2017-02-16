## Installation

```
# install assets & migrate
php artisan belt-content:publish
composer dumpautoload

# migrate & seed
php artisan migrate
php artisan db:seed --class=BeltContentSeeder

# compile assets
gulp
```