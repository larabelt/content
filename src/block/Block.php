<?php
namespace Ohio\Content\Block;

use Ohio\Core;
use Ohio\Content;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use Core\Base\Behaviors\SluggableTrait;
    use Content\Base\Behaviors\ContentTrait;

    protected $morphClass = 'content/block';

    protected $table = 'blocks';

    protected $fillable = ['name', 'body'];

    public function setTemplateAttribute($value)
    {
        $this->attributes['template'] = trim(strtolower($value));
    }

}