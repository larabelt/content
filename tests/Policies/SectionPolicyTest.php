<?php

use Ohio\Core\Testing;
use Ohio\Content\Policies\SectionPolicy;

class SectionPolicyTest extends Testing\OhioTestCase
{

    use Testing\CommonMocks;

    /**
     * @covers \Ohio\Content\Policies\SectionPolicy::view
     */
    public function test()
    {
        $user = $this->getUser();

        $policy = new SectionPolicy();

        # view
        $this->assertTrue($policy->view($user, 1));
    }

}