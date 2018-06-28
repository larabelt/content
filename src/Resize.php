<?php

namespace Belt\Content;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Resize
 * @package Belt\Content
 */
class Resize extends Model implements AttachmentInterface
{
    use AttachmentTrait;

    /**
     * @var string
     */
    protected $table = 'attachment_resizes';

    /**
     * @var string
     */
    protected $morphClass = 'attachment_resizes';

    /**
     * @var array
     */
    protected $fillable = ['driver', 'name'];

    /**
     * @var array
     */
    protected $appends = ['src', 'secure', 'rel_path', 'preset'];

    /**
     * Get owning model
     */
    public function attachment()
    {
        return $this->belongsTo(Attachment::class);
    }

    /**
     * @return string
     */
    public function getPresetAttribute()
    {
        return sprintf('%s:%s', $this->width, $this->height);
    }

    /**
     * @return string
     */
    public function getNicknameAttribute($value)
    {
        return $value ?: $this->preset;
    }

}