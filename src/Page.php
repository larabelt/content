<?php
namespace Ohio\Content;

use Illuminate\Database\Eloquent\Model;
use Ohio\Core;
use Ohio\Content;
use Ohio\Storage;

class Page extends Model
{
    use Core\Behaviors\SluggableTrait;
    use Content\Behaviors\ContentTrait;
    use Content\Behaviors\HandleableTrait;
    use Content\Behaviors\TaggableTrait;
    use Storage\Behaviors\FileableTrait;

    protected $morphClass = 'pages';

    protected $table = 'pages';

    protected $fillable = ['name'];

    public static $presets = [
        [100, 100, 'fit'],
        [200, 200, 'fit'],
        [300, 300, 'fit'],
        [500, 500, 'fit'],
    ];

    public function setTemplateAttribute($value)
    {
        $this->attributes['template'] = trim(strtolower($value));
    }

    public function setExtraAttribute($value)
    {
        $this->attributes['extra'] = trim($value);
    }

}