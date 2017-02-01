<?php

use Ohio\Core\Testing;
use Ohio\Content\Policies\BlockPolicy;

class BlockPolicyTest extends Testing\OhioTestCase
{

    use Testing\CommonMocks;

    /**
     * @covers \Ohio\Content\Policies\BlockPolicy::view
     */
    public function test()
    {
        $user = $this->getUser();

        $policy = new BlockPolicy();

        # view
        $this->assertTrue($policy->view($user, 1));
    }

}