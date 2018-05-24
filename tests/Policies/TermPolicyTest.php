<?php

use Belt\Core\Testing;
use Belt\Content\Policies\TermPolicy;

class TermPolicyTest extends Testing\BeltTestCase
{

    use Testing\CommonMocks;

    /**
     * @covers \Belt\Content\Policies\TermPolicy::view
     */
    public function test()
    {
        $user = $this->getUser();

        $policy = new TermPolicy();

        # view
        $this->assertTrue($policy->view($user, 1));
    }

}