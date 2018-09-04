<?php

use Belt\Core\Facades\MorphFacade as Morph;
use Belt\Core\Services\Update\BaseUpdate;
use Belt\Content\Block;
use Belt\Content\Term;
use Belt\Content\Lyst;
use Belt\Content\ListItem;
use Illuminate\Support\Facades\DB;

/**
 * Class UpdateService
 * @package Belt\Core\Services
 */
class BeltUpdateContent20 extends BaseUpdate
{
    protected $map = [];

    public function up()
    {
        $this->info(sprintf('2.0 content updates'));

        Term::unguard();
        ListItem::unguard();

        $this->purge();

        $this->albums();
        $this->itineraries();
        $this->touts();

        $this->categories();
        $this->tags();
    }

    public function map($old_type, $old_id, $new_type, $new_id)
    {
        $this->map[$old_type][$old_id] = $new_id;

        DB::table('conversions_map')->insert([
            'old_type' => $old_type,
            'old_id' => $old_id,
            'new_type' => $new_type,
            'new_id' => $new_id,
        ]);
    }

    public function purge()
    {

        DB::table('conversions_map')->truncate();

        //dump(Morph::map());

        $map = Morph::map();
        $map['itineraries'] = '\Belt\Spot\Itinerary';
        $map['touts'] = '\Belt\Content\Tout';

        foreach ($map as $table => $class) {

            if (in_array($table, ['custom'])) {
                continue;
            }

            DB::table('amenity_spots')
                ->leftJoin($table, 'amenity_spots.owner_id', '=', "$table.id")
                ->where('amenity_spots.owner_type', $table)
                ->whereNull("$table.id")
                ->delete();

            DB::table('categorizables')
                ->leftJoin($table, 'categorizables.categorizable_id', '=', "$table.id")
                ->where('categorizables.categorizable_type', $table)
                ->whereNull("$table.id")
                ->delete();

            DB::table('clippables')
                ->leftJoin($table, 'clippables.clippable_id', '=', "$table.id")
                ->where('clippables.clippable_type', $table)
                ->whereNull("$table.id")
                ->delete();

            if ($table != 'favorites') {
                DB::table('favorites')
                    ->leftJoin($table, 'favorites.favoriteable_id', '=', "$table.id")
                    ->where('favorites.favoriteable_type', $table)
                    ->whereNull("$table.id")
                    ->delete();
            }

            if ($table != 'handles') {
                DB::table('handles')
                    ->leftJoin($table, 'handles.handleable_id', '=', "$table.id")
                    ->where('handles.handleable_type', $table)
                    ->whereNull("$table.id")
                    ->delete();
            }

            DB::table('index')
                ->leftJoin($table, 'index.indexable_id', '=', "$table.id")
                ->where('index.indexable_type', $table)
                ->whereNull("$table.id")
                ->delete();

            if ($table != 'locations') {
                DB::table('locations')
                    ->leftJoin($table, 'locations.locatable_id', '=', "$table.id")
                    ->where('locations.locatable_type', $table)
                    ->whereNull("$table.id")
                    ->delete();
            }

            if ($table != 'params') {
                DB::table('params')
                    ->leftJoin($table, 'params.paramable_id', '=', "$table.id")
                    ->where('params.paramable_type', $table)
                    ->where('params.paramable_type', '!=', 'params')
                    ->whereNull("$table.id")
                    ->delete();
            }

            DB::table('taggables')
                ->leftJoin($table, 'taggables.taggable_id', '=', "$table.id")
                ->where('taggables.taggable_type', $table)
                ->whereNull("$table.id")
                ->delete();

            DB::table('vacation_pois')
                ->leftJoin($table, 'vacation_pois.vacationable_id', '=', "$table.id")
                ->where('vacation_pois.vacationable_type', $table)
                ->whereNull("$table.id")
                ->delete();

            if ($table != 'work_requests') {
                DB::table('work_requests')
                    ->leftJoin($table, 'work_requests.workable_id', '=', "$table.id")
                    ->where('work_requests.workable_type', $table)
                    ->whereNull("$table.id")
                    ->delete();
            }

        }

        DB::table('itinerary_place')
            ->leftJoin('places', 'itinerary_place.place_id', '=', "places.id")
            ->whereNull("places.id")
            ->delete();

    }

