<?php

use Belt\Content\Behaviors\HasSectionsInterface;
use Belt\Content\Block;
use Belt\Content\Section;
use Belt\Content\Attachment;

trait BeltContentHasSectionsSeedsTrait
{

    public function section($owner, $sectionable = 'sections', $options = [], $params = [])
    {
        $parent = $owner instanceof Section ? $owner : null;

        $owner = $owner instanceof HasSectionsInterface ? $owner : ($parent->owner ?: null);

        $sectionable_id = null;
        $sectionable_type = $sectionable;
        if ($sectionable && is_object($sectionable)) {
            $sectionable_id = $sectionable->id;
            $sectionable_type = $sectionable->getMorphClass();
        }

        $section = factory(Section::class)->create([
            'template' => array_get($options, 'template', 'containers.default'),
            'parent_id' => $parent ? $parent->id : null,
            'owner_id' => $owner ? $owner->id : $parent->owner_id,
            'owner_type' => $owner ? $owner->getMorphClass() : $parent->owner_type,
        ]);

        foreach ($params as $key => $value) {
            $section->saveParam($key, $value);
        }

        return $section;
    }

    public function block($parent, $options = [], $params = [])
    {
        $options = array_merge(['template' => 'blocks.default'], $options);

        $block = factory(Block::class)->create();

        $params = array_merge(['class' => 'col-md-12'], $params);
        $params['blocks'] = $block->id;

        $this->section($parent, $block, $options, $params);
    }

    public function custom($parent, $options = [], $params = [])
    {
        $params = array_merge(['class' => 'col-md-12'], $params);

        $this->section($parent, 'custom', $options, $params);
    }

    public function file($parent, $options = [], $params = [])
    {
        $options = array_merge(['template' => 'attachments.default'], $options);

        $file = factory(Attachment::class)->create();

        $params = array_merge(['class' => 'col-md-12'], $params);
        $params['attachments'] = $file->id;

        $this->section($parent, $file, $options, $params);
    }

    public function menu($parent, $options = [], $params = [])
    {
        $params = array_merge(['class' => 'col-md-3'], $params);

        $this->section($parent, 'menus', $options, $params);
    }

}