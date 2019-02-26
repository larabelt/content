<?php namespace Tests\Belt\Content\Feature\Api;

use Belt\Core\User;
use Tests\Belt\Core;

class ApiUserFavoritesTest extends \Tests\Belt\Core\BeltTestCase
{

    public function test()
    {
        $this->refreshDB();

        /**
         * the rest acting as auth/super
         */
        $super = factory(User::class)->create(['is_super' => true]);
        $this->actingAs($super);

        # index
        $response = $this->json('GET', '/api/v1/users/1/favorites');
        $response->assertStatus(200);

        # store
        $response = $this->json('POST', '/api/v1/users/1/favorites', [
            'favoriteable_id' => 1,
            'favoriteable_type' => 'places',
        ]);
        $response->assertStatus(201);
        $favoriteID = array_get($response->json(), 'id');

        # show
        $response = $this->json('GET', "/api/v1/users/1/favorites/$favoriteID");
        $response->assertStatus(200);

        # delete
        $response = $this->json('DELETE', "/api/v1/users/1/favorites/$favoriteID");
        $response->assertStatus(204);
        $response = $this->json('GET', "/api/v1/users/1/favorites/$favoriteID");
        $response->assertStatus(404);

        /**
         * the following with "self"
         */
        # store
        $response = $this->json('POST', '/api/v1/users/self/favorites', [
            'favoriteable_id' => 1,
            'favoriteable_type' => 'places',
        ]);
        $response->assertStatus(201);
        $favoriteID = array_get($response->json(), 'id');

        # show
        $response = $this->json('GET', "/api/v1/users/self/favorites/$favoriteID");
        $response->assertStatus(200);

        /**
         * the following with "guid"
         */
        $response = $this->json('POST', '/api/v1/users/guid-123/favorites', [
            'favoriteable_id' => 1,
            'favoriteable_type' => 'places',
        ]);
        $response->assertStatus(201);
        $favoriteID = array_get($response->json(), 'id');

        # show
        $response = $this->json('GET', "/api/v1/users/guid-123/favorites/$favoriteID");
        $response->assertStatus(200);
    }

    public function testBadCode()
    {
        $this->refreshDB();

        # show (bad code)
        $response = $this->json('GET', "/api/v1/users/self/favorites/1");
        $response->assertStatus(403);

    }

}