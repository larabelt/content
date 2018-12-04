<?php

namespace Belt\Content;

use Belt;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TranslatableString
 * @package Belt\Core
 */
class TranslatableString extends Model implements
    Belt\Core\Behaviors\TranslatableInterface,
    Belt\Core\Behaviors\TypeInterface
{
    use Belt\Core\Behaviors\Translatable;
    use Belt\Core\Behaviors\TypeTrait;

    /**
     * @var string
     */
    protected $morphClass = 'translatable_strings';

    /**
     * @var string
     */
    protected $table = 'translatable_strings';

    /**
     * @var array
     */
    protected $fillable = ['value'];

    /**
     * @var array
     */
    protected $with = ['translations'];

    /**
     * @var array
     */
    protected $appends = ['morph_class'];

    /**
     * @return mixed
     */
    public function getTranslatableAttributes()
    {
        return ['value'];
    }

}