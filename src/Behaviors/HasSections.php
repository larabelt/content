<?php
namespace Belt\Content\Behaviors;

use Belt\Content\Section;

trait HasSections
{

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sections()
    {
        return $this->morphMany(Section::class, 'owner')->whereNull('parent_id')->orderBy('_lft');
    }

}