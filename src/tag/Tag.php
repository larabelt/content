<?php
namespace Ohio\Content\Tag;

use Illuminate\Database\Eloquent\Model;
use Ohio\Core\Base\Behaviors\SluggableTrait;

class Tag extends Model
{
    use SluggableTrait;

    protected $morphClass = 'content/tag';

    protected $table = 'tags';

    protected $guarded = ['id'];

    public function __toString()
    {
        return $this->name;
    }

    public function setBodyAttribute($value)
    {
        $this->attributes['body'] = trim($value);
    }

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