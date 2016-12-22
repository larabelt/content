<?php
namespace Ohio\Content\Block;

use Illuminate\Database\Eloquent\Model;
use Ohio\Core\Base\Behaviors\SluggableTrait;

class Block extends Model
{
    use SluggableTrait;

    protected $morphClass = 'content/block';

    protected $table = 'blocks';

    protected $fillable = ['name', 'body'];

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