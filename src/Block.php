<?php
namespace Ohio\Content;

use Ohio;
use Illuminate\Database\Eloquent\Model;

class Block extends Model implements
    Ohio\Core\Behaviors\SluggableInterface,
    Ohio\Content\Behaviors\IncludesContentInterface
{
    use Ohio\Core\Behaviors\Sluggable;
    use Ohio\Content\Behaviors\IncludesContent;

    protected $morphClass = 'blocks';

    protected $table = 'blocks';

    protected $fillable = ['name', 'body'];

    public function setTemplateAttribute($value)
    {
        $this->attributes['template'] = trim(strtolower($value));
    }

}