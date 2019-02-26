<?php namespace Tests\Belt\Content\Feature\Api;

use Tests\Belt\Core;

class ApiCatchAllTest extends \Tests\Belt\Core\BeltTestCase
{

    /**
     * @covers \Belt\Content\Http\Controllers\CatchAllController::web
     */
    public function test()
    {
        $this->refreshDB();
        $this->actAsSuper();

        # store
        $response = $this->json('POST', '/api/v1/handles', [
            'is_active' => 1,
            'subtype' => 'alias',
            'handleable_type' => 'pages',
            'handleable_id' => 1,
            'url' => 'catch-all-example',
        ]);
        $response->assertStatus(201);

        $response = $this->get('/catch-all-example');
        $response->assertStatus(200);
    }

}