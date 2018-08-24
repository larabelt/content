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
    Belt\Core\Behaviors\TypeInterface,
    Belt\Content\Behaviors\IncludesContentInterface,
    Belt\Content\Behaviors\SectionableInterface,
    Belt\Glue\Behaviors\TaggableInterface
{
    use Belt\Core\Behaviors\Sluggable;
    use Belt\Core\Behaviors\TypeTrait;
    use Belt\Content\Behaviors\IncludesContent;
    use Belt\Content\Behaviors\Sectionable;
    use Belt\Glue\Behaviors\Taggable;

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
     * @var array
     */
    protected $appends = ['morph_class'];

    /**
     * @var array
     */
    protected $with = ['image'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function image()
    {
        return $this->belongsTo(Attachment::class, 'attachment_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function attachment()
    {
        return $this->belongsTo(Attachment::class, 'attachment_id');
    }
}