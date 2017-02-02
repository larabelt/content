<?php
namespace Ohio\Content;

use Ohio\Core;
use Ohio\Content;

use Illuminate\Database\Eloquent\Model;
use Ohio\Storage\File;

class Tout extends Model
{
    use Core\Behaviors\SluggableTrait;
    use Content\Behaviors\ContentTrait;

    protected $morphClass = 'touts';

    protected $table = 'touts';

    protected $fillable = ['name', 'body'];

    public function setTemplateAttribute($value)
    {
        $this->attributes['template'] = trim(strtolower($value));
    }

    public function image()
    {
        return $this->belongsTo(File::class, 'file_id');
    }

}