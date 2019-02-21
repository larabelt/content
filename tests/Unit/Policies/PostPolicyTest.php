<?php namespace Tests\Belt\Content\Unit\Policies;

use Belt\Core\Tests;
use Belt\Content\Policies\PostPolicy;

class PostPolicyTest extends Tests\BeltTestCase
{

    use Tests\CommonMocks;

    /**
     * @covers \Belt\Content\Policies\PostPolicy::view
     */
    public function test()
    {
        $user = $this->getUser();

        $policy = new PostPolicy();

        # view
        $this->assertTrue($policy->view($user, 1));
    }

}