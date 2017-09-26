<?php

use Belt\Core\Testing;
use Belt\Content\Policies\ToutPolicy;

class ToutPolicyTest extends Testing\BeltTestCase
{

    use Testing\CommonMocks;

    /**
     * @covers \Belt\Content\Policies\ToutPolicy::index
     * @covers \Belt\Content\Policies\ToutPolicy::view
     */
    public function test()
    {
        $user = $this->getUser();

        $policy = new ToutPolicy();

        # index
        $this->assertTrue($policy->index($user, 1));

        # view
        $this->assertTrue($policy->view($user, 1));
    }

}