<?php

namespace Belt\Content\Behaviors;

use Belt;
use DB;
use Belt\Content\Section;

trait HasSections
{

    /**
     * Binds events to subclass
     */
    public static function bootHasSections()
    {
        static::observe(Belt\Content\Observers\HasSectionsObserver::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sections()
    {
        return $this->morphMany(Section::class, 'owner')->whereNull('parent_id')->orderBy('_lft');
    }

    /**
     * @return string
     */
    public function getHasSectionsCacheKey()
    {
        return sprintf('sections.%s.%s', $this->getMorphClass(), $this->getKey());
    }

    public function purgeSections()
    {
        DB::connection($this->getConnectionName())
            ->table('sections')
            ->where('owner_id', $this->id)
            ->where('owner_type', $this->getMorphClass())
            ->delete();
    }

}