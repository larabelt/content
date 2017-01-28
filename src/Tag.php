<?php
namespace Ohio\Content;

use Ohio\Core;
use Ohio\Content;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use Core\Behaviors\SluggableTrait;
    use Content\Behaviors\ContentTrait;

    protected $morphClass = 'content/tag';

    protected $table = 'tags';

    protected $fillable = ['name'];

    /**
     * Return tags associated with taggable
     *
     * @param $query
     * @param $taggable_type
     * @param $taggable_id
     * @return mixed
     */
    public function scopeTagged($query, $taggable_type, $taggable_id)
    {
        $query->select(['tags.*']);
        $query->join('taggables', 'taggables.tag_id', '=', 'tags.id');
        $query->where('taggables.taggable_type', $taggable_type);
        $query->where('taggables.taggable_id', $taggable_id);

        return $query;
    }

    /**
     * Return tags not associated with taggable
     *
     * @param $query
     * @param $taggable_type
     * @param $taggable_id
     * @return mixed
     */
    public function scopeNotTagged($query, $taggable_type, $taggable_id)
    {
        $query->select(['tags.*']);
        $query->leftJoin('taggables', function ($subQB) use ($taggable_type, $taggable_id) {
            $subQB->on('taggables.tag_id', '=', 'tags.id');
            $subQB->where('taggables.taggable_id', $taggable_id);
            $subQB->where('taggables.taggable_type', $taggable_type);
        });
        $query->whereNull('taggables.id');

        return $query;
    }

}