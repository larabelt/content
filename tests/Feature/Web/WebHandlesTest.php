<?php namespace Tests\Belt\Content\Feature\Web;

use Belt\Core\Tests;
use Belt\Content\Handle;
use Belt\Content\Page;
use Belt\Core\Facades\TranslateFacade as Translate;

/**
 * @group handle
 * Class WebHandlesFunctionalTest
 */
class WebHandlesTest extends Tests\BeltTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->enableI18n();
        $this->refreshDB();
        $this->actAsSuper();
    }

    /**
     * Use cases:
     *
     * 200 - Alias              - w/handleable
     * 301 - PermanentRedirect
     * 301 - PermanentRedirect  - w/handleable
     * 302 - TemporaryRedirect
     * 302 - TemporaryRedirect  - w/handleable
     * 404 - NotFound
     */

    public function test()
    {

        //$this->refreshDB();
        //$this->actAsSuper();

        Handle::unguard();
        Page::unguard();

        $page = Page::find(1);

        $handle = Handle::firstOrCreate([
            'url' => '/functional-test',
            'is_active' => 1,
            'handleable_type' => 'pages',
            'handleable_id' => 1,
            'subtype' => 'alias',
        ]);

        // 200 - Alias - w/handleable
        $response = $this->get('/functional-test');
        $response->assertStatus(200);
        //$this->assertContains($page->meta_title, $response->baseResponse->content());

        //$content = $response->baseResponse->content();
        //dump($content);

        // 301 - PermanentRedirect  - w/handleable
        $handle->update(['subtype' => 'permanent-redirect']);
        $response = $this->get('/functional-test');
        $response->assertStatus(301);
        $response->assertRedirect($page->default_url);

        // 302 - TemporaryRedirect  - w/handleable
        $handle->update(['subtype' => 'temporary-redirect']);
        $response = $this->get('/functional-test');
        $response->assertStatus(302);
        $response->assertRedirect($page->default_url);

        // 404 - Alias - w/invalid handleable
        $handle->update(['subtype' => 'alias', 'handleable_id' => 99999999]);
        $response = $this->get('/functional-test');
        $response->assertStatus(404);

        /**
         * now w/o handleable
         */
        $target = '/posts/1';
        $handle->update([
            'subtype' => 'permanent-redirect',
            'handleable_type' => null,
            'handleable_id' => null,
            'target' => $target,
        ]);

        // 301 - PermanentRedirect
        $handle->update(['subtype' => 'permanent-redirect']);
        $response = $this->get('/functional-test');
        $response->assertStatus(301);
        $response->assertRedirect($target);

        // 302 - TemporaryRedirect
        $handle->update(['subtype' => 'temporary-redirect']);
        $response = $this->get('/functional-test');
        $response->assertStatus(302);
        $response->assertRedirect($target);

        // 404 - NotFound
        $handle->update(['subtype' => 'not-found']);
        $response = $this->get('/functional-test');
        $response->assertStatus(404);

        /**
         * now creating new
         */
        $this->assertNull(Handle::where('url', '/totally-new-url')->first());
        $response = $this->get('/totally-new-url');
        $response->assertStatus(404);
        $this->assertNotNull(Handle::where('url', '/totally-new-url')->first());

        /**
         * internationalized url
         */
        Handle::firstOrCreate([
            'url' => '/functional-test-translated',
            'is_active' => 1,
            'handleable_type' => 'pages',
            'handleable_id' => 1,
            'subtype' => 'alias',
        ]);
        // 200 - Alias - w/handleable
        $response = $this->get('/es_ES/functional-test-translated');
        $response->assertStatus(200);

    }

}