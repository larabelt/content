<?php
namespace Ohio\Content\Page;

use Illuminate\Database\Eloquent\Model;
use Ohio\Core;
use Ohio\Content;

class Page extends Model
{
    use Core\Base\Behaviors\SluggableTrait;
    use Content\Base\Behaviors\ContentTrait;
    use Content\Base\Behaviors\HandleableTrait;
    use Content\Base\Behaviors\TaggableTrait;

    protected $morphClass = 'pages';

    protected $table = 'pages';

    protected $fillable = ['name'];

    public function setTemplateAttribute($value)
    {
        $this->attributes['template'] = trim(strtolower($value));
    }

    public function setExtraAttribute($value)
    {
        $this->attributes['extra'] = trim($value);
    }

}