<?php
namespace Belt\Content;

use Belt;
use Illuminate\Database\Eloquent\Model;

class Page extends Model implements
    Belt\Core\Behaviors\SluggableInterface,
    Belt\Content\Behaviors\CategorizableInterface,
    Belt\Content\Behaviors\HandleableInterface,
    Belt\Content\Behaviors\IncludesContentInterface,
    Belt\Content\Behaviors\IncludesSeoInterface,
    Belt\Content\Behaviors\IncludesTemplateInterface,
    Belt\Content\Behaviors\TaggableInterface
{
    use Belt\Core\Behaviors\Sluggable;
    use Belt\Content\Behaviors\Categorizable;
    use Belt\Content\Behaviors\IncludesSeo;
    use Belt\Content\Behaviors\IncludesContent;
    use Belt\Content\Behaviors\Handleable;
    use Belt\Content\Behaviors\IncludesTemplate;
    use Belt\Content\Behaviors\Taggable;

    protected $morphClass = 'pages';

    protected $table = 'pages';

    protected $fillable = ['name'];

    public function sections()
    {
        return $this->hasMany(Section::class);
    }

}