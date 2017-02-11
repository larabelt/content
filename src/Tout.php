<?php
namespace Ohio\Content;

use Ohio;
use Ohio\Storage\File;
use Illuminate\Database\Eloquent\Model;

class Tout extends Model
{
    use Ohio\Core\Behaviors\Sluggable;
    use Ohio\Content\Behaviors\ContentTrait;

    protected $morphClass = 'touts';

    protected $table = 'touts';

    protected $fillable = ['name', 'body'];

    public function image()
    {
        return $this->belongsTo(File::class, 'file_id');
    }

}