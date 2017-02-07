<?php

use Ohio\Core\Param;
use Ohio\Content\Block;
use Ohio\Content\Page;
use Ohio\Content\Handle;
use Ohio\Content\Section;
use Ohio\Content\Tout;
use Ohio\Storage\File;
use Illuminate\Database\Seeder;

class OhioContentPageSeeds extends Seeder
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
        Section::where('page_id', $page->id)->delete();
        $data = factory(Page::class)->make([
            'template' => 'ohio-content::page.templates.default',
            'is_active' => true,
            'slug' => 'sectioned',
            'body' => null
        ]);
        $page->update($data->toArray());

        # section w/breadcrumbs
        $section = $this->section($page);
        $this->embed($section, ['template' => 'breadcrumbs'], [
            'menu' => 'example',
            'active' => '/products/tools/weird'
        ]);

        # section w/menus
        $section = $this->section($page);
        $this->menu($section, ['template' => 'example'], [
            'menu' => 'example',
            'active' => '/products/tools/weird'
        ]);
        $this->block($section, [], ['class' => 'col-md-9']);

        # section w/embed
        $section = $this->section($page);
        $this->block($section, [], ['class' => 'col-md-6']);
        $this->embed($section, ['template' => 'contact'], ['class' => 'col-md-6']);

        # section w/block
        $block = factory(Block::class)->create();
        $this->section($page, $block, []);

        # section w/file
        $section = $this->section($page);
        $this->file($section, ['header' => $faker->words(random_int(3, 7), true)], ['class' => 'col-md-12']);

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
            'page_id' => $page ? $page->id : null,
            'sectionable_id' => $sectionable_id,
            'sectionable_type' => $sectionable_type,
            //'params' => $params,
            'header' => array_get($options, 'header', null),
            'body' => array_get($options, 'body', null),
            'footer' => array_get($options, 'footer', null),
        ]);

        foreach ($params as $key => $value) {
            $section->saveParam($key, $value);
        }

        return $section;
    }

    public function block($parent, $options = [], $params = [])
    {
        $options = array_merge(['template' => 'default'], $options);

        $params = array_merge(['class' => 'col-md-4'], $params);

        $block = factory(Block::class)->create();

        $this->section($parent, $block, $options, $params);
    }

    public function embed($parent, $options = [], $params = [])
    {
        $params = array_merge(['class' => 'col-md-12'], $params);

        $this->section($parent, 'embeds', $options, $params);
    }

    public function file($parent, $options = [], $params = [])
    {
        $options = array_merge(['template' => 'default'], $options);

        $params = array_merge(['class' => 'col-md-12'], $params);

        $file = factory(File::class)->create();

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