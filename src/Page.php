<?php
namespace Ohio\Content;

use Ohio;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
    //implements Ohio\Content\Behaviors\IncludeInterface
{
    use Ohio\Core\Behaviors\SluggableTrait;
    use Ohio\Content\Behaviors\ContentTrait;
    use Ohio\Content\Behaviors\HandleableTrait;
    use Ohio\Content\Behaviors\IncludeTrait;
    use Ohio\Content\Behaviors\TaggableTrait;
    use Ohio\Storage\Behaviors\FileableTrait;

    protected $morphClass = 'pages';

    protected $table = 'pages';

    protected $fillable = ['name'];

    public static $presets = [
        [100, 100, 'fit'],
        [200, 200, 'fit'],
        [300, 300, 'fit'],
        [500, 500, 'fit'],
    ];

    public function sections()
    {
        return $this->hasMany(Section::class);
    }

    public function setTemplateAttribute($value)
    {
        $this->attributes['template'] = trim(strtolower($value));
    }

    public function setExtraAttribute($value)
    {
        $this->attributes['extra'] = trim($value);
    }

}