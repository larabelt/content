<?php namespace Tests\Belt\Content\Unit\Policies;

use Tests\Belt\Core;
use Belt\Content\Policies\HandlePolicy;

class HandlePolicyTest extends \Tests\Belt\Core\BeltTestCase
{

    use \Tests\Belt\Core\Base\CommonMocks;

    /**
     * @covers \Belt\Content\Policies\HandlePolicy::view
     */
    public function test()
    {
        $user = $this->getUser();

        $policy = new HandlePolicy();

        # view
        $this->assertTrue($policy->view($user, 1));
    }

}