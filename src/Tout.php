<?php
namespace Belt\Content;

use Belt;
use Belt\Clip\Attachment;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Tout
 * @package Belt\Content
 */
class Tout extends Model implements
    Belt\Core\Behaviors\SluggableInterface,
    Belt\Content\Behaviors\IncludesContentInterface
{
    use Belt\Core\Behaviors\Sluggable;
    use Belt\Content\Behaviors\IncludesContent;

    /**
     * @var string
     */
    protected $morphClass = 'touts';

    /**
     * @var string
     */
    protected $table = 'touts';

    /**
     * @var array
     */
    protected $fillable = ['name', 'body'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function image()
    {
        return $this->belongsTo(Attachment::class, 'attachment_id');
    }

}