<?php
namespace Ohio\Content\Base\Behaviors;

use Ohio\Content\Handle\Handle;

trait HandleableTrait
{

    public function handle()
    {
        return $this->morphOne(Handle::class, 'handleable')->where('delta', 1.00);
    }

    public function handles()
    {
        return $this->morphMany(Handle::class, 'handleable')->orderby('delta');
    }

}