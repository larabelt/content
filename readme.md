## Installation

Add the ServiceProvider to the providers array in config/app.php

```php
Belt\Content\BeltContentServiceProvider::class,
```

```
# publish
php artisan belt-content:publish
composer dumpautoload

# migration
php artisan migrate

# seed
php artisan db:seed --class=BeltContentSeeder

# compile assets
npm run
```