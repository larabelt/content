<?php namespace Tests\Belt\Content\Unit\Policies;

use Belt\Core\Tests;
use Belt\Content\Policies\BlockPolicy;

class BlockPolicyTest extends Tests\BeltTestCase
{

    use Tests\CommonMocks;

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