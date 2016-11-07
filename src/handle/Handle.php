<?php
namespace Ohio\Content\Handle;

use Illuminate\Database\Eloquent\Model;
use Ohio\Content\Base\Behaviors\SeoTrait;
use Ohio\Core\Base\Behaviors\SluggableTrait;

class Handle extends Model
{
    protected $morphClass = 'content/handle';

    protected $table = 'handles';

    protected $guarded = ['id'];

    public function __toString()
    {
        return $this->name;
    }

    public function setIsActiveAttribute($value)
    {
        $this->attributes['is_active'] = boolval($value);
    }

    public function setTemplateAttribute($value)
    {
        $this->attributes['template'] = trim(strtolower($value));
    }

    public function setIntroAttribute($value)
    {
        $this->attributes['intro'] = trim($value);
    }

    public function setBodyAttribute($value)
    {
        $this->attributes['body'] = trim($value);
    }

    public function setExtraAttribute($value)
    {
        $this->attributes['extra'] = trim($value);
    }

}