    /**
     * @param $old_type
     * @param $old_id
     * @return array
     */
    public function morph($old_type, $old_id, $returnObject = false)
    {
        $new_type = $old_type;
        $new_id = $old_id;

        if ($old_type == 'touts') {
            $new_type = 'blocks';
            $new_id = array_get($this->map, "touts.$old_id", $old_id);
        }

        if ($old_type == 'itineraries') {
            $new_type = 'lists';
            $new_id = array_get($this->map, "itineraries.$old_id", $old_id);
        }

        if ($old_type == 'albums') {
            $new_type = 'lists';
            $new_id = array_get($this->map, "albums.$old_id", $old_id);
        }

        if ($returnObject) {
            return Morph::morph($new_type, $new_id);
        }

        return [
            $new_type,
            $new_id,
        ];
    }

    public function categories()
    {
        DB::table('terms')->truncate();
        DB::table('termables')->truncate();

        $categories = DB::table('categories')->orderBy('_lft')->get();

        foreach ($categories as $category) {

            $this->info(sprintf('category: %s. %s', $category->id, $category->name));

            $term = new Term();
            $term->id = $category->id;
            $term->is_active = $category->is_active;
            $term->_lft = $category->_lft;
            $term->_rgt = $category->_rgt;
            $term->parent_id = $category->parent_id;
            $term->subtype = $category->template;
            $term->name = $category->name;
            $term->slug = $category->slug;
            $term->body = $category->body;
            $term->meta_title = $category->meta_title;
            $term->meta_description = $category->meta_description;
            $term->meta_keywords = $category->meta_keywords;
            $term->searchable = $category->searchable;
            $term->deleted_at = $category->deleted_at;
            $term->created_at = $category->created_at;
            $term->updated_at = $category->updated_at;
            $term->names = json_decode($category->names, true);
            $term->slugs = json_decode($category->slugs, true);
            $term->save();

            //$this->map['categories'][$category->id] = $term->id;
            $this->map('categories', $category->id, 'terms', $term->id);

            $this->attachments($term, 'categories', $category->id);
            $this->favorites($term, 'categories', $category->id);
            $this->handles($term, 'categories', $category->id);
            $this->params($term, 'categories', $category->id);
            $this->sections($term, 'categories', $category->id);

        }

        $this->info('categorizables...');

        $categorizables = DB::table('categorizables')->get();

        foreach ($categorizables as $categorizable) {

            list($entity_type, $entity_id) = $this->morph($categorizable->categorizable_type, $categorizable->categorizable_id);

            DB::table('termables')->insert([
                'term_id' => $categorizable->category_id,
                'termable_type' => $entity_type,
                'termable_id' => $entity_id,
                'position' => $categorizable->position,
            ]);
        }
    }

    public function tags()
    {
        $tags = DB::table('tags')->get();

        $parent = Term::firstOrCreate([
            'name' => 'Tags',
        ]);

        foreach ($tags as $tag) {

            $this->info(sprintf('tag: %s. %s', $tag->id, $tag->name));

            $term = Term::firstOrCreate([
                'parent_id' => $parent->id,
                'name' => $tag->name,
            ]);

            $term->slug = $tag->slug;
            $term->body = $tag->body;
            $term->save();

            //$this->map['tags'][$tag->id] = $term->id;
            $this->map('tags', $tag->id, 'terms', $term->id);

            $this->attachments($term, 'tags', $tag->id);
            $this->favorites($term, 'tags', $tag->id);
            $this->handles($term, 'tags', $tag->id);
            $this->params($term, 'tags', $tag->id);

        }

        $this->info('taggables...');

        $taggables = DB::table('taggables')->get();

        foreach ($taggables as $taggable) {

            $term_id = array_get($this->map['tags'], $taggable->tag_id);

            if (!$term_id) {
                continue;
            }

            $object = $this->morph($taggable->taggable_type, $taggable->taggable_id, true);

            if ($object && $object->terms) {
                $object->terms()->syncWithoutDetaching([$term_id]);
            }

        }
    }

    public function attachments($object, $old_type, $old_id)
    {
        $clippables = DB::table('clippables')
            ->where('clippable_type', $old_type)
            ->where('clippable_id', $old_id)
            ->get();

        foreach ($clippables as $clippable) {
            $object->attachments()->syncWithoutDetaching($clippable->attachment_id);
        }
    }

    public function favorites($object, $old_type, $old_id)
    {
        DB::table('favorites')
            ->where('favoriteable_type', $old_type)
            ->where('favoriteable_id', $old_id)
            ->update([
                'favoriteable_type' => $object->getMorphClass(),
                'favoriteable_id' => $object->id,
            ]);
    }

