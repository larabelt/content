<?php

use Belt\Core\Testing;
use Belt\Content\Policies\HandlePolicy;

class HandlePolicyTest extends Testing\BeltTestCase
{

    use Testing\CommonMocks;

    /**
     * @covers \Belt\Content\Policies\HandlePolicy::view
     */
    public function test()
    {
        $user = $this->getUser();

        $policy = new HandlePolicy();

        # view
        $this->assertTrue($policy->view($user, 1));
    }

}