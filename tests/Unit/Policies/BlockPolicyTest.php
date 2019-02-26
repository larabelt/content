<?php namespace Tests\Belt\Content\Unit\Policies;

use Tests\Belt\Core;
use Belt\Content\Policies\BlockPolicy;

class BlockPolicyTest extends \Tests\Belt\Core\BeltTestCase
{

    use \Tests\Belt\Core\Base\CommonMocks;

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