    public function handles($object, $old_type, $old_id)
    {
        DB::table('handles')
            ->where('handleable_type', $old_type)
            ->where('handleable_id', $old_id)
            ->update([
                'handleable_type' => $object->getMorphClass(),
                'handleable_id' => $object->id,
            ]);
    }

    public function params($object, $old_type, $old_id)
    {
        $params = DB::table('params')
            ->where('paramable_type', $old_type)
            ->where('paramable_id', $old_id)
            ->get();

        foreach ($params as $param) {
            $object->saveParam($param->key, $param->value);
        }

        DB::table('params')
            ->where('key', $old_type)
            ->where('value', $old_id)
            ->update([
                'key' => $object->getMorphClass(),
                'value' => $object->id,
            ]);
    }

    public function sections($object, $old_type, $old_id)
    {
        DB::table('sections')
            ->where('owner_type', $old_type)
            ->where('owner_id', $old_id)
            ->update([
                'owner_type' => $object->getMorphClass(),
                'owner_id' => $object->id,
            ]);
    }

    public function touts()
    {
        Block::unguard();

        $touts = DB::table('touts')->get();

        foreach ($touts as $tout) {
            $this->info(sprintf('tout: %s. %s', $tout->id, $tout->name));
            $block = Block::firstOrCreate([
                'subtype' => 'tout',
                'name' => $tout->name,
            ], [
                'body' => $tout->body,
            ]);
            $block->slug = $tout->slug;
            $block->body = $tout->body;
            $block->heading = $tout->heading;
            $block->save();
            $block->saveParam('attachments', $tout->attachment_id);
            $block->saveParam('body', $tout->body);
            $block->saveParam('btn_url', $tout->btn_url);
            $block->saveParam('btn_text', $tout->btn_text);

            //$this->map['touts'][$tout->id] = $block->id;
            $this->map('touts', $tout->id, 'blocks', $block->id);

            $this->attachments($block, 'touts', $tout->id);
            $this->favorites($block, 'touts', $tout->id);
            $this->handles($block, 'touts', $tout->id);
            $this->params($block, 'touts', $tout->id);
        }
    }

    public function albums()
    {
        Lyst::unguard();

        $albums = DB::table('albums')->get();

        foreach ($albums as $album) {
            $this->info(sprintf('album: %s. %s', $album->id, $album->name));
            $list = Lyst::firstOrCreate([
                'subtype' => 'album',
                'name' => $album->name,
            ], [

            ]);
            $list->slug = $album->slug;
            $list->save();
            $list->saveParam('body', $album->body);

            //$this->map['albums'][$album->id] = $list->id;
            $this->map('albums', $album->id, 'lists', $list->id);

            $this->attachments($list, 'albums', $album->id);
            $this->favorites($list, 'albums', $album->id);
            $this->handles($list, 'albums', $album->id);
            $this->params($list, 'albums', $album->id);
        }
    }

    public function itineraries()
    {
        Lyst::unguard();

        $itineraries = DB::table('itineraries')->get();

        foreach ($itineraries as $itinerary) {
            $this->info(sprintf('itinerary: %s. %s', $itinerary->id, $itinerary->name));
            $list = Lyst::firstOrCreate([
                'subtype' => 'itinerary',
                'name' => $itinerary->name,
            ], [

            ]);
            $list->slug = $itinerary->slug;
            $list->is_active = $itinerary->is_active;
            $list->meta_title = $itinerary->meta_title;
            $list->meta_description = $itinerary->meta_description;
            $list->meta_keywords = $itinerary->meta_keywords;
            $list->save();
            $list->saveParam('body', $itinerary->body);

            //$this->map['itineraries'][$itinerary->id] = $list->id;
            $this->map('itineraries', $itinerary->id, 'lists', $list->id);

            $this->attachments($list, 'itineraries', $itinerary->id);
            $this->favorites($list, 'itineraries', $itinerary->id);
            $this->handles($list, 'itineraries', $itinerary->id);
            $this->params($list, 'itineraries', $itinerary->id);

            $list->items()->delete();

            $itineraryPlaces = DB::table('itinerary_place')
                ->where('itinerary_id', $itinerary->id)
                ->orderBy('position')
                ->get();

            foreach ($itineraryPlaces as $itineraryPlace) {
                $listItem = ListItem::create([
                    'subtype' => 'place',
                    'list_id' => $list->id,
                    'position' => $list->position,
                ]);
                $listItem->saveParam('heading', $itineraryPlace->heading);
                $listItem->saveParam('body', $itineraryPlace->body);
                $listItem->saveParam('places', $itineraryPlace->place_id);
            }
        }
    }

}