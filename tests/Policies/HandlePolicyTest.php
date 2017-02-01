<?php

use Ohio\Core\Testing;
use Ohio\Content\Policies\HandlePolicy;

class HandlePolicyTest extends Testing\OhioTestCase
{

    use Testing\CommonMocks;

    /**
     * @covers \Ohio\Content\Policies\HandlePolicy::view
     */
    public function test()
    {
        $user = $this->getUser();

        $policy = new HandlePolicy();

        # view
        $this->assertTrue($policy->view($user, 1));
    }

}