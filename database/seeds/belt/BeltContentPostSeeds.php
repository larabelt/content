<?php

use Belt\Content\Post;
use Belt\Content\Section;
use Illuminate\Database\Seeder;

class BeltContentPostSeeds extends Seeder
{
    use BeltContentHasSectionsSeedsTrait;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //factory(Post::class, 25)->create();

        $faker = Faker\Factory::create();

        Post::unguard();

        factory(Post::class, 25)
            ->create()
            ->each(function ($post) use($faker) {

                Section::where('owner_id', $post->id)->where('owner_type', 'posts')->delete();
                $data = factory(Post::class)->make([
                    'subtype' => 'default',
                    'is_active' => true,
                    'body' => null
                ]);
                $data->setAppends([]);
                $post->update($data->toArray());

                # section w/file
                $section = $this->section($post);
                $this->file($section, ['heading' => $faker->words(random_int(3, 7), true)], ['class' => 'col-md-12']);

                $this->section($post, 'sections', [
                    'heading' => $faker->words(rand(3, 6), true),
                    'before' => $faker->paragraphs(rand(1, 2), true),
                ]);

                $this->section($post, 'sections', [
                    'heading' => $faker->words(rand(3, 6), true),
                    'before' => $faker->paragraphs(rand(1, 2), true),
                ]);

            });;
    }

}