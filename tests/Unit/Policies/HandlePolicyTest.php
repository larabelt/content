<?php namespace Tests\Belt\Content\Unit\Policies;

use Belt\Core\Tests;
use Belt\Content\Policies\HandlePolicy;

class HandlePolicyTest extends Tests\BeltTestCase
{

    use Tests\CommonMocks;

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