<?php

use Belt\Core\Testing;
use Belt\Content\Policies\PostPolicy;

class PostPolicyTest extends Testing\BeltTestCase
{

    use Testing\CommonMocks;

    /**
     * @covers \Belt\Content\Policies\PostPolicy::index
     * @covers \Belt\Content\Policies\PostPolicy::view
     */
    public function test()
    {
        $user = $this->getUser();

        $policy = new PostPolicy();

        # index
        $this->assertTrue($policy->index($user, 1));

        # view
        $this->assertTrue($policy->view($user, 1));
    }

}