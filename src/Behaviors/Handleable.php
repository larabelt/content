<?php
namespace Belt\Content\Behaviors;

use Belt\Content\Handle;

trait Handleable
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