<?php
namespace Belt\Content;

use Belt;
use Illuminate\Database\Eloquent\Model;

class Page extends Model implements
    Belt\Core\Behaviors\SluggableInterface,
    Belt\Glue\Behaviors\CategorizableInterface,
    Belt\Content\Behaviors\HandleableInterface,
    Belt\Content\Behaviors\IncludesContentInterface,
    Belt\Content\Behaviors\IncludesSeoInterface,
    Belt\Content\Behaviors\IncludesTemplateInterface,
    Belt\Glue\Behaviors\TaggableInterface
{
    use Belt\Core\Behaviors\Sluggable;
    use Belt\Glue\Behaviors\Categorizable;
    use Belt\Content\Behaviors\IncludesSeo;
    use Belt\Content\Behaviors\IncludesContent;
    use Belt\Content\Behaviors\Handleable;
    use Belt\Content\Behaviors\IncludesTemplate;
    use Belt\Glue\Behaviors\Taggable;

    protected $morphClass = 'pages';

    protected $table = 'pages';

    protected $fillable = ['name'];

    public function sections()
    {
        return $this->hasMany(Section::class);
    }

}