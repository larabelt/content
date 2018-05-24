<?php

namespace Belt\Content\Behaviors;

use DB;
use Belt\Content\Term;

trait Termable
{

    /**
     * @return \Rutorika\Sortable\BelongsToSortedMany
     */
    public function terms()
    {
        return $this->morphToSortedMany(Term::class, 'termable');
    }

    /**
     * Begin term query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function termQB()
    {
        return Term::query();
    }

    /**
     * Purge associated terms
     */
    public function purgeTerms()
    {
        DB::connection($this->getConnectionName())
            ->table('termables')
            ->where('termable_id', $this->id)
            ->where('termable_type', $this->getMorphClass())
            ->delete();
    }

    /**
     * Return items associated with the given term
     *
     * @param $query
     * @param $term
     * @return mixed
     */
    public function scopeHasTerm($query, $term)
    {
        $query->whereHas('terms', function ($query) use ($term) {
            $terms = is_array($term) ? $term : explode(',', $term);
            foreach ($terms as $n => $term) {
                $column = is_numeric($term) ? 'id' : 'slug';
                $method = $n === 0 ? 'where' : 'orWhere';
                $query->$method('terms.' . $column, $term);
            }
        });

        return $query;
    }

    /**
     * Return items associated with the given term
     *
     * @param $query
     * @param $term
     * @return mixed
     */
    public function scopeInTerm($query, $term)
    {
        $query->whereHas('terms', function ($query) use ($term) {
            $terms = is_array($term) ? $term : explode(',', $term);
            foreach ($terms as $n => $value) {
                $method = $n === 0 ? 'where' : 'orWhere';
                $term = $this->termQB()->sluggish($value)->first();
                $query->$method(function ($sub) use ($term) {
                    $sub->where('terms._lft', '>=', $term->_lft);
                    $sub->where('terms._rgt', '<=', $term->_rgt);
                });
            }
        });

        return $query;
    }

}