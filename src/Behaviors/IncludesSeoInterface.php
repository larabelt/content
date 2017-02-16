<?php
namespace Belt\Content\Behaviors;

interface IncludesSeoInterface
{

    public function setMetaTitleAttribute($value);

    public function setMetaKeywordsAttribute($value);

    public function setMetaDescriptionAttribute($value);

    public function getMetaTitleAttribute($value);

}