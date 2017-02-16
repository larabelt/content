<?php

use Belt\Core\Testing;
use Belt\Content\Policies\TagPolicy;

class TagPolicyTest extends Testing\BeltTestCase
{

    use Testing\CommonMocks;

    /**
     * @covers \Belt\Content\Policies\TagPolicy::view
     */
    public function test()
    {
        $user = $this->getUser();

        $policy = new TagPolicy();

        # view
        $this->assertTrue($policy->view($user, 1));
    }

}