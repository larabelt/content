<?php
namespace Ohio\Content;

use Ohio;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
    implements Ohio\Content\Behaviors\TemplateInterface
{
    use Ohio\Core\Behaviors\SluggableTrait;
    use Ohio\Content\Behaviors\ContentTrait;
    use Ohio\Content\Behaviors\HandleableTrait;
    use Ohio\Content\Behaviors\TemplateTrait;
    use Ohio\Content\Behaviors\TaggableTrait;

    protected $morphClass = 'pages';

    protected $table = 'pages';

    protected $fillable = ['name'];

    public function sections()
    {
        return $this->hasMany(Section::class);
    }

}