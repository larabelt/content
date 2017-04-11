<?php

use Belt\Content\Block;
use Belt\Content\Page;
use Belt\Content\Handle;
use Belt\Content\Section;
use Belt\Content\Tout;
use Belt\Clip\Attachment;
use Illuminate\Database\Seeder;

class BeltContentPageSeeds extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        factory(Page::class)->create();
        Page::unguard();

        # make sectioned example page
        $page = Page::first();
        Section::where('owner_id', $page->id)->where('owner_type', 'pages')->delete();
        $data = factory(Page::class)->make([
            'template' => 'default',
            'is_active' => true,
            'slug' => 'sectioned',
            'body' => null
        ]);
        $data->setAppends([]);
        $page->update($data->toArray());

        # section w/breadcrumbs
        $section = $this->section($page);
        $this->custom($section, ['template' => 'breadcrumbs'], [
            'menu' => 'example',
            'active' => '/products/tools/weird'
        ]);

        # section w/menus
        $section = $this->section($page);
        $leftSection = $this->section($section, 'sections', ['template' => 'width-3']);
        $this->menu($leftSection, ['template' => 'example'], [
            'menu' => 'example',
            'active' => '/products/tools/weird'
        ]);
        $rightSection = $this->section($section, 'sections', ['template' => 'width-9']);
        $this->block($rightSection, [], []);

        # section w/custom
        $section = $this->section($page);
        $this->block($section, [], ['class' => 'col-md-6']);
        $this->custom($section, ['template' => 'contact'], ['class' => 'col-md-6']);

        # section w/block
        $block = factory(Block::class)->create();
        $this->section($page, $block, []);

        # section w/file
        $section = $this->section($page);
        $this->file($section, ['heading' => $faker->words(random_int(3, 7), true)], ['class' => 'col-md-12']);

        # section w/blocks
        $section = $this->section($page);
        $this->block($section, [], ['class' => 'col-md-9']);
        $this->block($section, [], ['class' => 'col-md-3']);

        # section w/touts
        $section = $this->section($page);
        $this->tout($section, [], ['class' => 'col-md-3 col-md-offset-3']);
        $this->tout($section, [], ['class' => 'col-md-3']);

        # section w/touts
        $section = $this->section($page);
        $this->tout($section);
        $this->tout($section);
        $this->tout($section);

        factory(Page::class)->create(['template' => 'no-cache']);


        factory(Page::class, 25)
            ->create()
            ->each(function ($page) {
                $page->handles()->save(factory(Handle::class)->make());
            });;
    }

    public function section($owner, $sectionable = 'sections', $options = [], $params = [])
    {

        $page = $owner instanceof Page ? $owner : null;

        $parent = $owner instanceof Section ? $owner : null;

        $sectionable_id = null;
        $sectionable_type = $sectionable;
        if ($sectionable && is_object($sectionable)) {
            $sectionable_id = $sectionable->id;
            $sectionable_type = $sectionable->getMorphClass();
        }

        $section = factory(Section::class)->create([
            'template' => array_get($options, 'template', 'default'),
            'parent_id' => $parent ? $parent->id : null,
            'owner_id' => $page ? $page->id : $parent->owner_id,
            'owner_type' => 'pages',
            'sectionable_id' => $sectionable_id,
            'sectionable_type' => $sectionable_type,
            'heading' => array_get($options, 'heading', null),
            'before' => array_get($options, 'before', null),
            'after' => array_get($options, 'after', null),
        ]);

        foreach ($params as $key => $value) {
            $section->saveParam($key, $value);
        }

        return $section;
    }

    public function block($parent, $options = [], $params = [])
    {
        $options = array_merge(['template' => 'default'], $options);

        $params = array_merge(['class' => 'col-md-12'], $params);

        $block = factory(Block::class)->create();

        $this->section($parent, $block, $options, $params);
    }

    public function custom($parent, $options = [], $params = [])
    {
        $params = array_merge(['class' => 'col-md-12'], $params);

        $this->section($parent, 'custom', $options, $params);
    }

    public function file($parent, $options = [], $params = [])
    {
        $options = array_merge(['template' => 'default'], $options);

        $params = array_merge(['class' => 'col-md-12'], $params);

        $file = factory(Attachment::class)->create();

        $this->section($parent, $file, $options, $params);
    }

    public function menu($parent, $options = [], $params = [])
    {
        $params = array_merge(['class' => 'col-md-3'], $params);

        $this->section($parent, 'menus', $options, $params);
    }

    public function tout($parent, $options = [], $params = [])
    {
        $options = array_merge(['template' => 'default'], $options);

        $params = array_merge(['class' => 'col-md-4'], $params);

        $tout = factory(Tout::class)->create();

        $this->section($parent, $tout, $options, $params);
    }

}