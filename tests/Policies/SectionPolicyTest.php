<?php

use Belt\Core\Testing;
use Belt\Content\Policies\SectionPolicy;

class SectionPolicyTest extends Testing\BeltTestCase
{

    use Testing\CommonMocks;

    /**
     * @covers \Belt\Content\Policies\SectionPolicy::view
     */
    public function test()
    {
        $user = $this->getUser();

        $policy = new SectionPolicy();

        # view
        $this->assertTrue($policy->view($user, 1));
    }

}