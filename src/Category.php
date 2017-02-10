<?php
namespace Ohio\Content;

use Ohio;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model
{

    use NodeTrait;
    use Ohio\Core\Behaviors\SluggableTrait;
    use Ohio\Content\Behaviors\ContentTrait;

    protected $morphClass = 'categories';

    protected $table = 'categories';

    protected $fillable = ['name', 'body'];

    protected $appends = ['full_name'];

    public function getFullName($glue = ' > ')
    {
        $names = $this->getAncestors()->pluck('name')->all();
        $names[] = $this->name;

        return implode($glue, $names);
    }

    public function getFullNameAttribute()
    {
        return $this->getFullName();
    }

    /**
     * Return categories associated with categorizable
     *
     * @param $query
     * @param $categorizable_type
     * @param $categorizable_id
     * @return mixed
     */
    public function scopeCategoried($query, $categorizable_type, $categorizable_id)
    {
        $query->select(['categories.*']);
        $query->join('categorizables', 'categorizables.category_id', '=', 'categories.id');
        $query->where('categorizables.categorizable_type', $categorizable_type);
        $query->where('categorizables.categorizable_id', $categorizable_id);
        $query->orderBy('categorizables.position');

        return $query;
    }

    /**
     * Return categories not associated with categorizable
     *
     * @param $query
     * @param $categorizable_type
     * @param $categorizable_id
     * @return mixed
     */
    public function scopeNotCategoried($query, $categorizable_type, $categorizable_id)
    {
        $query->select(['categories.*']);
        $query->leftJoin('categorizables', function ($subQB) use ($categorizable_type, $categorizable_id) {
            $subQB->on('categorizables.category_id', '=', 'categories.id');
            $subQB->where('categorizables.categorizable_id', $categorizable_id);
            $subQB->where('categorizables.categorizable_type', $categorizable_type);
        });
        $query->whereNull('categorizables.id');

        return $query;
    }

}