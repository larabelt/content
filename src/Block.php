<?php
namespace Ohio\Content;

use Ohio\Core;
use Ohio\Content;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use Core\Behaviors\Sluggable;
    use Content\Behaviors\ContentTrait;

    protected $morphClass = 'blocks';

    protected $table = 'blocks';

    protected $fillable = ['name', 'body'];

    public function setTemplateAttribute($value)
    {
        $this->attributes['template'] = trim(strtolower($value));
    }

}