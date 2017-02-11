<?php
namespace Ohio\Content;

use Ohio;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
    implements Ohio\Content\Behaviors\CategorizableInterface,
    Ohio\Content\Behaviors\TemplateInterface
{
    use Ohio\Core\Behaviors\Sluggable;
    use Ohio\Content\Behaviors\Categorizable;
    use Ohio\Content\Behaviors\ContentTrait;
    use Ohio\Content\Behaviors\Handleable;
    use Ohio\Content\Behaviors\TemplateTrait;
    use Ohio\Content\Behaviors\Taggable;

    protected $morphClass = 'pages';

    protected $table = 'pages';

    protected $fillable = ['name'];

    public function sections()
    {
        return $this->hasMany(Section::class);
    }

}