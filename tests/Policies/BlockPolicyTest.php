<?php

use Belt\Core\Testing;
use Belt\Content\Policies\BlockPolicy;

class BlockPolicyTest extends Testing\BeltTestCase
{

    use Testing\CommonMocks;

    /**
     * @covers \Belt\Content\Policies\BlockPolicy::view
     */
    public function test()
    {
        $user = $this->getUser();

        $policy = new BlockPolicy();

        # view
        $this->assertTrue($policy->view($user, 1));
    }

}