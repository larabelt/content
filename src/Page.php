<?php
namespace Ohio\Content;

use Ohio;
use Illuminate\Database\Eloquent\Model;

class Page extends Model implements
    Ohio\Core\Behaviors\SluggableInterface,
    Ohio\Content\Behaviors\CategorizableInterface,
    Ohio\Content\Behaviors\HandleableInterface,
    Ohio\Content\Behaviors\IncludesContentInterface,
    Ohio\Content\Behaviors\IncludesSeoInterface,
    Ohio\Content\Behaviors\IncludesTemplateInterface,
    Ohio\Content\Behaviors\TaggableInterface
{
    use Ohio\Core\Behaviors\Sluggable;
    use Ohio\Content\Behaviors\Categorizable;
    use Ohio\Content\Behaviors\IncludesSeo;
    use Ohio\Content\Behaviors\IncludesContent;
    use Ohio\Content\Behaviors\Handleable;
    use Ohio\Content\Behaviors\IncludesTemplate;
    use Ohio\Content\Behaviors\Taggable;

    protected $morphClass = 'pages';

    protected $table = 'pages';

    protected $fillable = ['name'];

    public function sections()
    {
        return $this->hasMany(Section::class);
    }

}