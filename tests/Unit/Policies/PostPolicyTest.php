<?php namespace Tests\Belt\Content\Unit\Policies;

use Tests\Belt\Core;
use Belt\Content\Policies\PostPolicy;

class PostPolicyTest extends \Tests\Belt\Core\BeltTestCase
{

    use \Tests\Belt\Core\Base\CommonMocks;

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