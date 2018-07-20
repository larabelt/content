<?php

use Belt\Content\Block;
use Belt\Content\Page;
use Belt\Content\Handle;
use Belt\Content\Section;
use Illuminate\Database\Seeder;

class BeltContentPageSeeds extends Seeder
{

    use BeltContentHasSectionsSeedsTrait;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        Page::unguard();

        factory(Page::class)->create();

        # make sectioned example page
        factory(Page::class)->create(['slug' => 'sectioned']);
        $page = Page::where('slug', 'sectioned')->first();
        Section::where('owner_id', $page->id)->where('owner_type', 'pages')->delete();
        $data = factory(Page::class)->make([
            'subtype' => 'default',
            'is_active' => true,
            'slug' => 'sectioned',
            'body' => null
        ]);
        $data->setAppends([]);
        $page->update($data->toArray());

        # section w/breadcrumbs
        $section = $this->section($page);
        $this->custom($section, ['subtype' => 'custom.breadcrumbs'], [
            'menu' => 'example',
            'active' => '/products/tools/weird'
        ]);

        # section w/menus
        $section = $this->section($page);
        $leftSection = $this->section($section, 'sections', ['subtype' => 'containers.width-3']);
        $this->menu($leftSection, ['subtype' => 'menus.default'], [
            'menu' => 'example',
            'active' => '/products/tools/weird'
        ]);
        $rightSection = $this->section($section, 'sections', ['subtype' => 'containers.width-9']);
        $this->block($rightSection, [], []);

        # section w/custom
        $section = $this->section($page);
        $this->block($section, [], ['class' => 'col-md-6']);
        $this->custom($section, ['subtype' => 'custom.contact'], ['class' => 'col-md-6']);

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

        # make sectioned example page
        factory(Page::class)->create(['slug' => 'sectioned']);
        $page = Page::where('slug', 'sectioned')->first();
        Section::where('owner_id', $page->id)->where('owner_type', 'pages')->delete();
        $data = factory(Page::class)->make([
            'subtype' => 'default',
            'is_active' => true,
            'slug' => 'sectioned',
            'body' => null
        ]);
        $data->setAppends([]);
        $page->update($data->toArray());

        # page with "example" subtype
        $page = factory(Page::class)->create([
            'is_active' => true,
            'subtype' => 'example',
            'slug' => 'example',
            'name' => 'Example Subtype Page',
        ]);
        $page->saveParam('menu', 'example');
        $page->saveParam('attachments', 1);
        $page->saveParam('touts', 1);
        $page->saveParam('blocks', 1);
        $page->saveParam('body', $faker->paragraphs(3, true));

        factory(Page::class)->create(['subtype' => 'no-cache']);

        factory(Page::class, 25)
            ->create()
            ->each(function ($page) {
                $page->handles()->save(factory(Handle::class)->make());
            });;
    }

}