<?php

use Ohio\Core\Testing;
use Ohio\Content\Policies\ToutPolicy;

class ToutPolicyTest extends Testing\OhioTestCase
{

    use Testing\CommonMocks;

    /**
     * @covers \Ohio\Content\Policies\ToutPolicy::view
     */
    public function test()
    {
        $user = $this->getUser();

        $policy = new ToutPolicy();

        # view
        $this->assertTrue($policy->view($user, 1));
    }

}