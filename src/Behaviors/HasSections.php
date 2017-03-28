<?php
namespace Belt\Content\Behaviors;

use DB;
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

    public function purgeSections()
    {
        DB::connection($this->getConnectionName())
            ->table('sections')
            ->where('owner_id', $this->id)
            ->where('owner_type', $this->getMorphClass())
            ->delete();
    }

}