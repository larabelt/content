<?php
namespace Ohio\Content\Page;

use Illuminate\Database\Eloquent\Model;
use Ohio\Core\Base\Behaviors\Sluggable\SluggableTrait;

class Page extends Model
{
    use SluggableTrait;

    protected $morphClass = 'content/page';

    protected $table = 'pages';

    protected $guarded = ['id'];

    public function __toString()
    {
        return $this->title;
    }

    public function setIsActiveAttribute($value)
    {
        $this->attributes['is_active'] = boolval($value);
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = trim($value);
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = str_slug($value);
    }

    public function setTemplateAttribute($value)
    {
        $this->attributes['template'] = trim($value);
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

    public function setMetaTitleAttribute($value)
    {
        $this->attributes['meta_title'] = trim($value);
    }

    public function setMetaKeywordsAttribute($value)
    {
        $this->attributes['meta_keywords'] = trim($value);
    }

    public function setMetaDescriptionAttribute($value)
    {
        $this->attributes['meta_description'] = trim($value);
    }

}