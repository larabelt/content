<?php namespace Tests\Belt\Content\Feature\Api;

use Belt\Core\Tests;
use Belt\Core\User;
use Belt\Content\Page;
use Belt\Content\Section;
use Silber\Bouncer\BouncerFacade as Bouncer;

class ApiTreeTest extends Tests\BeltTestCase
{

    public function test()
    {

        Section::unguard();

        $this->refreshDB();
        $this->actAsSuper();

        # add new sections
        $sections = new \Illuminate\Support\Collection();
        $sections->put(1, $this->addSection());
        $sections->put(2, $this->addSection());
        $sections->put(3, $this->addSection());

        # assert they are in the expected order
        $this->assertGreaterThan($sections->get(2)->_lft, $sections->get(3)->_lft);
        $this->assertGreaterThan($sections->get(1)->_lft, $sections->get(2)->_lft);

        # assert 1 & 2 are switched
        $this->moveSection($sections, 1, 2, 'after');
        $this->assertGreaterThan($sections->get(2)->_lft, $sections->get(1)->_lft);

        # assert 3 is moved before 1
        $this->moveSection($sections, 3, 1, 'before');
        $this->assertGreaterThan($sections->get(3)->_lft, $sections->get(1)->_lft);

        # assert 1 is child of 2
        $this->moveSection($sections, 1, 2, 'in');
        $this->assertEquals($sections->get(1)->parent_id, $sections->get(2)->id);

        # tree-item w/o owner
        $this->json('POST', "/api/v1/terms/1/tree", [
            'neighbor_id' => 2,
            'move' => 'after',
        ]);
    }

    public function addSection()
    {
        $response = $this->json('POST', '/api/v1/pages/1/sections', [
            'subtype' => 'sections.block',
        ]);

        $this->assertNotEmpty(array_get($response->json(), 'id'));

        return new Section($response->json());
    }

    public function getSection($id)
    {
        $response = $this->json('GET', "/api/v1/pages/1/sections/$id");

        $this->assertNotEmpty(array_get($response->json(), 'id'));

        return new Section($response->json());
    }

    public function moveSection($sections, $section_key, $neighbor_key, $move)
    {
        $section = $sections->get($section_key);
        $neighbor = $sections->get($neighbor_key);

        $this->json('POST', "/api/v1/sections/$section->id/tree", [
            'neighbor_id' => $neighbor->id,
            'move' => $move,
        ]);

        $sections->put($section_key, $this->getSection($section->id));
        $sections->put($neighbor_key, $this->getSection($neighbor->id));
    }

}