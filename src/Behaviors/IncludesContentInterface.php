<?php
namespace Belt\Content\Behaviors;

interface IncludesContentInterface
{
    public function setIsActiveAttribute($value);

    public function setIntroAttribute($value);

    public function setBodyAttribute($value);

}