<?php
namespace Belt\Content\Behaviors;

use Belt\Content\Category;
use Rutorika\Sortable\MorphToSortedManyTrait;

interface CategorizableInterface
{

    function categories();

}