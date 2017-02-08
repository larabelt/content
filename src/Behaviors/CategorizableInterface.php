<?php
namespace Ohio\Content\Behaviors;

use Ohio\Content\Category;
use Rutorika\Sortable\MorphToSortedManyTrait;

interface CategorizableInterface
{

    function categories();

}