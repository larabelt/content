<?php

use Belt\Core\Testing;
use Belt\Core\User;

class WebPagesFunctionalTest extends Testing\BeltTestCase
{

    public function test()
    {
        $this->refreshDB();
        $this->actAsSuper();

////        # preview
////        $response = $this->json('GET', '/pages/sectioned/preview');
////        $response->assertStatus(200);
////
////        # show compiles b/c debug env
////        putenv("APP_DEBUG=true");
////        $response = $this->json('GET', '/pages/1');
////        $response->assertStatus(200);
//
//        # show compiles b/c acting as super
//        putenv("APP_DEBUG=false");
//        $response = $this->json('GET', '/pages/1');
//        $response->assertStatus(200);
//
//        # show caches b/c logged in user does not own page
//        $this->actingAs(factory(User::class)->make(['is_super' => false]));
//        $response = $this->json('GET', '/pages/1');
//        s($response->content());
//        $response->assertStatus(200);


    }

}