<?php
namespace Ohio\Content\Behaviors;

use Ohio\Content\Section;
use Rutorika\Sortable\MorphToSortedManyTrait;

trait SectionableTrait
{

    use MorphToSortedManyTrait;

    /**
     * @todo deprecate
     *
     * Eloquent renamed getBelongsToManyCaller to guessBelongsToManyRelation
     * and the package Rutorika\Sortable currently expects the old name to exist
     *
     * @return mixed
     */
    protected function getBelongsToManyCaller()
    {
        return $this->guessBelongsToManyRelation();
    }

    public function sections()
    {
        return $this->morphToSortedMany(Section::class, 'sectionable');
    }

}