<?php namespace Tests\Belt\Content\Feature\Web;

use Belt\Core\Tests;
use Belt\Content\Term;

class WebTermsTest extends Tests\BeltTestCase
{

    public function testAsSuper()
    {
        $this->refreshDB();

        Term::unguard();
        $term = Term::find(1);

        # show
        $term->update(['is_active' => true]);
        $response = $this->json('GET', '/terms/1');
        $response->assertStatus(200);

        # show (404)
        $term->update(['is_active' => false]);
        $response = $this->json('GET', '/terms/1');
        $response->assertStatus(404);

        # show (super, avoid 404)
        $this->actAsSuper();
        $response = $this->json('GET', '/terms/1');
        $response->assertStatus(200);

    }

}