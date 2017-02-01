<?php

use Ohio\Core\Testing;
use Ohio\Content\Policies\TagPolicy;

class TagPolicyTest extends Testing\OhioTestCase
{

    use Testing\CommonMocks;

    /**
     * @covers \Ohio\Content\Policies\TagPolicy::view
     */
    public function test()
    {
        $user = $this->getUser();

        $policy = new TagPolicy();

        # view
        $this->assertTrue($policy->view($user, 1));
    }

}