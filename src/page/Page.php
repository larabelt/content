<?php
namespace Ohio\Content\Page;

use Illuminate\Database\Eloquent\Model;
use Ohio\Core\Base\Behaviors\SluggableTrait;
use Ohio\Content\Base\Behaviors\SeoTrait;
use Ohio\Content\Base\Behaviors\HandleableTrait;

class Page extends Model
{
    use HandleableTrait;
    use SluggableTrait;
    use SeoTrait;

    protected $morphClass = 'content/page';

    protected $table = 'pages';

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