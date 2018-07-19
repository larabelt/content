<?php

namespace Belt\Content\Builders;

use Belt;
use Belt\Core\Behaviors\IncludesSubtypesInterface;
use Belt\Content\Section;

/**
 * Class BaseBuilder
 * @package Belt\Content\Builders
 */
abstract class BaseBuilder
{
    /**
     * @var IncludesSubtypesInterface
     */
    public $item;

    /**
     * @var Section
     */
    public $sections;

    /**
     * BaseBuilder constructor.
     * @param IncludesSubtypesInterface $item
     */
    public function __construct(IncludesSubtypesInterface $item)
    {
        $this->item = $item;
    }

    abstract function build();

    /**
     * @return Section
     */
    public function sections()
    {
        return $this->sections ?: $this->sections = Section::query();
    }

    /**
     * @param array $options
     * @return Section
     */
    public function section($options = [])
    {

        $parent = array_get($options, 'parent');

        $section = $this->sections()->create([
            'subtype' => array_get($options, 'template', 'containers.default'),
            'parent_id' => $parent ? $parent->id : null,
            'owner_id' => $this->item->id,
            'owner_type' => $this->item->getMorphClass(),
        ]);

        foreach ((array) array_get($options, 'params') as $key => $value) {
            $section->saveParam($key, $value);
        }

        return $section;
    }

}