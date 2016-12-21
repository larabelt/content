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

    public function setTemplateAttribute($value)
    {
        $this->attributes['template'] = trim(strtolower($value));
    }

    public function setBodyAttribute($value)
    {
        $this->attributes['body'] = trim($value);
    }

}