<?php
namespace Belt\Content;

use Belt;
use Belt\Clip\Attachment;
use Illuminate\Database\Eloquent\Model;

class Tout extends Model implements
    Belt\Core\Behaviors\SluggableInterface,
    Belt\Content\Behaviors\IncludesContentInterface
{
    use Belt\Core\Behaviors\Sluggable;
    use Belt\Content\Behaviors\IncludesContent;

    protected $morphClass = 'touts';

    protected $table = 'touts';

    protected $fillable = ['name', 'body'];

    public function image()
    {
        return $this->belongsTo(Attachment::class, 'attachment_id');
    }

}